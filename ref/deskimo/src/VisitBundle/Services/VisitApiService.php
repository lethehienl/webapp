<?php

namespace VisitBundle\Services;

use AppBundle\Services\AbstractService;
use AppBundle\Utils\DateTimeUtil;
use AppBundle\Utils\PriceUtil;
use AppBundle\Utils\ServiceUtil;
use AppBundle\Utils\StringUtil;
use CompanyBundle\Utils\PropertyCompanyUtil;
use PaymentBundle\Utils\TransactionUtil;
use PropertyBundle\Entity\Property;
use PropertyBundle\Services\PropertyService;
use UserBundle\Entity\User;
use VisitBundle\Entity\Visit;
use VisitBundle\Entity\VisitEvaluation;
use VisitBundle\Entity\VisitRequest;
use VisitBundle\Entity\VisitTracking;
use VisitBundle\Repository\VisitRepository;
use VisitBundle\Utils\VisitUtil;

class VisitApiService extends AbstractService
{
  public function requestCheckin($properyId = null)
  {
    /** @var PropertyService $propertyService */
    $propertyService = $this->getService(ServiceUtil::PROPERTY_SERVICE);
    $property = null;

    if (!empty($properyId)) {
      /** @var Property $property */
      $property = $propertyService->getAvailablePropertyById($properyId);
    }

    return $this->createRequestCheckin($this->getLoggedUser(), $property);
  }

  private function createRequestCheckin(User $user, $property = null)
  {
    if (!empty($property)) {
      $conditions = ['property' => $property, 'user' => $user, 'status' => VisitUtil::REQUEST_PENDING_STATUS];
    } else {
      $conditions = ['user' => $user, 'status' => VisitUtil::REQUEST_PENDING_STATUS];
    }

    $visitRequest = $this->getEntityByConditions(VisitRequest::class, $conditions);

    if (empty($visitRequest)) {
      $visitRequest = new VisitRequest();
      $visitRequest->setUser($user);
      $visitRequest->setProperty($property);
      $visitRequest->setStatus(VisitUtil::REQUEST_PENDING_STATUS);
    }

    $visitRequest->setCode(StringUtil::generateRandomString());
    $visitRequest->setExpiredTime(DateTimeUtil::createExpiredTime());
    $visitRequest->setToken(StringUtil::generateHashToken(time() . $user->getId()));

    $this->persist($visitRequest, true);
    $data = ['code' => StringUtil::displayCode($visitRequest->getCode()), 'verify_token' => $visitRequest->getToken()];
    $specialToken = TransactionUtil::CHECKIN_TYPE . '-' . $visitRequest->getToken() . '-' . $visitRequest->getCode();
    $data['qr_code_token'] = $specialToken;

    return $data;
  }

  public function verifyCheckin()
  {
    $postData = $this->parseBodyRequestData();
    $requiredFields = ['code', 'verify_token'];
    $this->validateRequireFields($postData, $requiredFields);

    $conditions = ['code' => StringUtil::trimAllSpace($postData->code), 'token' => $postData->verify_token, 'user' => $this->getLoggedUser()];
    /** @var Visit $visit */
    $visit = $this->getEntityByConditions(Visit::class, $conditions);

    return empty($visit) ? ['is_checkined' => false] : ['is_checkined' => true];
  }

  public function reEnter()
  {
    $postData = $this->parseBodyRequestData();
    $requiredFields = ['visit_id'];
    $this->validateRequireFields($postData, $requiredFields);

    $conditions = ['id' => $postData->visit_id, 'user' => $this->getLoggedUser(), 'status' => VisitUtil::VISIT_ON_GOING_STATUS];
    /** @var Visit $visit */
    $visit = $this->getEntityByConditions(Visit::class, $conditions);

    if (empty($visit)) {
      $this->throwException('Visit is invalid');
    }

    $conditions = ['visit' => $visit, 'status' => VisitUtil::RE_ENTER_PENDING_STATUS];
    $visitTracking = $this->getEntityByConditions(VisitTracking::class, $conditions);

    if (empty($visitTracking)) {
      $visitTracking = new VisitTracking();
      $visitTracking->setVisit($visit);
      $visitTracking->setCode(StringUtil::generateRandomString());
      $visitTracking->setToken(StringUtil::generateHashToken($visit->getId() . time()));
    }

    $visitTracking->setExpiredTime(DateTimeUtil::createExpiredTime());
    $visitTracking->setStatus(VisitUtil::RE_ENTER_PENDING_STATUS);

    $this->persist($visitTracking, true);

    $specialToken = TransactionUtil::RE_ENTER_TYPE . '-' . $visitTracking->getToken() . '-' . $visitTracking->getCode();
    return ['visit_id' => $visit->getId(), 'code' => $visitTracking->getCode(), 'verify_token' => $visitTracking->getToken(), 'qr_code_token' => $specialToken];
  }

