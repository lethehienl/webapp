<?php

namespace PropertyBundle\Services;

use AppBundle\Services\PhotoUploadService;
use AppBundle\Utils\DateTimeUtil;
use AppBundle\Utils\FileUtil;
use AppBundle\Utils\PhoneUtil;
use AppBundle\Utils\PriceUtil;
use AppBundle\Utils\ServiceUtil;
use AppBundle\Utils\StringUtil;
use CompanyBundle\Entity\PropertyCompany;
use CompanyBundle\Utils\PropertyCompanyUtil;
use PropertyBundle\Entity\Amenity;
use PropertyBundle\Entity\Property;
use PropertyBundle\Entity\PropertyAmenity;
use PropertyBundle\Entity\PropertyPicture;
use PropertyBundle\Repository\PropertyAmenityRepository;
use PropertyBundle\Repository\PropertyRepository;
use PropertyBundle\Util\PropertyUtil;
use AppBundle\Services\AbstractService;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use UserBundle\Entity\User;
use VisitBundle\Entity\Visit;
use VisitBundle\Repository\VisitRepository;
use VisitBundle\Utils\VisitUtil;

class PropertyService extends AbstractService
{
  public function updatePropertyImage(Property $property, $oldImage = '')
  {
    $imagePath = $oldImage;
    $image = $property->getImageTmp();
    if (!empty($image)) {
      /** @var PhotoUploadService $imageService */
      $imageService = $this->getService(ServiceUtil::PHOTO_UPLOADER_SERVICE);
      $fileName = $imageService->upload($image, FileUtil::PROPERTY_IMAGES_FOLDER);
      $imagePath = FileUtil::getFilePath($fileName);
    }

    $property->setPictures($imagePath);
  }

  public function updatePropertyBenefit(Property $property)
  {
    if (!empty($property->getId())) {
      $productBenefitRepo = $this->getRepository(PropertyAmenity::class);
      $productBenefits = $productBenefitRepo->findBy(['property' => $property]);
      if (!empty($productBenefits)) {
        foreach ($productBenefits as $productBenefit) {
          $this->remove($productBenefit);
        }
      }
    }

    $benefits = $property->getBenefitTmp();
    if (!empty($benefits)) {
      foreach ($benefits as $benefitId) {
        $newBenefit = $this->getRepository(Amenity::class)->find($benefitId);
        $pPropertyBenefit = new PropertyAmenity();
        $pPropertyBenefit->setProperty($property);
        $pPropertyBenefit->setAmenity($newBenefit);
        $this->persist($pPropertyBenefit);

      }
    }
  }

  public function updateJsonField(Property $property)
  {

    $postData = $this->getRequest()->get('deskimo_form_property');

    //Parking Address
    $parkingAddress = json_encode(array(
      'parkingAddresses1' => !empty($postData['parkingAddresses1']) ? $postData['parkingAddresses1'] : '',
      'parkingAddresses2' => !empty($postData['parkingAddresses2']) ? $postData['parkingAddresses2'] : '',
      'parkingAddresses3' => !empty($postData['parkingAddresses3']) ? $postData['parkingAddresses3'] : '',
    ));

    $property->setParkingAddresses($parkingAddress);

    // How to get there
    $howToGetThere = json_encode(array(
      'howToGetThere1' => !empty($postData['howToGetThere1']) ? $postData['howToGetThere1'] : '',
      'howToGetThere2' => !empty($postData['howToGetThere2']) ? $postData['howToGetThere2'] : '',
      'howToGetThere3' => !empty($postData['howToGetThere3']) ? $postData['howToGetThere3'] : '',
    ));
    $property->setHowToGetThere($howToGetThere);

    // wifi
    $wifiInfo = json_encode(array(
      'wifiName' => !empty($postData['wifiName']) ? $postData['wifiName'] : '',
      'wifiPass' => !empty($postData['wifiPass']) ? $postData['wifiPass'] : '',
    ));
    $property->setWifiInfo($wifiInfo);

  }

  public function create(Property $property)
  {
    /**
     * @var PropertyCompany $currentCompany
     */
    $currentCompany = $this->getCurrentCompany();

    if (!$currentCompany) {
      throw new \Exception('Current company is not defined');
    }

    if ($currentCompany == PropertyCompanyUtil::ALL_COMPANIES_VALUE) {
      throw new \Exception('Cannot create property for company');
    }

    $company = $this->getRepository(PropertyCompany::class)->find($currentCompany->getId());
    $property->setIsOpen(PropertyUtil::PROPERTY_IS_OPEN);
    $this->updateJsonField($property);
    $company->addProperty($property);
    $property->setCountryName(@PropertyUtil::COUNTRY[$property->getCountryCode()]);

    $this->persistAndFlush($company);
  }

