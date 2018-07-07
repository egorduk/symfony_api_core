<?php

namespace Btc\CoreBundle\Entity;

use Btc\CoreBundle\Helper\UserInfo;
use Btc\CoreBundle\Validator\Constraints as BtcAssert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="user_business_info")
 * @ORM\Entity
 */
class UserBusinessInfo extends UserInfo
{
    const CLASS_NAME = 'businessInfo';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @Assert\NotBlank(message="core_business_info.company_name.blank", groups={"api"})
     * @ORM\Column(name="company_name", nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $companyName;

    /**
     * @Assert\NotBlank(message="core_business_info.vat_id.blank", groups={"api"})
     * @ORM\Column(name="vat_id", nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $vatId;

    /**
     * @Assert\NotBlank(message="core_business_info.registration_number.blank", groups={"api"})
     * @ORM\Column(name="registration_number", nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $registrationNumber;

    /**
     * @BtcAssert\RestrictedCountry(message="core_user.country.restricted", groups={"api"})
     * @Assert\NotBlank(message="core_business_info.country.blank", groups={"api"})
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Country")
     */
    private $country;

    /**
     * @Assert\NotBlank(message="core_business_info.state.blank", groups={"api"})
     * @ORM\Column(length=255, nullable=true, name="state")
     * @Groups({"api"})
     * @Type("string")
     */
    private $state;

    /**
     * @Assert\NotBlank(message="core_business_info.city.blank", groups={"api"})
     * @ORM\Column(length=255, nullable=true, name="city")
     * @Groups({"api"})
     * @Type("string")
     */
    private $city;

    /**
     * @Assert\NotBlank(message="core_business_info.street.blank", groups={"api"})
     * @ORM\Column(length=255, nullable=true, name="street")
     * @Groups({"api"})
     * @Type("string")
     */
    private $street;

    /**
     * @Assert\NotBlank(message="core_business_info.building.blank", groups={"api"})
     * @ORM\Column(length=255, nullable=true, name="building")
     * @Groups({"api"})
     * @Type("string")
     */
    private $building;

    /**
     * @Assert\NotBlank(message="core_business_info.zip_code.blank", groups={"api"})
     * @ORM\Column(name="zip_code", length=64, nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $zipCode;

    /**
     * @ORM\Column(name="office_number", length=64, nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $officeNumber;

    /**
     * @ORM\OneToOne(targetEntity="Attachment")
     * @ORM\JoinColumn(name="company_details_1_attachment_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Attachment")
     */
    private $companyDetails1;

    /**
     * @ORM\OneToOne(targetEntity="Attachment")
     * @ORM\JoinColumn(name="company_details_2_attachment_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Attachment")
     */
    private $companyDetails2;

    /**
     * @ORM\OneToOne(targetEntity="Attachment")
     * @ORM\JoinColumn(name="company_details_3_attachment_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Attachment")
     */
    private $companyDetails3;

    /**
     * @ORM\OneToOne(targetEntity="Attachment")
     * @ORM\JoinColumn(name="company_details_4_attachment_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Attachment")
     */
    private $companyDetails4;

    /**
     * Default 0 - Unsubmitted. 1 - Declined, 2 - Pending, 3 - Approved
     *
     * @ORM\Column(name="status", type="smallint")
     * @Groups({"api"})
     * @Type("string")
     */
    private $status;

    /**
     * Reason for declined.
     *
     * @ORM\Column(type="text", name="reason_declined", nullable=true)
     * @Groups({"api"})
     * @Type("string")
     */
    private $reasonDeclined;

    private $companyDetails1Content;
    private $companyDetails1Name;
    private $companyDetails2Content;
    private $companyDetails2Name;
    private $companyDetails3Content;
    private $companyDetails3Name;
    private $companyDetails4Content;
    private $companyDetails4Name;

    public function __construct()
    {
        $this->status = self::STATUS_UNSUBMITTED;
    }

    public function setVatId($vatId)
    {
        $this->vatId = $vatId;
        return $this;
    }

    public function getVatId()
    {
        return $this->vatId;
    }

    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $building
     */
    public function setBuilding($building)
    {
        $this->building = $building;
    }

    /**
     * @return string
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $officeNumber
     */
    public function setOfficeNumber($officeNumber)
    {
        $this->officeNumber = $officeNumber;
    }

    /**
     * @return string
     */
    public function getOfficeNumber()
    {
        return $this->officeNumber;
    }

    /**
     * @param string $registrationNumber
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
    }

    /**
     * @return string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $companyDetails1
     */
    public function setCompanyDetails1($companyDetails1)
    {
        $this->companyDetails1 = $companyDetails1;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails1()
    {
        return $this->companyDetails1;
    }

    /**
     * @param mixed $companyDetails2
     */
    public function setCompanyDetails2($companyDetails2)
    {
        $this->companyDetails2 = $companyDetails2;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails2()
    {
        return $this->companyDetails2;
    }

    /**
     * @param mixed $companyDetails3
     */
    public function setCompanyDetails3($companyDetails3)
    {
        $this->companyDetails3 = $companyDetails3;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails3()
    {
        return $this->companyDetails3;
    }

    /**
     * @param mixed $companyDetails4
     */
    public function setCompanyDetails4($companyDetails4)
    {
        $this->companyDetails4 = $companyDetails4;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails4()
    {
        return $this->companyDetails4;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails1Content()
    {
        return $this->companyDetails1Content;
    }

    /**
     * @param mixed $companyDetails1Content
     */
    public function setCompanyDetails1Content($companyDetails1Content)
    {
        $this->companyDetails1Content = $companyDetails1Content;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails1Name()
    {
        return $this->companyDetails1Name;
    }

    /**
     * @param mixed $companyDetails1Name
     */
    public function setCompanyDetails1Name($companyDetails1Name)
    {
        $this->companyDetails1Name = $companyDetails1Name;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails2Content()
    {
        return $this->companyDetails2Content;
    }

    /**
     * @param mixed $companyDetails2Content
     */
    public function setCompanyDetails2Content($companyDetails2Content)
    {
        $this->companyDetails2Content = $companyDetails2Content;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails2Name()
    {
        return $this->companyDetails2Name;
    }

    /**
     * @param mixed $companyDetails2Name
     */
    public function setCompanyDetails2Name($companyDetails2Name)
    {
        $this->companyDetails2Name = $companyDetails2Name;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails3Content()
    {
        return $this->companyDetails3Content;
    }

    /**
     * @param mixed $companyDetails3Content
     */
    public function setCompanyDetails3Content($companyDetails3Content)
    {
        $this->companyDetails3Content = $companyDetails3Content;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails3Name()
    {
        return $this->companyDetails3Name;
    }

    /**
     * @param mixed $companyDetails3Name
     */
    public function setCompanyDetails3Name($companyDetails3Name)
    {
        $this->companyDetails3Name = $companyDetails3Name;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails4Content()
    {
        return $this->companyDetails4Content;
    }

    /**
     * @param mixed $companyDetails4Content
     */
    public function setCompanyDetails4Content($companyDetails4Content)
    {
        $this->companyDetails4Content = $companyDetails4Content;
    }

    /**
     * @return mixed
     */
    public function getCompanyDetails4Name()
    {
        return $this->companyDetails4Name;
    }

    /**
     * @param mixed $companyDetails4Name
     */
    public function setCompanyDetails4Name($companyDetails4Name)
    {
        $this->companyDetails4Name = $companyDetails4Name;
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
        return self::TYPE_BUSINESS;
    }
}
