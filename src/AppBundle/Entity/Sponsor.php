<?php
// src/AppBundle/Entity/Sponsor.php
namespace AppBundle\Entity;

use DateTime;

use Symfony\Component\Validator\Constraints as Assert,
    Symfony\Component\HttpFoundation\File\File;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use Vich\UploaderBundle\Mapping\Annotation as Vich;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper;

/**
 * @ORM\Table(name="sponsors")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SponsorRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\SponsorTranslation")
 *
 * @Vich\Uploadable
 */
class Sponsor implements Translatable
{
    const WEB_PATH = "/uploads/sponsors/logos/";

    use IdMapper;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @ORM\OneToMany(targetEntity="SponsorTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\Column(type="string", length=127, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     *
     * @Vich\UploadableField(mapping="sponsor_logo", fileNameProperty="logoName")
     */
    protected $logoFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $logoName;

    /**
     * @ORM\Column(type="string", length=511, nullable=true)
     */
    protected $link;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : "";
    }

    /* Gedmo locale methods */

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function addTranslation(ExpertTranslation $t)
    {
        $this->translations->add($t);
        $t->setObject($this);
    }

    public function removeTranslation(ExpertTranslation $t)
    {
        $this->translations->removeElement($t);
    }

    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /* END Gedmo locale methods */

    /* Vich file - logo */

    public function setLogoFile($logoFile = NULL)
    {
        $this->logoFile = $logoFile;

        if( $logoFile instanceof File )
            $this->updatedAt = new DateTime;
    }

    public function getLogoFile()
    {
        return $this->logoFile;
    }

    public function getLogoPath()
    {
        return ( $this->logoName )
            ? self::WEB_PATH.$this->logoName
            : FALSE;
    }

    /* END Vich file - logo */

    /**
     * Set title
     *
     * @param string $title
     * @return Sponsor
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set logoName
     *
     * @param string $logoName
     * @return Sponsor
     */
    public function setLogoName($logoName)
    {
        $this->logoName = $logoName;

        return $this;
    }

    /**
     * Get logoName
     *
     * @return string 
     */
    public function getLogoName()
    {
        return $this->logoName;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Sponsor
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Sponsor
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}