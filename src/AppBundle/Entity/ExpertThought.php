<?php
// src/AppBundle/Entity/ExpertThought.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper;

/**
 * @ORM\Table(name="experts_thoughts")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ExpertThoughtRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ExpertThoughtTranslation")
 */

class ExpertThought implements Translatable
{
    use IdMapper;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @ORM\OneToMany(targetEntity="ExpertThoughtTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=511, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $thought;

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
        return ( $this->name ) ? $this->name : "";
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

    public function addTranslation(ExpertThoughtTranslation $t)
    {
        $this->translations->add($t);
        $t->setObject($this);
    }

    public function removeTranslation(ExpertThoughtTranslation $t)
    {
        $this->translations->removeElement($t);
    }

    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /* END Gedmo locale methods */

    /**
     * Set name
     *
     * @param string $name
     * @return ExpertThought
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set thought
     *
     * @param string $thought
     * @return ExpertThought
     */
    public function setThought($thought)
    {
        $this->thought = $thought;

        return $this;
    }

    /**
     * Get thought
     *
     * @return string 
     */
    public function getThought()
    {
        return $this->thought;
    }
}