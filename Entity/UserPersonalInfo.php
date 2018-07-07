<?php

namespace Btc\CoreBundle\Entity;

use Btc\CoreBundle\Helper\UserInfo;
use Btc\CoreBundle\Validator\Constraints as BtcAssert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="user_personal_info")
 * @ORM\Entity
 */
class UserPersonalInfo extends UserInfo
{
    const CLASS_NAME = 'personalInfo';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @BtcAssert\RestrictedCountry(message="core_user.country.restricted", groups={"api"})
     * @Assert\NotBlank(message="core_user.country.blank", groups={"api"})
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Country")
     */
    private $country;

    /**
     * @ORM\Column(length=64, nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $phone;

    /**
     * @Assert\NotBlank(message="core_user.birthdate.blank", groups={"api"})
     * @Assert\Date(message="core_user.birthdate.invalid", groups={"api"})
     * @ORM\Column(type="date", nullable=true, name="birthdate")
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $birthDate;

    /**
     * @Assert\NotBlank(message="core_user.address.blank", groups={"api"})
     * @ORM\Column(length=255, nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $address;

    /**
     * @Assert\NotBlank(message="core_user.city.blank", groups={"api"})
     * @ORM\Column(length=255, nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $city;

    /**
     * @Assert\NotBlank(message="core_user.zip.blank", groups={"api"})
     * @ORM\Column(name="zip_code", length=64, nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $zipCode;

    /**
     * @ORM\Column(length=255, nullable=true, name="firstname")
     * @Assert\NotBlank(message="core_user.firstname.blank", groups={ "api", "api_signup"})
     * @Groups({"api"})
     * @Type("string")
     */
    private $firstName;

    /**
     * @ORM\Column(length=255, nullable=true, name="lastname")
     * @Assert\NotBlank(message="core_user.lastname.blank", groups={"api", "api_signup"})
     * @Groups({"api"})
     * @Type("string")
     */
    private $lastName;

    /**
     * Default 0 - Unsubmitted. 1 - Declined, 2 - Pending, 3 - Approved
     *
     * @ORM\Column(name="status", type="smallint")
     * @Groups({"api"})
     * @Type("string")
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="Attachment")
     * @ORM\JoinColumn(name="id_photo_attachment_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Attachment")
     */
    private $idPhoto;

    /**
     * @ORM\OneToOne(targetEntity="Attachment")
     * @ORM\JoinColumn(name="residence_proof_attachment_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Attachment")
     */
    private $residenceProof;

    /**
     * @ORM\OneToOne(targetEntity="Attachment")
     * @ORM\JoinColumn(name="id_back_attachment_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Attachment")
     */
    private $idBackSide;

    /**
     * @ORM\Column(type="text", name="reason_declined", nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $reasonDeclined;

    private $idPhotoContent;
    private $idPhotoName;

    private $residenceProofContent;
    private $residenceProofName;

    private $idBackSideContent;
    private $idBackSideName;

    public function __construct()
    {
        $this->status = self::STATUS_UNSUBMITTED;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdPhoto()
    {
        return $this->idPhoto;
    }

    public function setIdPhoto($idPhoto)
    {
        $this->idPhoto = $idPhoto;
    }

    public function getIdPhotoName()
    {
        return $this->idPhotoName;
    }

    public function setIdPhotoName($idPhotoName)
    {
        $this->idPhotoName = $idPhotoName;
    }

    public function getResidenceProof()
    {
        return $this->residenceProof;
    }

    public function setResidenceProof($residenceProof)
    {
        $this->residenceProof = $residenceProof;
    }

    public function getResidenceProofName()
    {
        return $this->residenceProofName;
    }

    public function setResidenceProofName($residenceProofName)
    {
        $this->residenceProofName = $residenceProofName;
    }

    public function getIdBackSide()
    {
        return $this->idBackSide;
    }

    public function setIdBackSide($idBackSide)
    {
        $this->idBackSide = $idBackSide;
    }

    public function getIdBackSideName()
    {
        return $this->idBackSideName;
    }

    public function setIdBackSideName($idBackSideName)
    {
        $this->idBackSideName = $idBackSideName;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getIdPhotoContent()
    {
        return $this->idPhotoContent;
    }

    public function setIdPhotoContent($idPhotoContent)
    {
        $this->idPhotoContent = $idPhotoContent;
    }

    public function getResidenceProofContent()
    {
        return $this->residenceProofContent;
    }

    public function setResidenceProofContent($residenceProofContent)
    {
        $this->residenceProofContent = $residenceProofContent;
    }

    public function getIdBackSideContent()
    {
        return $this->idBackSideContent;
    }

    public function setIdBackSideContent($idBackSideContent)
    {
        $this->idBackSideContent = $idBackSideContent;
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isDeclined()
    {
        return $this->status === self::STATUS_DECLINED;
    }

    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isUnsubmitted()
    {
        return $this->status === self::STATUS_UNSUBMITTED;
    }

    public function setReasonDeclined($reasonDeclined)
    {
        $this->reasonDeclined = $reasonDeclined;

        return $this;
    }

    public function getReasonDeclined()
    {
        return $this->reasonDeclined;
    }

    public function getType()
    {
        return self::TYPE_PERSONAL;
    }

    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
