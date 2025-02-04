<?php
namespace App\Bundle\UserBundle\Entity;
use App\Bundle\UserBundle\Utils\RolesUtil;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
//#[ORM\Entity(repositoryClass: App\Bundle\UserBundle\Repository\UserRepository::class)]
#[ORM\Table(name: "th_user")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 256, nullable: true)]
    private ?string $slug = null;

    #[ORM\Column(type: "string", length: 256)]
    #[Assert\NotBlank]
    private string $username;

    #[ORM\Column(type: "string", length: 128, unique: true)]
    #[Assert\Email]
    #[Assert\NotBlank]
    private string $email;

    #[ORM\Column(type: "string", length: 256)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    private string $password;

    #[ORM\Column(type: "string", length: 256, nullable: true)]
    private ?string $fullName = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $roleId = null;

    #[ORM\Column(type: "string", length: 256, nullable: true)]
    private ?string $hashToken = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $expiredTokenAt = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $expiredOtpAt = null;

    #[ORM\Column(type: "integer")]
    private int $status;

    #[ORM\Column(type: "string", length: 8, nullable: true)]
    private ?string $countryCode = null;

    #[ORM\Column(type: "string", length: 10, nullable: true)]
    private ?string $otp = null;

    #[ORM\Column(type: "string", length: 128, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: "string", length: 512, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(type: "string", length: 256, nullable: true)]
    private ?string $resetToken = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $resetTokenExpiresAt = null;



    public function __construct()
    {

    }
    public function getRoles(): array {
        if(!empty($this->roleId)) {
            $role = $this->roleId;
            $roles[] = RolesUtil::ROLE_MAPPING_KEY[$this->roleId];
        }
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
        return $this->password;
    }

    public function setPassword($password): void {
        $this->password = $password;
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

    /**
     * @return \DateTimeInterface|null
     */
    public function getExpiredOtpAt(): ?\DateTimeInterface
    {
        return $this->expiredOtpAt;
    }

    /**
     * @param \DateTimeInterface|null $expiredOtpAt
     */
    public function setExpiredOtpAt(?\DateTimeInterface $expiredOtpAt): void
    {
        $this->expiredOtpAt = $expiredOtpAt;
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): self
    {
        $this->resetToken = $resetToken;
        return $this;
    }

    public function getResetTokenExpiresAt(): ?\DateTimeInterface
    {
        return $this->resetTokenExpiresAt;
    }

    public function setResetTokenExpiresAt(?\DateTimeInterface $resetTokenExpiresAt): self
    {
        $this->resetTokenExpiresAt = $resetTokenExpiresAt;
        return $this;
    }

    public function isResetTokenValid(): bool
    {
        return $this->resetTokenExpiresAt !== null && $this->resetTokenExpiresAt > new \DateTime();
    }

}