  public function verifyReEnter()
  {
    $postData = $this->parseBodyRequestData();
    $requiredFields = ['visit_id', 'code', 'verify_token'];
    $this->validateRequireFields($postData, $requiredFields);

    $conditions = ['id' => $postData->visit_id, 'user' => $this->getLoggedUser(), 'status' => VisitUtil::VISIT_ON_GOING_STATUS];
    /** @var Visit $visit */
    $visit = $this->getEntityByConditions(Visit::class, $conditions);

    if (empty($visit)) {
      $this->throwException('Visit is invalid');
    }

    $conditions = ['visit' => $visit, 'status' => VisitUtil::RE_ENTER_ACCEPTED_STATUS, 'code' => $postData->code, 'token' => $postData->verify_token];
    $visitTracking = $this->getEntityByConditions(VisitTracking::class, $conditions);

    return empty($visitTracking) ? ['is_reentered' => false] : ['is_reentered' => true];
  }

  public function finishVisit(Visit $visit)
  {
    $currentTime = new \DateTime();
    /** @var \DateTime $startTime */
    $startTime = $visit->getStartTime();
    $totalTime = ($currentTime->getTimestamp() - $startTime->getTimestamp()) / 3600;
    $price = $visit->getRatePerHour() * $totalTime;
    $visit->setTotalPrice($price);

    $visit->setEndTime($currentTime);
    $visit->setTotalTime($totalTime);
    $visit->setStatus(VisitUtil::VISIT_FINISHED_STATUS);
    $visit->setCode(StringUtil::updateCode($visit->getId(), $visit->getCode()));
  }

  public function getVisitHistory($lastId = null)
  {
    /** @var VisitRepository $visitRepo */
    $visitRepo = $this->getRepository(Visit::class);
    $visits = $visitRepo->getVisits($lastId);

    if (empty($visits)) {
      return [];
    }

    return $this->formatVisitHistories($visits);
  }

  private function formatVisitHistories($visits)
  {
    $ongoingVisits = [];
    $lastVisits = [];
    $currentDate = new \DateTime();

    /** @var Visit $visit */
    foreach($visits as $visit) {
      $status = $visit->getStatus();

      $item = [
        'id' => $visit->getId(),
        'name' => $visit->getName(),
        'type' => 'CoWorking',
        'address' => $visit->getAddress(),
        'price' => $visit->getRatePerHour(),
        'status' => VisitUtil::getVisitStatus($status),
        'currency_code' => $visit->getPaymentCurrency(),
        'start_time' => $visit->getStartTime()->getTimeStamp(),
        'duration' => DateTimeUtil::formatDuration(DateTimeUtil::getDistanceTime($visit->getStartTime(), $currentDate) * 60),
        'is_reviewed' => $visit->getIsReviewed() == VisitUtil::VISIT_REVIEWED
      ];

      if ($status == VisitUtil::VISIT_ON_GOING_STATUS) {
        $item['total_time'] = null;
        $item['end_time'] = null;
        $item['total_price'] = PriceUtil::calculatePrice($visit->getStartTime(), $currentDate, $visit->getRatePerHour());
        $ongoingVisits[] = $item;
      } else {
        $item['total_time'] = $visit->getTotalTime();
        $item['end_time'] = $visit->getEndTime()->getTimeStamp();
        $item['total_price'] = $visit->getTotalPrice();
        $lastVisits[] = $item;
      }
    }

    return ['visitting' => reset($ongoingVisits), 'histories' => $lastVisits];
  }

  public function allowCheckin($code, $token)
  {
    $conditions = ['code' => $code, 'token' => $token, 'status' => VisitUtil::REQUEST_PENDING_STATUS];
    /** @var VisitRequest $visitRequest */
    $visitRequest = $this->getEntityByConditions(VisitRequest::class, $conditions);

    if (empty($visitRequest)) {
      $this->throwException('Data is invalid', 1008);
    }

    /** @var Property $property */
    $property = $visitRequest->getProperty();

    if (empty($property)) {
      if (empty($this->getCurrentProperty()) || $this->getCurrentProperty() == PropertyCompanyUtil::ALL_PROPERTIES_VALUE) {
        $this->throwException('Please choose property!');
      }

      $property = $this->getEntityById(Property::class, $this->getCurrentProperty()->getId());
    }

    $this->createVisit($visitRequest, $property);
  }