  public function update(Property $property)
  {
    //$this->updatePropertyImage($property, $oldImage);
    //$this->updatePropertyBenefit($property);

    $this->updateJsonField($property);
    $this->getEntityManager()->persist($property);
    $this->getEntityManager()->flush();
  }

  public function getDatatable()
  {
    $draw = (int)$this->getRequest()->get('draw');
    $keyword = $this->getRequest()->get('keyword');
    $startOffset = $this->getRequest()->get('start');

    $data = array(
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => array(),
    );

    /** @var PropertyRepository $propertyRepo */
    $propertyRepo = $this->getEntityManager()->getRepository(Property::class);
    $total = (int)$propertyRepo->getTotalDatatale($keyword);

    if ($total == 0) {
      return $data;
    }

    $items = $propertyRepo->getDatatale($keyword, $startOffset);
    $items = $this->decorateDatatables($items);

    $data['recordsTotal'] = $total;
    $data['recordsFiltered'] = $total;
    $data['data'] = $items;

    return $data;
  }

  private function decorateDatatables($items)
  {
    $properties = array();

    if (empty($items)) {
      return $properties;
    }

    /** @var Property $item */
    foreach ($items as $item) {
      $properties[] = [$item->getId(), $item->getName() . ' (Code: ' . $item->getCode() . ')', $item->getAddress(), 'Coworking'];
    }

    return $properties;
  }

  public function getDetail($id)
  {
    return $this->getEntityManager()->getRepository(Property::class)->find($id);
  }

  public function getDetailShow($id)
  {
    $data = array();
    /** @var Property $property */
    $property =  $this->getEntityManager()->getRepository(Property::class)->find($id);
    $data['title'] = $property->getName();

    $data['country'] = '';
    if(!empty($property->getCountryCode())) {
      $country =  PropertyUtil::COUNTRY[$property->getCountryCode()];
      $data['country'] = !empty($country) ? $country : '';
    }

    $data['type'] = PropertyUtil::TYPE_DEFAULT;
    $data['about'] = $property->getAbout();

    $data['schedule'] = array();
    $schedule = $property->getSchedule();
    if(!empty($schedule)) {
      $data['schedule'] = json_decode($schedule, true);
    }
    //echo '<pre>'; print_r($data['schedule']);die;
    $data['patePerHour'] = $property->getRatePerHour();
    $data['minCost'] = PropertyUtil::PROPERTY_MIN_CHARGE;
    $data['address'] = $property->getAddress();

    $data['howToGetThere']['option1'] = $property->getHowToGetThere1();
    $data['howToGetThere']['option2']  = $property->getHowToGetThere2();
    $data['howToGetThere']['option3']  = $property->getHowToGetThere3();

    $data['parking']['address1'] = $property->getParkingAddresses1();
    $data['parking']['address2'] = $property->getParkingAddresses2();

    $data['wifi']['name'] = $property->getWifiName();
    $data['wifi']['pass'] = $property->getWifiPass();

    $propertyAmenities =  $property->getBenefit();
    $data['amenity'] = array();
    if(!empty($propertyAmenities)) {
      /** @var PropertyAmenity $propertyAmenitiy */
      foreach ($propertyAmenities as $propertyAmenitiy) {
        $data['amenity'][] = array(
          'iconName' => $propertyAmenitiy->getAmenityIconName(),
          'iconKey' => $propertyAmenitiy->getAmenityIconKey(),
          'isFree' => $propertyAmenitiy->getIsFree(),
          'name' => $propertyAmenitiy->getAmenityName(),
        );
      }
    }

    //PHOTO
    $data['photos'] = array();
    $photos= $property->getPictures();
    if(!empty($photos)) {
      /** @var PropertyPicture $photo */
      foreach ($photos as $photo) {
        $fileKey = $photo->getFileKey();
        if(!empty($fileKey)) {
          $data['photos'][]= $fileKey;
        }

      }
    }

    return $data;
  }

  public function save($entity)
  {
    try {
      $this->getEntityManager()->merge($entity);
      $this->getEntityManager()->flush();
    } catch (Exception $e) {
      return false;
    }
    return true;
  }

  public function getActiveBenefit($form = false)
  {
    $benefits = $this->getRepository(Amenity::class)->findAll();
    if ($form) {
      $options = array();
      foreach ($benefits as $benefit) {
        $key = $benefit->getName();
        $options[$key] = $benefit->getId();
      }
      return $options;
    } else {
      return $benefits;
    }
  }

