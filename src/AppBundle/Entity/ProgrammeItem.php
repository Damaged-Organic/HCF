<?php
// src/AppBundle/Entity/ProgrammeItem.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper;

/**
 * @ORM\Table(name="programme_items")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ProgrammeItemRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ProgrammeItemTranslation")
 */
class ProgrammeItem implements Translatable
{
    use IdMapper;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @ORM\OneToMany(targetEntity="ProgrammeItemTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\Column(type="string", length=31, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=31, nullable=true)
     */
    protected $icon;

    /**
     * @ORM\Column(type="time", nullable=false)
     */
    protected $timeFrom;

    /**
     * @ORM\Column(type="time", nullable=false)
     */
    protected $timeTo;

    /**
     * @ORM\Column(type="string", length=511, nullable=true)
     *
     * @Gedmo\Translatable
     */
    protected $shortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @Gedmo\Translatable
     */
    protected $fullDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $rawContent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $contentFormatter;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $isMain;

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

    public function addTranslation(ProgrammeItemTranslation $t)
    {
        $this->translations->add($t);
        $t->setObject($this);
    }

    public function removeTranslation(ProgrammeItemTranslation $t)
    {
        $this->translations->removeElement($t);
    }

    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /* END Gedmo locale methods */

    /**
     * Set title
     *
     * @param string $title
     * @return ProgrammeItem
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
     * Set icon
     *
     * @param string $icon
     * @return ProgrammeItem
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set timeFrom
     *
     * @param \DateTime $timeFrom
     * @return ProgrammeItem
     */
    public function setTimeFrom($timeFrom)
    {
        $this->timeFrom = $timeFrom;

        return $this;
    }

    /**
     * Get timeFrom
     *
     * @return \DateTime 
     */
    public function getTimeFrom()
    {
        return $this->timeFrom;
    }

    /**
     * Set timeTo
     *
     * @param \DateTime $timeTo
     * @return ProgrammeItem
     */
    public function setTimeTo($timeTo)
    {
        $this->timeTo = $timeTo;

        return $this;
    }

    /**
     * Get timeTo
     *
     * @return \DateTime 
     */
    public function getTimeTo()
    {
        return $this->timeTo;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return ProgrammeItem
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set fullDescription
     *
     * @param string $fullDescription
     * @return ProgrammeItem
     */
    public function setFullDescription($fullDescription)
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    /**
     * Get fullDescription
     *
     * @return string 
     */
    public function getFullDescription()
    {
        return $this->fullDescription;
    }

    /**
     * Set rawContent
     *
     * @param string $rawContent
     * @return ProgrammeItem
     */
    public function setRawContent($rawContent)
    {
        $this->rawContent = $rawContent;

        return $this;
    }

    /**
     * Get rawContent
     *
     * @return string 
     */
    public function getRawContent()
    {
        return $this->rawContent;
    }

    /**
     * Set contentFormatter
     *
     * @param string $contentFormatter
     * @return ProgrammeItem
     */
    public function setContentFormatter($contentFormatter)
    {
        $this->contentFormatter = $contentFormatter;

        return $this;
    }

    /**
     * Get contentFormatter
     *
     * @return string 
     */
    public function getContentFormatter()
    {
        return $this->contentFormatter;
    }

    /**
     * Set isMain
     *
     * @param boolean $isMain
     * @return ProgrammeItem
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    /**
     * Get isMain
     *
     * @return string
     */
    public function getIsMain()
    {
        return $this->isMain;
    }
}