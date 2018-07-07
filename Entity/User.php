<?php

namespace Btc\CoreBundle\Entity;

use Btc\CoreBundle\Model\LoggableActivityInterface;
use Btc\CoreBundle\Validator\Constraints as BtcAssert;
use Btc\CoreBundle\Validator\Constraints\TotpProviderInterface;
use Btc\CoreBundle\Validator\Constraints\HotpProviderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @DoctrineAssert\UniqueEntity(fields={"username"}, message="core_user.username.already_used", groups={"api_signup"})
 * @DoctrineAssert\UniqueEntity(fields={"email"}, message="core_user.email.already_used", groups={"api_signup"})
 * @BtcAssert\Totp(message="core_user.two_factor.invalid", groups={"2FA"})
 */
class User implements
    UserInterface,
    LoggableActivityInterface,
    TotpProviderInterface,
    HotpProviderInterface,
    RestEntityInterface,
    \Serializable
{
    const ADMIN_LIMITED = 'ROLE_ADMIN_LIMITED';
    const ADMIN = 'ROLE_ADMIN';
    const VERIFIED_PERSONAL = 'ROLE_VERIFIED_PERSONAL';
    const VERIFIED_BUSINESS = 'ROLE_VERIFIED_BUSINESS';
    const FORCE_CHANGE_PASSWORD = 'ROLE_FORCE_CHANGE_PASSWORD';
    const BLOCKED = 'ROLE_BLOCKED';
    const EXCHANGER = 'ROLE_EXCHANGER';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Groups({"api"})
     * @Type("integer")
     */
    private $id;

    /**
     * @ORM\Column(length=255, unique=true)
     * @Groups({"api_vouchers"})
     * @Type("string")
     */
    private $username;

    /**
     * @ORM\Column(length=255, unique=true)
     * @Assert\NotBlank(message="core_user.email.blank", groups={"api", "api_signup"})
     * @Assert\Email(message="core_user.email.invalid", groups={"api", "api_signup"})
     * @BtcAssert\NotAllowedEmails(groups={"api_signup"})
     * @Groups({"api"})
     * @Type("string")
     */
    private $email;

    /**
     * @ORM\Column
     */
    private $salt;

    /**
     * Encrypted password. Must be persisted.
     *
     * @ORM\Column
     */
    private $password;

    /**
     * @SecurityAssert\UserPassword(message="core_user.current_password.invalid", groups={"Change"})
     */
    private $currentPassword;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @Assert\NotBlank(message="core_user.password.blank", groups={"Change"})
     * @Assert\Length(
     *   min=8,
     *   max=4096,
     *   minMessage="core_user.password.short",
     *   maxMessage="core_user.password.long",
     *   groups={"Change"}
     * )
     * @BtcAssert\Password(groups={"Change"})
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="confirmation_token", nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\Column(name="confirmation_token_expires_at", type="datetime", nullable=true)
     */
    private $confirmationTokenExpiresAt;

    /**
     * @ORM\Column(type="smallint", name="confirmation_retries", nullable=true)
     */
    private $confirmationRetries;

    /**
     * Values ROLE_ADMIN_LIMITED, ROLE_ADMIN, ROLE_VERIFIED_PERSONAL, ROLE_VERIFIED_BUSINESS, ROLE_BLOCKED, ROLE_EXCHANGER, ROLE_FORCE_CHANGE_PASSWORD
     *
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\Column(name="auth_key", length=50, nullable=true)
     */
    private $auth_key;

    /**
     * @ORM\Column(name="hotp_auth_key", length=50, nullable=true)
     */
    private $hotpAuthKey;

    /**
     * @ORM\Column(name="hotp_auth_counter", type="integer", nullable=true)
     */
    private $hotpAuthCounter;

    /**
     * @ORM\Column(type="smallint", name="hotp_sent_times", nullable=true)
     */
    private $hotpSentTimes;

    /**
     * @ORM\OneToMany(targetEntity="Wallet", mappedBy="user", cascade={"persist", "remove"})
     * @Groups({"api"})
     * @Type("array<Btc\CoreBundle\Entity\Wallet>")
     * @var ArrayCollection
     */
    private $wallets;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="user", cascade={"persist", "remove"})
     * @var ArrayCollection
     */
    private $activities;

    /**
     * @ORM\OneToMany(targetEntity="UserPreference", mappedBy="user", cascade={"persist", "remove"})
     * @var ArrayCollection
     */
    private $preferences;

    /**
     * @ORM\OneToMany(targetEntity="UserAddress", mappedBy="user", cascade={"persist", "remove"})
     * @var ArrayCollection
     */
    private $addresses;

    /**
     * @ORM\OneToOne(targetEntity="Verification", mappedBy="user", cascade={"persist", "remove"})
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Verification")
     */
    private $verification;

    /**
     * @ORM\Column(name="auth_token", type="text", nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="pin", type="string", length=10, nullable=true)
     */
    private $pin;

    private $auth_code;

    private $feeSet;

    public function __construct()
    {
        $this->wallets = new ArrayCollection();
        $this->activities = new ArrayCollection();
        $this->preferences = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->active = false;
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->roles = ['ROLE_USER'];
        $this->pin = '';
        $this->token = '';
    }

    public function setCurrentPassword($currentPassword)
    {
        $this->currentPassword = $currentPassword;
        return $this;
    }

    public function getCurrentPassword()
    {
        return $this->currentPassword;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }
        return $this;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setConfirmationTokenExpiresAt(\DateTime $confirmationTokenExpiresAt = null)
    {
        $this->confirmationTokenExpiresAt = $confirmationTokenExpiresAt;
        return $this;
    }

    public function getConfirmationTokenExpiresAt()
    {
        return $this->confirmationTokenExpiresAt;
    }

    public function setConfirmationRetries($confirmationRetries)
    {
        $this->confirmationRetries = $confirmationRetries;
        return $this;
    }

    public function increaseConfirmationRetries()
    {
        if ($this->confirmationRetries) {
            $this->confirmationRetries++;
        } else {
            $this->confirmationRetries = 1;
        }
        return $this;
    }

    public function resetConfirmationRetries()
    {
        $this->confirmationRetries = null;
        return $this;
    }

    public function getConfirmationRetries()
    {
        return $this->confirmationRetries;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        // we need to make sure to have at least one role
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    public function setRoles(array $roles)
    {
        $this->roles = array();

        foreach ($roles as $role) {
            $this->addRole($role);
        }

        return $this;
    }

    public function addRole($role)
    {
        $role = strtoupper($role);
        if ($role === 'ROLE_USER') {
            return $this;
        }

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    public function __toString()
    {
        return (string) $this->username . '_' . $this->id;
    }

    public function setAuthKey($key)
    {
        $this->auth_key = $key;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param mixed $otp
     */
    public function setAuthCode($otp)
    {
        $this->auth_code = $otp;
    }

    /**
     * @return mixed
     */
    public function getAuthCode()
    {
        return $this->auth_code;
    }

    /**
     * @return bool
     */
    public function hasOTP()
    {
        return $this->hasTOTP();
    }

    public function hasTOTP()
    {
        return ($this->auth_key != null);
    }

    public function setHotpAuthKey($hotpAuthKey)
    {
        $this->hotpAuthKey = $hotpAuthKey;
        return $this;
    }

    public function getHotpAuthKey()
    {
        return $this->hotpAuthKey;
    }

    public function setHotpAuthCounter($hotpAuthCounter)
    {
        $this->hotpAuthCounter = $hotpAuthCounter;
        return $this;
    }

    public function getHotpAuthCounter()
    {
        return $this->hotpAuthCounter;
    }

    public function setHotpSentTimes($hotpSentTimes)
    {
        $this->hotpSentTimes = $hotpSentTimes;
        return $this;
    }

    public function getHotpSentTimes()
    {
        return (int)$this->hotpSentTimes;
    }

    public function hasHOTP()
    {
        return ($this->hotpAuthKey != null);
    }

    public function isActive()
    {
        return (bool) $this->active;
    }

    public function setActive()
    {
        $this->active = true;
    }

    /**
     * @param Wallet $wallet
     */
    public function addWallet(Wallet $wallet)
    {
        $this->wallets->add($wallet);
        $wallet->setUser($this);
    }

    /**
     * @param $currencyCode
     * @return Wallet|null
     */
    public function getWalletForCurrency($currencyCode)
    {
        foreach($this->wallets as $wallet)
        {
            /** @var Wallet $wallet */
            if ($wallet->getCurrency()->getCode() === $currencyCode) {
                return $wallet;
            }
        }
        return null;
    }

    /**
     * @return ArrayCollection
     */
    public function getWallets()
    {
        return $this->wallets;
    }

    public function addActivity(Activity $activity)
    {
        $this->activities->add($activity);
        $activity->setUser($this);
    }

    public function getActivities()
    {
        return $this->activities;
    }

    public function addPreference(UserPreference $preference)
    {
        $this->preferences->add($preference);
        $preference->setUser($this);
    }

    public function getPreferences()
    {
        return $this->preferences;
    }

    public function setVerification(Verification $verification)
    {
        $this->verification = $verification;
        return $this;
    }

    /**
     * @return Verification
     */
    public function getVerification()
    {
        return $this->verification;
    }

    /**
     * Serializes the user.
     *
     * The serialized data have to contain the fields used by the equals method and the username.
     *
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->username,
            $this->active,
            $this->email,
            $this->id,
        ));
    }

    /**
     * @return bool whether the user is verified
     */
    public function isVerified()
    {
        return $this->hasRole(self::VERIFIED_PERSONAL) || $this->hasRole(self::VERIFIED_BUSINESS);
    }

    /**
     * Unserializes the user.
     *
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->username,
            $this->active,
            $this->email,
            $this->id
        ) = $data;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getFeeSet()
    {
        return $this->feeSet;
    }

    public function setFeeSet($feeSet)
    {
        $this->feeSet = $feeSet;
    }

    public function getPin()
    {
        return $this->pin;
    }

    public function setPin($pin)
    {
        $this->pin = $pin;
    }

    public function isBlocked()
    {
        return $this->hasRole(self::BLOCKED);
    }

    public function isAllowedGenerateVoucher()
    {
        return $this->hasRole(self::EXCHANGER);
    }

    public function getAddresses()
    {
        return $this->addresses;
    }

    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;
    }
}