  public function getBenefitPaidDefaults(Property $property)
  {
    $defaultOptions = array();
    $propertyBenefits = $this->getRepository(PropertyAmenity::class)->findBy(
      array('property' => $property, 'isFree' => false)

    );
    if (!empty($propertyBenefits)) {
      /** @var PropertyAmenity $propertyBenefit */
      foreach ($propertyBenefits as $propertyBenefit) {
        $benefit = $propertyBenefit->getAmenity();
        $defaultOptions[] = $benefit->getId();
      }
    }
    return $defaultOptions;
  }

  public function getBenefitFreeDefaults(Property $property)
  {
    $defaultOptions = array();
    $propertyBenefits = $this->getRepository(PropertyAmenity::class)->findBy(
      array('property' => $property, 'isFree' => true)
    );
    if (!empty($propertyBenefits)) {
      /** @var PropertyAmenity $propertyBenefit */
      foreach ($propertyBenefits as $propertyBenefit) {
        $benefit = $propertyBenefit->getAmenity();
        $defaultOptions[] = $benefit->getId();
      }
    }
    return $defaultOptions;
  }

  public function getAmenitiesByProperty(Property $property)
  {
    /** @var PropertyAmenityRepository $propertyAmenityRepo */
    $propertyAmenityRepo = $this->getRepository(PropertyAmenity::class);
    return $propertyAmenityRepo->getAmenitiesByProperty($property);
  }

  public function getAvailablePropertyById($propertyId)
  {
    $conditions = ['id' => $propertyId, 'isOpen' => PropertyUtil::IS_OPENED, 'status' => PropertyUtil::ACTIVE_STATUS];
    $property = $this->getEntityByConditions(Property::class, $conditions);

    if (empty($property)) {
      $this->throwException('Property is not available', 1001);
    }

    return $property;
  }

  public function addPropertyImage(Property $property, UploadedFile $image)
  {
    if (!$image) {
      return [];
    }

    if ($property->getPictures()->count() >= PropertyUtil::MAX_PICTURES) {
      throw new \Exception(sprintf('Cannot add more than %s pictures', PropertyUtil::MAX_PICTURES));
    }

    /** @var PhotoUploadService $imageService */
    $imageService = $this->getService(ServiceUtil::PHOTO_UPLOADER_SERVICE);
    $fileName = $imageService->upload($image, FileUtil::PROPERTY_IMAGES_FOLDER);
    $imagePath = FileUtil::getFilePath($fileName);

    $propertyPicture = new PropertyPicture();
    $propertyPicture->setFileKey($imagePath);
    $property->addPicture($propertyPicture);

    $this->persistAndFlush($property);
  }

  public function removePropertyImage(Property $property, $propertyPictureId)
  {
    $propertyPicture = $this->getRepository(PropertyPicture::class)->findOneBy(['property' => $property, 'id' => $propertyPictureId]);

    if (!$propertyPicture) {
      throw new \Exception('Property picture is not found!');
    }

    $this->getEntityManager()->remove($propertyPicture);

    /** @var PhotoUploadService $imageService */
    $imageService = $this->getService(ServiceUtil::PHOTO_UPLOADER_SERVICE);
    $fileName = $imageService->remove($propertyPicture->getFileKey());
    $this->persistAndFlush($property);
  }

  public function updateSchedule(Property $property, $data) {
    $dataJson = json_encode($data);
    $property->setSchedule($dataJson);
    $this->getEntityManager()->persist($property);
    $this->getEntityManager()->flush();
  }

  public function getActiveUsage4Dashboard()
  {
    $draw = (int)$this->getRequest()->get('draw');

    $data = array(
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => array(),
    );

    $currentCompany = $this->getCurrentCompany();
    $currentProperty = $this->getCurrentProperty();
    $filterProperties = [];

    if ($currentCompany != PropertyCompanyUtil::ALL_COMPANIES_VALUE && !empty($currentCompany)) {
      if ($currentProperty != PropertyCompanyUtil::ALL_PROPERTIES_VALUE && !empty($currentProperty)) {
        $filterProperties[] = $currentProperty->getId();
      } else {
        $propConditions = ['company' => $currentCompany->getId()];
        $filterProperties = $this->getEntityByConditions(Property::class, $propConditions, false);

        if (empty($filterProperties)) {
          $filterProperties = [];
        }
      }
    }

    $mainConditions = ['status' => [VisitUtil::VISIT_ON_GOING_STATUS, VisitUtil::VISIT_FINISHED_STATUS], 'property' => $filterProperties];
    $visits = $this->getEntityByConditions(Visit::class, $mainConditions, false);

    if (empty($visits)) {
      return $data;
    }

    $dataInfo = [];
    $currentTime = new \DateTime();

    /** @var Visit $visit */
    foreach($visits as $visit) {
      /** @var User $user */
      $user = $visit->getUser();
      $checkInTime = DateTimeUtil::formatDate($visit->getStartTime());
      $duration = DateTimeUtil::getDistanceTime($visit->getStartTime(), $currentTime);
      $totalPrice = PriceUtil::calculatePrice($visit->getStartTime(), $currentTime, $visit->getRatePerHour());
      $visitStatus = VisitUtil::getVisitStatus($visit->getStatus());

      $dataInfo[] = [
        $visit->getId(), StringUtil::displayCode($visit->getCode()), $user->getFullName(), PhoneUtil::displayPhoneNumber($user->getPhoneNumber()),
        $checkInTime, number_format($duration), $visit->getRatePerHour(),
        number_format($totalPrice), $visitStatus, $visit->getStatus()
      ];
    }

    $total = count($dataInfo);
    $data['recordsTotal'] = $total;
    $data['recordsFiltered'] = $total;
    $data['data'] = $dataInfo;

    return $data;
  }

