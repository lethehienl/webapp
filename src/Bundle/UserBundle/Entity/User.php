<?php

    namespace App\Bundle\UserBundle\Entity;

/*    use Symfony\Component\Security\Core\User\AdvancedUserInterface;*/
    use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
    use Symfony\Component\Security\Core\User\UserInterface;
    use UserBundle\Utils\RolesUtil;

    /**
     * User
     *
     * @ORM\Table(name="tbl_user")
     * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
     */
    class User implements UserInterface, PasswordAuthenticatedUserInterface
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

        }
        public function getRoles(): array {
            return isset(RolesUtil::ROLE_MAPPING[$this->roleId]) ? [RolesUtil::ROLE_MAPPING[$this->roleId]] : [];
        }

        public function eraseCredentials(): void  {
            //return '';
        }

        public function getUserIdentifier(): string {
            return '';
        }

        public function getPassword(): ?string {
            return '';
        }

    }

