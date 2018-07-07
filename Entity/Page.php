<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="pages")
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Groups({"api"})
     * @Type("integer")
     */
    private $id;

    /**
     * @ORM\Column(length=100)
     * @Groups({"api"})
     * @Type("string")
     */
    private $path;

    /**
     * @Gedmo\Translatable
     * @ORM\Column(length=128)
     * @Groups({"api"})
     * @Type("string")
     */
    private $title;

    /**
     * @Gedmo\Translatable
     * @ORM\Column(length=512)
     * @Groups({"api"})
     * @Type("string")
     */
    private $description;

    /**
     * @Gedmo\Translatable
     * @ORM\Column(type="text")
     * @Groups({"api"})
     * @Type("string")
     */
    private $html;

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setHtml($html)
    {
        $this->html = $html;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