  public function getUsageByPropertyId($propertyId = null, $getHistory = false)
  {
    $draw = (int)$this->getRequest()->get('draw');

    $data = array(
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => array(),
    );

    $conditions = ['property' => $propertyId, 'status' => !$getHistory ? [VisitUtil::VISIT_ON_GOING_STATUS, VisitUtil::VISIT_FINISHED_STATUS] : VisitUtil::VISIT_FINISH_PAYMENT_STATUS];
    $visits = $this->getEntityByConditions(Visit::class, $conditions, false);

    if (empty($visits)) {
      return $data;
    }

    $dataInfo = [];
    $currentTime = new \DateTime();

    /** @var Visit $visit */
    foreach($visits as $visit) {
      /** @var User $user */
      $user = $visit->getUser();
      $checkInTime = DateTimeUtil::formatDate($visit->getStartTime());
      $duration = DateTimeUtil::getDistanceTime($visit->getStartTime(), $currentTime);
      $totalPrice = PriceUtil::calculatePrice($visit->getStartTime(), $currentTime, $visit->getRatePerHour());

      $dataInfo[] = [
        $visit->getId(), StringUtil::displayCode($visit->getCode()), $user->getFullName(), PhoneUtil::displayPhoneNumber($user->getPhoneNumber()), $checkInTime, number_format($duration), $visit->getRatePerHour(), number_format($totalPrice)
      ];
    }

    $total = count($dataInfo);
    $data['recordsTotal'] = $total;
    $data['recordsFiltered'] = $total;
    $data['data'] = $dataInfo;

    return $data;
  }

  public function getData4Dashboard()
  {
    $data = [
      'revenue_chart' => [],
      'users' => [],
      'usage' => [],
      'avg_usage' => [],
    ];

    /** @var VisitRepository $visitRepo */
    $visitRepo = $this->getRepository(Visit::class);
    $visits = $visitRepo->getRevenue($this->getCurrentCompany(), $this->getCurrentProperty());

    $totalUser = 0;
    $revenueTotal = 0;
    $totalTime = 0;

    if (!empty($visits)) {
      foreach($visits as $visit) {
        $revenueTotal += $visit['total'];
        $data['revenue_chart']['labels'][] = $visit['updated_date'];
        $data['revenue_chart']['value'][] = $visit['total'];

        $totalUser += $visit['total_user'];
        $data['users']['labels'][] = $visit['updated_date'];
        $data['users']['value'][] = $visit['total_user'];

        $totalTime += $visit['total_time'];
        $data['usage']['labels'][] = $visit['updated_date'];
        $data['usage']['value'][] = $visit['total_time'];

        $data['avg_usage']['labels'][] = $visit['updated_date'];
        $data['avg_usage']['value'][] = round($visit['total_time'] / $visit['total_user'], 2);
      }

      $data['revenue_chart']['total'] = $revenueTotal;
      $data['users']['total'] = $totalUser;
      $data['usage']['total'] = $totalTime;

      $data['avg_usage']['total'] = round($totalTime / $totalUser, 2);
    }

    return $data;
  }

  public function getPropertyScheduleToday(Property $property) {
    if (!$property || !$property->getSchedule()) {
      return '';
    }

    $schedule = $property->getSchedule();
    $scheduleArr = json_decode($schedule, true);

    if (!@$scheduleArr['openHour']) {
      return '';
    }

    $date = date('l');
    $time = @$scheduleArr['openHour'][strtolower($date)];

    if (@$time['close']) {
      return 'This Coworking/Booth has closed';
    }

    if (@$time['24']) {
      return 'This Coworking/Booth opens whole day';
    }

    if (@$time['custom']) {
      return 'From ' . @$time['openHour'] . ' - ' . 'To ' . @$time['closeHour'];
    }

    return '';
  }
}