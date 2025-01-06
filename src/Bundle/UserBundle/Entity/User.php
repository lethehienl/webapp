<?php
    namespace App\Bundle\UserBundle\Entity;

/*    use Symfony\Component\Security\Core\User\AdvancedUserInterface;*/
    use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
    use Symfony\Component\Security\Core\User\UserInterface;
    use UserBundle\Utils\RolesUtil;
    use Symfony\Component\Validator\Constraints as Assert;

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
         * @ORM\Column(name="email", type="string", length=128, unique=true)
         */
        private $email;

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


        public function __construct()
        {

        }
        public function getRoles(): array {
            $roles = $this->roles;
            // Guarantee every user at least has ROLE_USER
            $roles[] = 'ROLE_USER';

            return array_unique($roles);
            /*return isset(RolesUtil::ROLE_MAPPING[$this->roleId]) ? [RolesUtil::ROLE_MAPPING[$this->roleId]] : [];*/
        }

        public function eraseCredentials(): void  {
            //return '';
        }

        public function getUserIdentifier(): string {
            return $this->email;
        }

        public function getPassword(): ?string {
            return '';
        }

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id;
        }

        /**
         * @param int $id
         */
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        /**
         * @return string
         */
        public function getSlug(): string
        {
            return $this->slug;
        }

        /**
         * @param string $slug
         */
        public function setSlug(string $slug): void
        {
            $this->slug = $slug;
        }

        /**
         * @return string
         */
        public function getUsername(): string
        {
            return $this->username;
        }

        /**
         * @param string $username
         */
        public function setUsername(string $username): void
        {
            $this->username = $username;
        }

        /**
         * @return string
         */
        public function getEmail(): string
        {
            return $this->email;
        }

        /**
         * @param string $email
         */
        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        /**
         * @return string
         */
        public function getFullName(): string
        {
            return $this->fullName;
        }

        /**
         * @param string $fullName
         */
        public function setFullName(string $fullName): void
        {
            $this->fullName = $fullName;
        }

        /**
         * @return int
         */
        public function getRoleId(): int
        {
            return $this->roleId;
        }

        /**
         * @param int $roleId
         */
        public function setRoleId(int $roleId): void
        {
            $this->roleId = $roleId;
        }

        /**
         * @return string
         */
        public function getHashToken(): string
        {
            return $this->hashToken;
        }

        /**
         * @param string $hashToken
         */
        public function setHashToken(string $hashToken): void
        {
            $this->hashToken = $hashToken;
        }

        /**
         * @return \DateTime
         */
        public function getExpiredTokenAt(): \DateTime
        {
            return $this->expiredTokenAt;
        }

        /**
         * @param \DateTime $expiredTokenAt
         */
        public function setExpiredTokenAt(\DateTime $expiredTokenAt): void
        {
            $this->expiredTokenAt = $expiredTokenAt;
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
         * @return int
         */
        public function getStatus(): int
        {
            return $this->status;
        }

        /**
         * @param int $status
         */
        public function setStatus(int $status): void
        {
            $this->status = $status;
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

        /**
         * @return mixed
         */
        public function getOtp()
        {
            return $this->otp;
        }

        /**
         * @param mixed $otp
         */
        public function setOtp($otp): void
        {
            $this->otp = $otp;
        }

        /**
         * @return mixed
         */
        public function getPhoneNumber()
        {
            return $this->phoneNumber;
        }

        /**
         * @param mixed $phoneNumber
         */
        public function setPhoneNumber($phoneNumber): void
        {
            $this->phoneNumber = $phoneNumber;
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



    }

