<?php

namespace PropertyBundle\Services;

use AppBundle\Services\AbstractService;
use AppBundle\Utils\FileUtil;
use AppBundle\Utils\MapUtil;
use AppBundle\Utils\ServiceUtil;
use PropertyBundle\Entity\Property;
use PropertyBundle\Entity\PropertyPicture;
use PropertyBundle\Repository\PropertyRepository;
use PropertyBundle\Util\PropertyUtil;

class PropertyApiService extends AbstractService
{
  public function searchProperties()
  {
    $postData = $this->parseBodyRequestData(true);
    $requireFields = ['sort_by', 'is_open', 'country_code', 'lat', 'lng'];
    $this->validateRequireFields($postData, $requireFields, false);

    /** @var PropertyRepository $propertyRepo */
    $propertyRepo = $this->getRepository(Property::class);
    $properties = $propertyRepo->searchProperties($postData);

    if (empty($properties)) {
      return [];
    }

    return $this->formatSearchProperties($properties);
  }

  public function searchPropertiesFromElasticSearch() {
    $postData = $this->parseBodyRequestData(true);
    $requireFields = ['sort_by', 'is_open', 'country_code', 'lat', 'lng'];
    $this->validateRequireFields($postData, $requireFields, false);

    $results = $this->getService(ServiceUtil::SEARCH_SERVICE)->searchProperty($postData);
    $decoratedSearchedProperties = $this->formatSearchProperties($results['results'], $postData['lat'], $postData['lng']);
    $results['results'] = $decoratedSearchedProperties;

    return $results;
  }

  private function formatSearchProperties($properties, $currentLat = null, $currentLng = null)
  {
    $data = [];

    /**
     * @var PropertyService $propertyService
     */
    $propertyService = $this->getService(ServiceUtil::PROPERTY_SERVICE);

    /** @var Property $property */
    foreach($properties as $property) {
      $pictures = $property->getPictures()->toArray();
      $decoratedPictures = [];

      /**
       * @var PropertyPicture $picture
       */
      foreach ($pictures as $picture) {
        $decoratedPictures[] = FileUtil::getFilePath($picture->getFileKey(), $this->getContainer()->getParameter('current_domain'));
      }

      $distance = MapUtil::haversineGreatCircleDistance($currentLat, $currentLng, $property->getLat(), $property->getLng());

      $data[] = [
        'id' => $property->getId(),
        'name' => $property->getName(),
        'open_time' => $propertyService->getPropertyScheduleToday($property),
        'is_open' => $property->getIsOpen(),
        'status' => $property->getStatus(),
        'type' => @PropertyUtil::TYPE_MAPPING[$property->getType()] ? PropertyUtil::TYPE_MAPPING[$property->getType()] : PropertyUtil::TYPE_DEFAULT,
        'distance' => MapUtil::convertDistanceUnit($distance),
        'address' => $property->getAddress(),
        'thumbnail' => @$decoratedPictures[0],
        'lat' => floatval($property->getLat()),
        'lng' => floatval($property->getLng()),
        'currency_code' => $property->getCurrencyCode(),
        'price' => $property->getRatePerHour(),
      ];
    }

    return $data;
  }

  public function getProperty($propertyId)
  {
    if (empty($propertyId) || !is_numeric($propertyId)) {
      $this->throwException('Property not found');
    }

    /** @var Property $property */
    $property = $this->getEntityById(Property::class, $propertyId);

    if (empty($property)) {
      $this->throwException('Property not found');
    }

    $isOpened = $property->getStatus() == PropertyUtil::ACTIVE_STATUS && $property->getIsOpen() == PropertyUtil::IS_OPENED;
    /** @var PropertyService $propertyService */
    $propertyService = $this->getService(ServiceUtil::PROPERTY_SERVICE);

    $data = [
      'id' => $property->getId(),
      'is_open' => $isOpened,
      'name' => $property->getName(),
      'lat' => $property->getLat(),
      'lng' => $property->getLng(),
      'address' => $property->getAddress(),
      'contact_name' => $property->getContactName(),
      'contact_phone' => $property->getContactPhone(),
      'images' => $this->getPropertiesImages($property),
      'currency_code' => $property->getCurrencyCode(),
      'type' => 'CoWorking',//TODO update here
      'open_time' => '9:00 AM - 22:00 PM',//TODO update here
      'price' => $property->getRatePerHour(),
      'wifi_info' => [],// [$this->getJsonInfo($property->getWifiInfo())],
      'parkings' => [], //$this->getJsonInfo($property->getParkingAddresses()),
      'amenities' => [],// $propertyService->getAmenitiesByProperty($property),
      'about' => $property->getAbout(),
      'how_to_get_there' => [], // [$property->getHowToGetThere()],
      'how_far' => '',
    ];

    return $data;
  }

  private function getPropertiesImages(Property $property)
  {
    $pictures = $property->getPictures();
    $data = [];

    if (empty($pictures)) {
      return $data;
    }

    /** @var PropertyPicture $picture */
    foreach($pictures as $picture) {
      $data[] = '';
    }

    return $data;
  }
}