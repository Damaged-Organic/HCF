<?php
// src/AppBundle/Entity/ForumCaseCategory.php
namespace AppBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\SlugMapper;

/**
 * @ORM\Table(name="forum_cases_categories")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ForumCaseCategoryRepository")
 *
 * @UniqueEntity(fields="title", message="Название категории должно быть уникальным")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ForumCaseCategoryTranslation")
 */
class ForumCaseCategory
{
    use IdMapper, SlugMapper;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @ORM\OneToMany(targetEntity="ForumCaseCategoryTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\Column(type="string", length=127, nullable=false, unique=true)
     *
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="ForumCase", mappedBy="forumCaseCategory", cascade={"persist"})
     */
    protected $forumCase;

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

    public function addTranslation(ForumCaseCategoryTranslation $t)
    {
        $this->translations->add($t);
        $t->setObject($this);
    }

    public function removeTranslation(ForumCaseCategoryTranslation $t)
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
     * @return ForumCaseCategory
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
     * Add forumCase
     *
     * @param \AppBundle\Entity\ForumCase $forumCase
     * @return ForumCaseCategory
     */
    public function addForumCase(\AppBundle\Entity\ForumCase $forumCase)
    {
        $this->forumCase[] = $forumCase;

        return $this;
    }

    /**
     * Remove forumCase
     *
     * @param \AppBundle\Entity\ForumCase $forumCase
     */
    public function removeForumCase(\AppBundle\Entity\ForumCase $forumCase)
    {
        $this->forumCase->removeElement($forumCase);
    }

    /**
     * Get forumCase
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getForumCase()
    {
        return $this->forumCase;
    }
}
