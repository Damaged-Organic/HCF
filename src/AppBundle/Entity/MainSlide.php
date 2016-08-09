<?php
// src/AppBundle/Entity/MainSlide.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper;

/**
 * @ORM\Table(name="main_slide")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\MainSlideRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\MainSlideTranslation")
 */
class MainSlide implements Translatable
{
    use IdMapper;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @ORM\OneToMany(targetEntity="MainSlideTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $slogan;

    /**
     * @ORM\Column(type="string", length=70, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $eventWhen;

    /**
     * @ORM\Column(type="string", length=70, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $eventWhere;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $datetime;

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
        return ( $this->id ) ? $this->id : "";
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

    public function addTranslation(MainSlideTranslation $t)
    {
        $this->translations->add($t);
        $t->setObject($this);
    }

    public function removeTranslation(MainSlideTranslation $t)
    {
        $this->translations->removeElement($t);
    }

    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /* END Gedmo locale methods */

    /**
     * Set slogan
     *
     * @param string $slogan
     * @return MainSlide
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;

        return $this;
    }

    /**
     * Get slogan
     *
     * @return string 
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Set eventWhen
     *
     * @param string $eventWhen
     * @return MainSlide
     */
    public function setEventWhen($eventWhen)
    {
        $this->eventWhen = $eventWhen;

        return $this;
    }

    /**
     * Get eventWhen
     *
     * @return string 
     */
    public function getEventWhen()
    {
        return $this->eventWhen;
    }

    /**
     * Set eventWhere
     *
     * @param string $eventWhere
     * @return MainSlide
     */
    public function setEventWhere($eventWhere)
    {
        $this->eventWhere = $eventWhere;

        return $this;
    }

    /**
     * Get eventWhere
     *
     * @return string 
     */
    public function getEventWhere()
    {
        return $this->eventWhere;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return MainSlide
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }
}