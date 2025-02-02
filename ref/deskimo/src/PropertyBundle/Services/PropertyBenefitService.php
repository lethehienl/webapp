<?php

namespace PropertyBundle\Services;

use AppBundle\Services\PhotoUploadService;
use AppBundle\Utils\DateTimeUtil;
use AppBundle\Utils\ServiceUtil;
use Gaufrette\File;
use PropertyBundle\Entity\Amenity;
use PropertyBundle\Entity\Property;
use PropertyBundle\Entity\PropertyAmenity;
use PropertyBundle\Entity\PropertyBenefit;
use PropertyBundle\Form\PropertyType;
use PropertyBundle\Repository\AmenityRepository;
use PropertyBundle\Repository\PropertyRepository;
use PropertyBundle\Util\PropertyUtil;
use UserBundle\Entity\User;
use AppBundle\Services\AbstractService;
use UserBundle\Repository\UserRepository;
use Gaufrette\Adapter\Local as LocalAdapter;
use Gaufrette\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PropertyBenefitService extends AbstractService
{
/*  public function updatePropertyBenefitImage(PropertyAmenity $propertyBenefit, $oldImage = '')
  {
    $imagePath = $oldImage;
    $image = $propertyBenefit->getImageTmp();
    if (!empty($image)) {

      $imageService = $this->getService(ServiceUtil::PHOTO_UPLOADER_SERVICE);
      $fileName = $imageService->upload($image, 'property');
      $imagePath = '/media/' . $fileName;
    }

    $propertyBenefit->setImage($imagePath);
  }*/

  public function create(Amenity $amenity)
  {
    //$this->updatePropertyBenefitImage($amenity);
    $this->getEntityManager()->persist($amenity);
    $this->getEntityManager()->flush();
  }

  public function update(Amenity $amenity)
  {
   // $this->updatePropertyBenefitImage($propertyBenefit, $oldImage);

    $this->getEntityManager()->persist($amenity);
    $this->getEntityManager()->flush();
  }

  public function delete(Amenity $amenity)
  {
    try {
      $this->getEntityManager()->remove($amenity);
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
      /** @var AmenityRepository $amenityRepo */
      $amenityRepo = $this->getEntityManager()->getRepository(Amenity::class);
      $total = (int)$amenityRepo->getTotalDatatale($keyword);

      if ($total == 0) {
        return $data;
      }

      $items = $amenityRepo->getDatatale($keyword, $itemPerPages, $startOffset);
      $items = $this->decorateDatatables($items);

      $data = array(
        'draw' => $draw,
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $items
      );

      return $data;
    } catch (\Exception $ex) {
      $this->writeLog(__FUNCTION__ . ' SEARCH PROPERTY BENEFIT: ' . $ex->getMessage());
      return $data;
    }
  }

  private function decorateDatatables($items)
  {
    $info = array();

    if (empty($items)) {
      return $info;
    }

    /** @var Amenity $item */
    foreach ($items as $item) {
      $updatedDate = DateTimeUtil::formatDate($item->getUpdatedAt());
      $info[] = array(
        '',
        $item->getId(),
        $item->getName(),
        $updatedDate,
      );
    }

    return $info;
  }

  public function getDetail($id)
  {
    return $this->getEntityManager()->getRepository(Amenity::class)->find($id);
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

  public function updatePropertyAmenity(Property $property, $data) {
    if (!empty($property->getId())) {
      $productBenefitRepo = $this->getRepository(PropertyAmenity::class);
      $productBenefits = $productBenefitRepo->findBy(['property' => $property]);
      if (!empty($productBenefits)) {
        foreach ($productBenefits as $productBenefit) {
          $this->remove($productBenefit);
        }
      }
    }

    $amenityFrees = $data['amenityFree'];
    if (!empty($amenityFrees)) {
      foreach ($amenityFrees as $amenityFreeId) {
        $newBenefit = $this->getRepository(Amenity::class)->find($amenityFreeId);
        $pPropertyBenefit = new PropertyAmenity();
        $pPropertyBenefit->setProperty($property);
        $pPropertyBenefit->setAmenity($newBenefit);
        $pPropertyBenefit->setIsFree(true);
        $this->persist($pPropertyBenefit);
      }
    }

    $amenityPaids = $data['amenityPaid'];
    if (!empty($amenityPaids)) {
      foreach ($amenityPaids as $amenityPaidId) {
        $newBenefit = $this->getRepository(Amenity::class)->find($amenityPaidId);
        $pPropertyBenefit = new PropertyAmenity();
        $pPropertyBenefit->setProperty($property);
        $pPropertyBenefit->setAmenity($newBenefit);
        $pPropertyBenefit->setIsFree(false);
        $this->persist($pPropertyBenefit);


      }
    }
    $this->flush();

  }
}