  public function createVisit(VisitRequest $visitRequest, Property $property)
  {
    $visit = new Visit();
    $visit->setName($property->getName());
    $visit->setCode($visitRequest->getCode());
    $visit->setToken($visitRequest->getToken());

    $visitRequest->setStatus(VisitUtil::REQUEST_ACCEPTED_STATUS);
    $visitRequest->setCode(StringUtil::updateCode($visitRequest->getId(), $visitRequest->getCode()));
    $this->persist($visitRequest);

    $visit->setProperty($property);
    $visit->setStartTime(new \DateTime());
    $visit->setVisitRequest($visitRequest);

    $visit->setStaff($this->getLoggedUser());
    $visit->setUser($visitRequest->getUser());
    $visit->setAddress($property->getAddress());

    $visit->setRatePerHour($property->getRatePerHour());
    $visit->setPaymentCurrency($property->getCurrencyCode());
    $visit->setStatus(VisitUtil::VISIT_ON_GOING_STATUS);

    $this->persist($visit, true);
  }

  public function getOnGoingVisit()
  {
    $conditions = ['user' => $this->getLoggedUser(), 'status' => VisitUtil::VISIT_ON_GOING_STATUS];
    /** @var Visit $visit */
    $visit = $this->getEntityByConditions(Visit::class, $conditions);

    if (empty($visit)) {
      return [];
    }

    $currentTime = new \DateTime();

    $visitInfo = [
      'end_time' => null,
      'total_time' => null,
      'type' => 'CoWorking',
      'id' => $visit->getId(),
      'name' => $visit->getName(),
      'address' => $visit->getAddress(),
      'price' => $visit->getRatePerHour(),
      'currency_code' => $visit->getPaymentCurrency(),
      'property_id' => $visit->getProperty()->getId(),
      'start_time' => $visit->getStartTime()->getTimeStamp(),
      'status' => VisitUtil::getVisitStatus($visit->getStatus()),
      'duration' => DateTimeUtil::formatDuration(DateTimeUtil::getDistanceTime($visit->getStartTime(), $currentTime) * 60),
      'total_price' => PriceUtil::calculatePrice($visit->getStartTime(), $currentTime, $visit->getRatePerHour())
    ];

    return $visitInfo;
  }

  public function getVisitDetail($visitId)
  {
    if (empty($visitId)) {
      $this->throwException('Data is invalid');
    }

    $conditions = ['id' => $visitId, 'user' => $this->getLoggedUser()];
    /** @var Visit $visit */
    $visit = $this->getEntityByConditions(Visit::class, $conditions);

    if (empty($visit)) {
      $this->throwException('Visit is invalid');
    }

    $endTime = $visit->getEndTime();
    $tmpEndDate = (empty($endTime)) ? new \DateTime() : $endTime;

    if (empty($endTime)) {
      $tmpEndDate = new \DateTime();
    }

    $duration = DateTimeUtil::formatDuration(DateTimeUtil::getDistanceTime($visit->getStartTime(), $tmpEndDate) * 60);

    $data = [
      'name' => $visit->getName(),
      'address' => $visit->getAddress(),
      'code' => $visit->getCode(),
      'start_time' => $visit->getStartTime()->getTimeStamp(),
      'end_time' => empty($endTime) ? null : $endTime->getTimeStamp(),
      'duration' => $duration,
      'rate' => $visit->getRatePerHour(),
      'currency_code' => $visit->getPaymentCurrency(),
      'total_price' => empty($endTime) ? null : $visit->getTotalPrice(),
      'payment' => '',
      'paid_date' => null,
      'type' => 'CoWorking',
      'status' => VisitUtil::getVisitStatus($visit->getStatus())
    ];

    return $data;
  }

  public function createVisitEvaluation()
  {
    $postData = $this->parseBodyRequestData();
    $requireFields = ['visit_id', 'rate'];
    $this->validateRequireFields($postData, $requireFields);

    /** @var Visit $visit */
    $visit = $this->getEntityById(Visit::class, $postData->visit_id);

    if ($visit->getIsReviewed() == VisitUtil::VISIT_REVIEWED) {
      $this->throwException('This visit was reviewed before!');
    }

    /** @var Property $property */
    $property = $visit->getProperty();
    $visit->setIsReviewed(VisitUtil::VISIT_REVIEWED);

    $evaluation = new VisitEvaluation();
    $evaluation->setVisit($visit);
    $evaluation->setProperty($property);
    $evaluation->setStar($postData->rate);

    $totalRating = $property->getTotalRating();
    $totalRating = empty($totalRating) ? 1 : $totalRating + 1;
    $property->setTotalRating($totalRating);

    $avgRating = $property->getAvgRating();
    $avgRating = empty($avgRating) ? 0 : $avgRating;
    $avgRating = round(($avgRating + $evaluation->getStar() / 2), 1);
    $property->setAvgRating($avgRating);

    if (!empty($postData->message)) {
      $evaluation->setMessage($postData->message);
    }

    $this->persist($visit);
    $this->persist($property);
    $this->persist($evaluation, true);
  }
}
