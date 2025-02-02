<?php

namespace UserBundle\Entity;

use AppBundle\Entity\AbstractEntity;
use CompanyBundle\Entity\PropertyCompany;
use CompanyBundle\Entity\PropertyCompanyUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use UserBundle\Utils\RolesUtil;

/**
 * User
 *
 * @ORM\Table(name="tbl_user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends AbstractEntity implements AdvancedUserInterface, \Serializable
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", length=11)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="slug", type="string", length=256, nullable=true)
   */
  private $slug;

  /**
   * @var string
   *
   * @ORM\Column(name="username", type="string", length=256, unique=true)
   */
  private $username;

  /**
   * @var string
   *
   * @ORM\Column(name="password", type="string", length=256, nullable=true)
   */
  private $password;

  /**
   * @var string
   *
   * @ORM\Column(name="full_name", type="string", length=512, nullable=true)
   */
  private $fullName;

  /**
   * @var integer
   *
   * @ORM\Column(name="role_id", type="integer", nullable=true)
   */
  private $roleId;

  /**
   * @var string
   *
   * @ORM\Column(name="hash_token", type="string", length=256, nullable=true)
   */
  private $hashToken;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="expired_token_at", type="datetime", nullable=true)
   */
  private $expiredTokenAt;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="expired_otp_at", type="datetime", nullable=true)
   */
  private $expireOtpAt;

  /**
   * @var int
   *
   * @ORM\Column(name="status", type="integer")
   */
  private $status = 0; //1: Active, 0: in-active

  /**
   * @var int
   *
   * @ORM\Column(name="is_updated_profile", type="integer", nullable=true)
   */
  private $isUpdateProfile = 1; //0: No, 1: Yes

  /**
   *
   * @ORM\Column(name="country_code", type="string", length=8, nullable=true)
   */
  private $countryCode;

  /**
   *
   * @ORM\Column(name="otp", type="string", length=10, nullable=true)
   */
  private $otp;

  /**
   *
   * @ORM\Column(name="phone_number", type="string", length=16, nullable=true)
   */
  private $phoneNumber;

  /**
   * @var string
   *
   * @ORM\Column(name="avatar", type="string", length=512, nullable=true)
   */
  private $avatar;

  /**
   * @ORM\OneToMany(targetEntity="PaymentBundle\Entity\PaymentInfo", mappedBy="user")
   */
  private $paymentInfos;

  /**
   * @ORM\OneToMany(targetEntity="UserBundle\Entity\CustomerPaymentGateway", mappedBy="user", cascade="persist")
   */
  private $customerPaymentGateways;

  /**
   * @ORM\OneToMany(targetEntity="CompanyBundle\Entity\PropertyCompanyUser", mappedBy="user", cascade="persist")
   */
  private $propertyCompanyUsers;

  private $companies;

  public function __construct()
  {
    parent::__construct();
    $this->paymentInfos = new ArrayCollection();
    $this->customerPaymentGateways = new ArrayCollection();
    $this->propertyCompanyUsers = new ArrayCollection();
    $this->companies = new ArrayCollection();
  }

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getSlug()
  {
    return $this->slug;
  }

  /**
   * @param string $slug
   */
  public function setSlug($slug)
  {
    $this->slug = $slug;
  }

  /**
   * @return string
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * @param string $username
   */
  public function setUsername($username)
  {
    $this->username = $username;
  }

  /**
   * @return string
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * @param string $password
   */
  public function setPassword($password)
  {
    $this->password = $password;
  }

  /**
   * @return string
   */
  public function getFullName()
  {
    return $this->fullName;
  }

  /**
   * @param string $fullName
   */
  public function setFullName($fullName)
  {
    $this->fullName = $fullName;
  }

  /**
   * @return int
   */
  public function getRoleId()
  {
    return $this->roleId;
  }

  /**
   * @param int $roleId
   */
  public function setRoleId($roleId)
  {
    $this->roleId = $roleId;
  }

  /**
   * @return string
   */
  public function getHashToken()
  {
    return $this->hashToken;
  }

  /**
   * @param string $hashToken
   */
  public function setHashToken($hashToken)
  {
    $this->hashToken = $hashToken;
  }

  /**
   * @return \DateTime
   */
  public function getExpiredTokenAt()
  {
    return $this->expiredTokenAt;
  }

  /**
   * @param \DateTime $expiredTokenAt
   */
  public function setExpiredTokenAt($expiredTokenAt)
  {
    $this->expiredTokenAt = $expiredTokenAt;
  }

  /**
   * @return int
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * @param int $status
   */
  public function setStatus($status)
  {
    $this->status = $status;
  }

  /**
   * @return mixed
   */
  public function getPhoneNumber()
  {
    return $this->phoneNumber;
  }

  /**
   * @param $phoneNumber
   */
  public function setPhoneNumber($phoneNumber)
  {
    $this->phoneNumber = $phoneNumber;
  }

  /**
   * @return ArrayCollection
   */
  public function getPaymentInfos()
  {
    return $this->paymentInfos;
  }

  /**
   * @param ArrayCollection $paymentInfos
   */
  public function setPaymentInfos($paymentInfos)
  {
    $this->paymentInfos = $paymentInfos;
  }

  /**
   * @return ArrayCollection
   */
  public function getCustomerPaymentGateways()
  {
    return $this->customerPaymentGateways;
  }

  /**
   * @param ArrayCollection $customerPaymentGateways
   */
  public function setCustomerPaymentGateways($customerPaymentGateways)
  {
    $this->customerPaymentGateways = $customerPaymentGateways;
  }

  public function addCustomerPaymentGateway(CustomerPaymentGateway $customerPaymentGateway) {
    $this->customerPaymentGateways->add($customerPaymentGateway);
    $customerPaymentGateway->setUser($this);
  }

  /**
   * @return int
   */
  public function getOtp()
  {
    return $this->otp;
  }

  /**
   * @param int $otp
   */
  public function setOtp($otp)
  {
    $this->otp = $otp;
  }

  public function getSalt()
  {
    // you *may* need a real salt depending on your encoder
    // see section on salt below
    return null;
  }

  public function getRoles()
  {
    return isset(RolesUtil::ROLE_MAPPING[$this->roleId]) ? [RolesUtil::ROLE_MAPPING[$this->roleId]] : [];
  }

  public function getRoleName()
  {
    $roles = $this->getRoles();
    return empty($roles) ? 'Anonymous' : reset($roles);
  }

  public function eraseCredentials()
  {
  }

  /** @see \Serializable::serialize() */
  public function serialize()
  {
    return serialize([
      $this->id,
      $this->username,
      $this->password,
      $this->status
    ]);
  }

  /** @see \Serializable::unserialize() */
  public function unserialize($serialized)
  {
    list (
      $this->id,
      $this->username,
      $this->password,
      $this->status
      ) = unserialize($serialized, ['allowed_classes' => false]);
  }

  public function isAccountNonExpired()
  {
    return true;
  }

  public function isAccountNonLocked()
  {
    return true;
  }

  public function isCredentialsNonExpired()
  {
    return true;
  }

  public function isEnabled()
  {
    return true;
  }

  public function __toString()
  {
    return $this->getUsername();
  }

  /**
   * @return string
   */
  public function getAvatar(): string
  {
    return $this->avatar;
  }

  /**
   * @param string $avatar
   */
  public function setAvatar(string $avatar): void
  {
    $this->avatar = $avatar;
  }

  /**
   * @return \DateTime
   */
  public function getExpireOtpAt(): \DateTime
  {
    return $this->expireOtpAt;
  }

  /**
   * @param \DateTime $expireOtpAt
   */
  public function setExpireOtpAt(\DateTime $expireOtpAt): void
  {
    $this->expireOtpAt = $expireOtpAt;
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
  public function setCountryCode($countryCode): void
  {
    $this->countryCode = $countryCode;
  }

  public function getIsUpdateProfile()
  {
    return $this->isUpdateProfile;
  }

  public function setIsUpdateProfile(int $isUpdateProfile): void
  {
    $this->isUpdateProfile = $isUpdateProfile;
  }

  /**
   * @return ArrayCollection
   */
  public function getPropertyCompanyUsers()
  {
    return $this->propertyCompanyUsers;
  }

  /**
   * @param ArrayCollection $propertyCompanyUsers
   */
  public function setPropertyCompanyUsers($propertyCompanyUsers)
  {
    $this->propertyCompanyUsers = $propertyCompanyUsers;
  }

  public function addPropertyCompanyUser(PropertyCompanyUser $propertyCompanyUser)
  {
    $this->propertyCompanyUsers->add($propertyCompanyUser);
    $propertyCompanyUser->setUser($this);
  }

  /**
   * @return mixed
   */
  public function getCompanies()
  {
    $propertyCompanyUsers = $this->getPropertyCompanyUsers();

    /**
     * @var PropertyCompanyUser $propertyCompanyUser
     */
    foreach ($propertyCompanyUsers as $propertyCompanyUser) {
      $this->companies->add($propertyCompanyUser->getCompany());
    }

    return $this->companies;
  }

  /**
   * @param mixed $companies
   */
  public function setCompanies($companies)
  {
    $this->companies = $companies;
  }


  public function addCompany(PropertyCompany $propertyCompany)
  {
    $propertyCompanyUser = new PropertyCompanyUser();
    $propertyCompanyUser->setCompany($propertyCompany);
    $this->addPropertyCompanyUser($propertyCompanyUser);
  }
}

