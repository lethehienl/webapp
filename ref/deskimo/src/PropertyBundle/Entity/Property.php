<?php

namespace PropertyBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use AppBundle\Utils\StringUtil;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PropertyBundle\Entity\Traits\PropertyScheduleTrait;

/**
 *
 * @ORM\Table(name="tbl_property")
 * @ORM\Entity(repositoryClass="PropertyBundle\Repository\PropertyRepository")
 */
class Property extends AbstractEntity
{
  use PropertyScheduleTrait;
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="code", type="string", length=128, unique=true)
   */
  private $code;

  /**
   *
   * @ORM\Column(name="avg_rating", type="float", nullable=true)
   */
  private $avgRating = 0;

  /**
   *
   * @ORM\Column(name="total_rating", type="integer", nullable=true)
   */
  private $totalRating = 0;

  /**
   * @var string
   *
   * @ORM\Column(name="type", type="string", length=128, nullable=true)
   */
  private $type = 1; //Corworking, 2: Booth

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="string", length=512, nullable=true)
   */
  private $name;

  /**
   * @var string
   *
   * @ORM\Column(name="about", type="text", nullable=true)
   */
  private $about;

  /**
   *
   * @ORM\Column(name="contact_email", type="string", length=256, nullable=true)
   */
  private $contactEmail;

  /**
   *
   * @ORM\Column(name="status", type="integer", nullable=true)
   */
  private $status; //0: In-active, 1: Active

  /**
   *
   * @ORM\Column(name="is_open", type="integer", nullable=true)
   */
  private $isOpen; //0: Closed, 1: Open

  /**
   * @var string
   *
   * @ORM\Column(name="address", type="string", length=1024, nullable=true)
   */
  private $address;

  /**
   *
   * @ORM\Column(name="lat", type="decimal", precision=10, scale=8, nullable=true)
   */
  private $lat;

  /**
   *
   * @ORM\Column(name="lng", type="decimal", precision=11, scale=8, nullable=true)
   */
  private $lng;

  private $geoLocation;

  /**
   *
   * @ORM\Column(name="rate_per_hour", type="float", nullable=true)
   */
  private $ratePerHour;

  /**
   *
   * @ORM\Column(name="currency_code", type="string", length=32, nullable=true)
   */
  private $currencyCode;

  /**
   *
   * @ORM\Column(name="country_code", type="string", length=32, nullable=true)
   */
  private $countryCode;

  /**
   *
   * @ORM\Column(name="city_code", type="string", length=32, nullable=true)
   */
  private $cityCode;

  /**
   *
   * @ORM\Column(name="country_name", type="string", length=255, nullable=true)
   */
  private $countryName;

  /**
   *
   * @ORM\Column(name="contact_name", type="string", length=256, nullable=true)
   */
  private $contactName;

  /**
   *
   * @ORM\Column(name="contact_phone", type="string", length=32, nullable=true)
   */
  private $contactPhone;

  /**
   *
   * @ORM\Column(name="how_to_get_there", type="text", nullable=true)
   */
  private $howToGetThere;

  private $howToGetThere1;
  private $howToGetThere2;
  private $howToGetThere3;

  private $howToGetThereArr;

  /**
   *
   * @ORM\Column(name="wifi_info", type="text", nullable=true)
   */
  private $wifiInfo;
  private $wifiName;
  private $wifiPass;

  /**
   *
   * @ORM\Column(name="parking_addresses", type="text", nullable=true)
   */
  private $parkingAddresses;

  private $parkingAddresses1;

  private $parkingAddresses2;

  private $parkingAddresses3;

  private $parkingAddressArr;

  /**
   *
   * @ORM\OneToMany(targetEntity="PropertyBundle\Entity\PropertyPicture", mappedBy="property", cascade={"persist", "remove"})
   */
  private $pictures;

  private $imageTmp;

  /**
   *
   * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\PropertyCompany", inversedBy="properties")
   * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
   */
  private $company;

  /**
   * @var
   *
   * @ORM\OneToMany(targetEntity="PropertyBundle\Entity\PropertyAmenity", mappedBy="property")
   */
  private $benefit;

  private $benefitTmp;


  public function __construct()
  {
    parent::__construct();
    $this->benefit = new ArrayCollection();
    $this->pictures = new ArrayCollection();
    $this->setCode(StringUtil::generateRandomString());
  }

  public function getAbout()
  {
    return $this->about;
  }

  public function setAbout($about): void
  {
    $this->about = $about;
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId(int $id)
  {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getCode()
  {
    return $this->code;
  }

  /**
   * @param string $code
   */
  public function setCode(string $code)
  {
    $this->code = $code;
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName(string $name)
  {
    $this->name = $name;
  }

  /**
   * @return mixed
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * @param mixed $status
   */
  public function setStatus($status)
  {
    $this->status = $status;
  }

  /**
   * @return mixed
   */
  public function getIsOpen()
  {
    return $this->isOpen;
  }

  /**
   * @param mixed $isOpen
   */
  public function setIsOpen($isOpen)
  {
    $this->isOpen = $isOpen;
  }

  /**
   * @return string
   */
  public function getAddress()
  {
    return $this->address;
  }

  /**
   * @param string $address
   */
  public function setAddress(string $address)
  {
    $this->address = $address;
  }

  /**
   * @return mixed
   */
  public function getLat()
  {
    return $this->lat;
  }

  /**
   * @param mixed $lat
   */
  public function setLat($lat)
  {
    $this->lat = $lat;
  }

  /**
   * @return mixed
   */
  public function getLng()
  {
    return $this->lng;
  }

  /**
   * @param mixed $lng
   */
  public function setLng($lng)
  {
    $this->lng = $lng;
  }

  /**
   * @return mixed
   */
  public function getRatePerHour()
  {
    return $this->ratePerHour;
  }

  /**
   * @param mixed $ratePerHour
   */
  public function setRatePerHour($ratePerHour)
  {
    $this->ratePerHour = $ratePerHour;
  }

  /**
   * @return mixed
   */
  public function getContactName()
  {
    return $this->contactName;
  }

  /**
   * @param mixed $contactName
   */
  public function setContactName($contactName)
  {
    $this->contactName = $contactName;
  }

  /**
   * @return mixed
   */
  public function getContactPhone()
  {
    return $this->contactPhone;
  }

  /**
   * @param mixed $contactPhone
   */
  public function setContactPhone($contactPhone): void
  {
    $this->contactPhone = $contactPhone;
  }

  /**
   * @return mixed
   */
  public function getHowToGetThere()
  {
    return $this->howToGetThere;
  }

  /**
   * @param mixed $howToGetThere
   */
  public function setHowToGetThere($howToGetThere)
  {
    $this->howToGetThere = $howToGetThere;
  }

  /**
   * @return mixed
   */
  public function getWifiInfo()
  {
    return $this->wifiInfo;
  }

  /**
   * @param mixed $wifiInfo
   */
  public function setWifiInfo($wifiInfo)
  {
    $this->wifiInfo = $wifiInfo;
  }

  /**
   * @return mixed
   */
  public function getParkingAddresses()
  {
    return $this->parkingAddresses;
  }

  /**
   * @param mixed $parkingAddresses
   */
  public function setParkingAddresses($parkingAddresses)
  {
    $this->parkingAddresses = $parkingAddresses;
  }

  /**
   * @return mixed
   */
  public function getPictures()
  {
    return $this->pictures;
  }

  /**
   * @param mixed $pictures
   */
  public function setPictures($pictures)
  {
    $this->pictures = $pictures;
  }

  public function addPicture(PropertyPicture $picture) {
    $this->pictures->add($picture);
    $picture->setProperty($this);
  }

  public function removePicture(PropertyPicture $picture) {
    $this->pictures->removeElement($picture);
    $picture->setProperty(null);
  }

  /**
   * @return mixed
   */
  public function getCurrencyCode()
  {
    return $this->currencyCode;
  }

  /**
   * @param mixed $currencyCode
   */
  public function setCurrencyCode($currencyCode)
  {
    $this->currencyCode = $currencyCode;
  }

  /**
   * @return mixed
   */
  public function getCountryCode()
  {
    return $this->countryCode;
  }

  /**
   * @param mixed $countryCode
   */
  public function setCountryCode($countryCode)
  {
    $this->countryCode = $countryCode;
  }

  /**
   * @return mixed
   */
  public function getCityCode()
  {
    return $this->cityCode;
  }

  /**
   * @param mixed $cityCode
   */
  public function setCityCode($cityCode)
  {
    $this->cityCode = $cityCode;
  }

  /**
   * @return mixed
   */
  public function getCompany()
  {
    return $this->company;
  }

  /**
   * @param mixed $company
   */
  public function setCompany($company)
  {
    $this->company = $company;
  }

  /**
   * @return mixed
   */
  public function getImageTmp()
  {
    return $this->imageTmp;
  }

  /**
   * @param mixed $imageTmp
   */
  public function setImageTmp($imageTmp)
  {
    $this->imageTmp = $imageTmp;
  }

  /**
   * @return mixed
   */
  public function getBenefit()
  {
    return $this->benefit;
  }

  /**
   * @param mixed $benefit
   */
  public function setBenefit($benefit)
  {
    $this->benefit = $benefit;
  }

  /**
   * @return mixed
   */
  public function getBenefitTmp()
  {
    return $this->benefitTmp;
  }

  /**
   * @param mixed $benefitTmp
   */
  public function setBenefitTmp($benefitTmp)
  {
    $this->benefitTmp = $benefitTmp;
  }

  /**
   * @return mixed
   */
  public function getContactEmail()
  {
    return $this->contactEmail;
  }

  /**
   * @param mixed $contactEmail
   */
  public function setContactEmail($contactEmail): void
  {
    $this->contactEmail = $contactEmail;
  }

  public function getType()
  {
    return $this->type;
  }

  public function setType( $type): void
  {
    $this->type = $type;
  }

  /**
   * @return mixed
   */
  public function getHowToGetThere1()
  {
    if(empty($this->howToGetThere1) && !empty($this->howToGetThere)) {
      $howToGetThere = json_decode($this->howToGetThere, true);
      $this->howToGetThere1 = !empty($howToGetThere['howToGetThere1']) ? $howToGetThere['howToGetThere1'] : '';
    }
    return $this->howToGetThere1;
  }

  /**
   * @param mixed $howToGetThere1
   */
  public function setHowToGetThere1($howToGetThere1): void
  {
    if(!empty($this->howToGetThere)) {
      $howToGetThere = json_decode($this->howToGetThere, true);
      $this->howToGetThere1 = !empty($howToGetThere['howToGetThere1']) ? $howToGetThere['howToGetThere1'] : '';
    }
    $this->howToGetThere1 = $howToGetThere1;
  }

  /**
   * @return mixed
   */
  public function getHowToGetThere2()
  {
    if(empty($this->howToGetThere2) && !empty($this->howToGetThere)) {
      $howToGetThere = json_decode($this->howToGetThere, true);
      $this->howToGetThere2 =  !empty($howToGetThere['howToGetThere2']) ? $howToGetThere['howToGetThere2'] : '';
    }
    return $this->howToGetThere2;
  }

  /**
   * @param mixed $howToGetThere2
   */
  public function setHowToGetThere2($howToGetThere2): void
  {
    if(!empty($this->howToGetThere)) {
      $howToGetThere = json_decode($this->howToGetThere, true);
      $this->howToGetThere2 =  !empty($howToGetThere['howToGetThere2']) ? $howToGetThere['howToGetThere2'] : '';
    }
    $this->howToGetThere2 = $howToGetThere2;
  }

  /**
   * @return mixed
   */
  public function getHowToGetThere3()
  {
    if(empty($this->howToGetThere3) && !empty($this->howToGetThere)) {
      $howToGetThere = json_decode($this->howToGetThere, true);
      $this->howToGetThere3 = !empty($howToGetThere['howToGetThere3']) ? $howToGetThere['howToGetThere3'] : '';
    }
    return $this->howToGetThere3;
  }

  /**
   * @param mixed $howToGetThere3
   */
  public function setHowToGetThere3($howToGetThere3): void
  {
    if(!empty($this->howToGetThere)) {
      $howToGetThere = json_decode($this->howToGetThere, true);
      $this->howToGetThere3 = !empty($howToGetThere['howToGetThere3']) ? $howToGetThere['howToGetThere3'] : '';
    }
    $this->howToGetThere3 = $howToGetThere3;
  }

  /**
   * @return mixed
   */
  public function getParkingAddresses1()
  {
    if(empty($this->parkingAddresses1) &&!empty($this->parkingAddresses)) {
      $parkingAddresses = json_decode($this->parkingAddresses, true);
      $this->parkingAddresses1 = !empty($parkingAddresses['parkingAddresses1']) ? $parkingAddresses['parkingAddresses1'] : '';
    }
    return $this->parkingAddresses1;
  }

  /**
   * @param mixed $parkingAddresses1
   */
  public function setParkingAddresses1($parkingAddresses1): void
  {
    if(!empty($this->parkingAddresses)) {
      $parkingAddresses = json_decode($this->parkingAddresses, true);
      $this->parkingAddresses1 = !empty($parkingAddresses['parkingAddresses1']) ? $parkingAddresses['parkingAddresses1'] : '';
    }
    $this->parkingAddresses1 = $parkingAddresses1;
  }

  /**
   * @return mixed
   */
  public function getParkingAddresses2()
  {
    if(empty($this->parkingAddresses2) && !empty($this->parkingAddresses)) {
      $parkingAddresses = json_decode($this->parkingAddresses, true);
      $this->parkingAddresses2 = !empty($parkingAddresses['parkingAddresses2']) ? $parkingAddresses['parkingAddresses2'] : '';
    }
    return $this->parkingAddresses2;
  }

  /**
   * @param mixed $parkingAddresses2
   */
  public function setParkingAddresses2($parkingAddresses2): void
  {
    if(!empty($this->parkingAddresses)) {
      $parkingAddresses = json_decode($this->parkingAddresses, true);
      $this->parkingAddresses2 = !empty($parkingAddresses['parkingAddresses2']) ? $parkingAddresses['parkingAddresses2'] : '';
    }
    $this->parkingAddresses2 = $parkingAddresses2;
  }

  /**
   * @return mixed
   */
  public function getParkingAddresses3()
  {
    if(empty($this->parkingAddresses3) && !empty($this->parkingAddresses)) {
      $parkingAddresses = json_decode($this->parkingAddresses, true);
      $this->parkingAddresses3 = !empty($parkingAddresses['parkingAddresses3']) ? $parkingAddresses['parkingAddresses3'] : '';
    }
    return $this->parkingAddresses3;
  }

  /**
   * @param mixed $parkingAddresses3
   */
  public function setParkingAddresses3($parkingAddresses3): void
  {
    if(!empty($this->parkingAddresses)) {
      $parkingAddresses = json_decode($this->parkingAddresses, true);
      $this->parkingAddresses3 = !empty($parkingAddresses['parkingAddresses3']) ? $parkingAddresses['parkingAddresses3'] : '';
    }
    $this->parkingAddresses3 = $parkingAddresses3;
  }

  /**
   * @return mixed
   */
  public function getParkingAddressArr()
  {
    return [$this->getParkingAddresses1(), $this->getParkingAddresses2(), $this->getParkingAddresses3()];
  }

  /**
   * @return mixed
   */
  public function getWifiName()
  {
    if(empty($this->wifiName) && !empty($this->wifiInfo)) {
      $wifiInfo = json_decode($this->wifiInfo, true);
      $this->wifiName = !empty($wifiInfo['wifiName']) ? $wifiInfo['wifiName'] : '';
    }
    return $this->wifiName;
  }

  /**
   * @param mixed $wifiName
   */
  public function setWifiName($wifiName): void
  {
    if(!empty($this->wifiInfo)) {
      $wifiInfo = json_decode($this->wifiInfo, true);
      $this->wifiName = !empty($wifiInfo['wifiName']) ? $wifiInfo['wifiName'] : '';
    }
    $this->wifiName = $wifiName;
  }

  /**
   * @return mixed
   */
  public function getWifiPass()
  {
    if(empty($this->wifiPass) && !empty($this->wifiInfo)) {
      $wifiInfo = json_decode($this->wifiInfo, true);
      $this->wifiPass = !empty($wifiInfo['wifiPass']) ? $wifiInfo['wifiPass'] : '';
    }
    return $this->wifiPass;
  }

  /**
   * @param mixed $wifiPass
   */
  public function setWifiPass($wifiPass): void
  {
    if(!empty($this->wifiInfo)) {
      $wifiInfo = json_decode($this->wifiInfo, true);
      $this->wifiPass = !empty($wifiInfo['wifiPass']) ? $wifiInfo['wifiPass'] : '';
    }
    $this->wifiPass = $wifiPass;
  }

  /**
   * @return mixed
   */
  public function getHowToGetThereArr()
  {
    return [$this->getHowToGetThere1(), $this->getHowToGetThere2(), $this->getHowToGetThere3()];
  }

  /**
   * @return mixed
   */
  public function getCountryName()
  {
    return $this->countryName;
  }

  /**
   * @param mixed $countryName
   */
  public function setCountryName($countryName)
  {
    $this->countryName = $countryName;
  }

  /**
   * @return mixed
   */
  public function getCityName()
  {
    return $this->cityName;
  }

  /**
   * @param mixed $cityName
   */
  public function setCityName($cityName)
  {
    $this->cityName = $cityName;
  }

  public function getAvgRating()
  {
    return $this->avgRating;
  }

  public function setAvgRating($avgRating): void
  {
    $this->avgRating = $avgRating;
  }

  public function getTotalRating()
  {
    return $this->totalRating;
  }

  public function setTotalRating($totalRating): void
  {
    $this->totalRating = $totalRating;
  }

  /**
   * @return mixed
   */
  public function getGeoLocation()
  {
    if ($this->lat && $this->lng) {
      return "{$this->lat},{$this->lng}";
    }

    return null;
  }

  /**
   * @return array
   */
  public function decorate() {
    return [
      'id' => $this->id,
      'is_open' => $this->isOpen,
      'address' => $this->address,
      'lat' => $this->lat,
      'lng' => $this->lng,
      'status' => $this->status,
      'code' => $this->code,
      'name' => $this->name,
      'pictures' => array_values(array_map(function(PropertyPicture $picture) {
        return [
          'uri' => $picture->getFileKey(),
          'id' => $picture->getId()
        ];
      }, $this->getPictures()->toArray()))
    ];
  }
}
