<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="attachment")
 * @ORM\Entity
 */
class Attachment
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column
     * @Groups({"api"})
     * @Type("string")
     */
    private $name;

    /**
     * @ORM\Column(length=32)
     */
    private $extension;

    /**
     * @ORM\Column
     */
    private $originalName;

    /**
     * @Assert\NotBlank(message="core_attachment.file.blank", groups={"Verify"})
     * @Assert\File(
     *  maxSize="6M",
     *  mimeTypes={
     *      "image/jpeg",
     *      "image/png",
     *      "application/pdf",
     *      "application/x-pdf",
     *      "application/msword",
     *      "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
     *  },
     *  mimeTypesMessage="core_attachment.file.mime_type",
     *  groups={"Verify"}
     * )
     */
    private $file;

    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;
        return $this;
    }

    public function getOriginalName()
    {
        return $this->originalName;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getFullName()
    {
        // may be without extension
        return $this->name . rtrim('.' . $this->extension, '.');
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
}
