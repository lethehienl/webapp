<?php

namespace CompanyBundle\Services;

use AppBundle\Services\AbstractService;
use AppBundle\Services\EmailNotificationService;
use AppBundle\Utils\DateTimeUtil;
use AppBundle\Utils\EmailUtil;
use AppBundle\Utils\ServiceUtil;
use AppBundle\Utils\StatusUtil;
use CompanyBundle\Entity\PropertyCompany;
use CompanyBundle\Repository\PropertyCompanyRepository;
use CompanyBundle\Utils\PropertyCompanyUtil;
use PropertyBundle\Entity\Property;
use UserBundle\Entity\User;
use UserBundle\Services\UserService;
use UserBundle\Utils\RolesUtil;
use UserBundle\Utils\UserUtil;

class PropertyCompanyService extends AbstractService
{
  public function create(PropertyCompany $propertyCompany)
  {
    //$this->updatePropertyBenefitImage($amenity);
    $this->getEntityManager()->persist($propertyCompany);
    $this->getEntityManager()->flush();
  }

  public function update(PropertyCompany $propertyCompany)
  {
    // $this->updatePropertyBenefitImage($propertyBenefit, $oldImage);

    $this->getEntityManager()->persist($propertyCompany);
    $this->getEntityManager()->flush();
  }

  public function delete(PropertyCompany $propertyCompany)
  {
    try {
      $this->getEntityManager()->remove($propertyCompany);
      $this->getEntityManager()->flush();
    } catch (Exception $e) {
      return false;
    }
    return true;
  }

  public function getDatatable()
  {
    $draw = (int)$this->getRequest()->get('draw');
    $keyword = $this->getRequest()->get('keyword');

    $startOffset = $this->getRequest()->get('start');
    $itemPerPages = $this->getRequest()->get('length');

    $data = array(
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => array(),
    );

    try {
      /** @var PropertyCompanyRepository $propertyCompanyRepo */
      $propertyCompanyRepo = $this->getEntityManager()->getRepository(PropertyCompany::class);
      $total = (int)$propertyCompanyRepo->getTotalDatatale($keyword);

      if ($total == 0) {
        return $data;
      }

      $items = $propertyCompanyRepo->getDatatale($keyword, $itemPerPages, $startOffset);
      $items = $this->decorateDatatables($items);

      $data = array(
        'draw' => $draw,
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $items
      );

      return $data;
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . ' SEARCH PROPERTY COMPANY: ' . $ex->getMessage());
      return $data;
    }
  }

  private function decorateDatatables($items)
  {
    $info = array();

    if (empty($items)) {
      return $info;
    }

    /** @var PropertyCompany $item */
    foreach ($items as $item) {
      $updatedDate = DateTimeUtil::formatDate($item->getUpdatedAt());
      $status = $item->getStatus();
      $status = StatusUtil::STATUS_MAPPING[$status];
      $info[] = array(
        $item->getId(),
        '',
        $item->getName(),
        $item->getContactName(),
        $item->getContactPhone(),
        //$item->getImage(),
        $status,
        //  (!empty($item->getIsFree()) ? 'No' : 'Yes'),
        $updatedDate
      );
    }

    return $info;
  }

  public function getDetail($id)
  {
    return $this->getEntityManager()->getRepository(PropertyCompany::class)->find($id);
  }

  public function saveDetail($entity)
  {

    try {
      $this->getEntityManager()->merge($entity);
      $this->getEntityManager()->flush();
    } catch (Exception $e) {
      return false;
    }
    return true;
  }

  public function getActiveCompany($form = false)
  {
    $companies = $this->getRepository(PropertyCompany::class)->findAll();
    if ($form) {
      $options = array();
      foreach ($companies as $company) {
        $key = $company->getName();
        $options[$key] = $company->getId();
      }
      return $options;
    } else {
      return $companies;
    }
  }

  public function inviteCompanyAccount(User $user, $companyId) {
    $company = $this->getRepository(PropertyCompany::class)->find($companyId);

    if (!$company) {
      throw new \Exception('Company is not found', 1000);
    }

    $user->addCompany($company);

    /**
     * @var UserService $userService
     */
    $userService = $this->getService(ServiceUtil::USER_SERVICE);
    /**
     * @var EmailNotificationService $emailService
     */
    $emailService = $this->getService(ServiceUtil::EMAIL_NOTIFICATION_SERVICE);
    $emailService->setSubject('Validate assignation to company')
                 ->setLanguage($this->getCurrentLocale())
                 ->setTemplate(EmailUtil::ACTIVATE_COMPANY_ASSIGNATION_TEMPLATE_KEY)
                 ->setTo($user->getUsername())
                 ->setBody(
                   [
                     'activate_url' => $userService->generatePasswordRouteUrl($user),
                     'full_name' => $user->getFullName(),
                     'company_name' => $company->getName(),
                     'company_phone' => $company->getContactPhone(),
                     'company_contact_name' => $company->getContactName()
                   ]
                 )->send();

    $this->persistAndFlush($user);
  }

  public function getAvailableCompaniesByUser(User $user) {
    if ($user->getRoleId() == RolesUtil::ROLE_DESKIMO_ADMIN_ID) {
      return $this->getRepository(PropertyCompany::class)->findBy(['status' => StatusUtil::ACTIVE_CODE]);
    }

    return $this->getRepository(PropertyCompany::class)->getCompaniesByUser($user);
  }

  public function getAvailablePropertiesByCompany(PropertyCompany $propertyCompany) {
    return $this->getRepository(Property::class)->getPropertiesByCompany($propertyCompany);
  }

  public function changeCurrentCompany($companyId) {
    if ($companyId == 0) {
      $this->getService('session')->set(PropertyCompanyUtil::CURRENT_COMPANY_SESSION_KEY, PropertyCompanyUtil::ALL_COMPANIES_VALUE);
      $this->getService('session')->set(PropertyCompanyUtil::CURRENT_PROPERTY_SESSION_KEY, PropertyCompanyUtil::ALL_PROPERTIES_VALUE);
      return;
    }

    $company = $this->getRepository(PropertyCompany::class)->find($companyId);

    if (!$company) {
      throw new \Exception('Company is not found', 1000);
    }

    $this->getService('session')->set(PropertyCompanyUtil::CURRENT_COMPANY_SESSION_KEY, $company);
    $properties = $this->getAvailablePropertiesByCompany($company);
    $this->getService('session')->set(PropertyCompanyUtil::CURRENT_PROPERTY_SESSION_KEY, @$properties[0]);
  }

  public function changeCurrentProperty($propertyId) {
    if ($propertyId == 0) {
      $this->getService('session')->set(PropertyCompanyUtil::CURRENT_PROPERTY_SESSION_KEY, PropertyCompanyUtil::ALL_PROPERTIES_VALUE);
      return;
    }

    $property = $this->getRepository(Property::class)->find($propertyId);

    if (!$property) {
      throw new \Exception('Property is not found', 1000);
    }

    $this->getService('session')->set(PropertyCompanyUtil::CURRENT_PROPERTY_SESSION_KEY, $property);
  }

  public function changeCurrentPropertyStatus($propertyId, $status) {
    $property = $this->getRepository(Property::class)->find($propertyId);

    if (!$property) {
      throw new \Exception('Property is not found', 1000);
    }

    $property->setStatus($status);
    $this->persistAndFlush($property);
    $this->getService('session')->set(PropertyCompanyUtil::CURRENT_PROPERTY_SESSION_KEY, $property);
  }
}
