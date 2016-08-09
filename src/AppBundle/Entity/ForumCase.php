<?php
// src/AppBundle/Entity/ForumCase.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\SlugMapper;

/**
 * @ORM\Table(name="forum_cases")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ForumCaseRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ForumCaseTranslation")
 */
class ForumCase
{
    use IdMapper, SlugMapper;

    /**
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @ORM\OneToMany(targetEntity="ForumCaseTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="ForumCaseCategory", inversedBy="forumCase", cascade={"persist"})
     * @ORM\JoinColumn(name="forum_case_category_id", referencedColumnName="id")
     */
    protected $forumCaseCategory;

    /**
     * @ORM\Column(type="string", length=511, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @Gedmo\Translatable
     */
    protected $description;

    /**
     * @ORM\Column(type="integer", length=4, nullable=false)
     */
    protected $year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $creditClient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $creditAdvertiser;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $creditProduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $creditAgency;

    /**
     * @ORM\Column(type="string", length=511, nullable=false)
     */
    protected $videoLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $videoId;

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

    public function addTranslation(ForumCaseTranslation $t)
    {
        $this->translations->add($t);
        $t->setObject($this);
    }

    public function removeTranslation(ForumCaseTranslation $t)
    {
        $this->translations->removeElement($t);
    }

    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /* END Gedmo locale methods */

    public function setVideoLink($videoLink)
    {
        $this->videoLink = $videoLink;

        $this->setVideoId($this->videoLink);

        return $this;
    }

    public function getVideoLink()
    {
        return $this->videoLink;
    }

    public function setVideoId($videoLink)
    {
        $this->videoId = ( preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoLink, $match) )
            ? $match[1]
            : NULL;

        return $this;
    }

    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ForumCase
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
     * Set description
     *
     * @param string $description
     * @return ForumCase
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return ForumCase
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set creditClient
     *
     * @param string $creditClient
     * @return ForumCase
     */
    public function setCreditClient($creditClient)
    {
        $this->creditClient = $creditClient;

        return $this;
    }

    /**
     * Get creditClient
     *
     * @return string 
     */
    public function getCreditClient()
    {
        return $this->creditClient;
    }

    /**
     * Set creditAdvertiser
     *
     * @param string $creditAdvertiser
     * @return ForumCase
     */
    public function setCreditAdvertiser($creditAdvertiser)
    {
        $this->creditAdvertiser = $creditAdvertiser;

        return $this;
    }

    /**
     * Get creditAdvertiser
     *
     * @return string
     */
    public function getCreditAdvertiser()
    {
        return $this->creditAdvertiser;
    }

    /**
     * Set creditProduct
     *
     * @param string $creditProduct
     * @return ForumCase
     */
    public function setCreditProduct($creditProduct)
    {
        $this->creditProduct = $creditProduct;

        return $this;
    }

    /**
     * Get creditProduct
     *
     * @return string 
     */
    public function getCreditProduct()
    {
        return $this->creditProduct;
    }

    /**
     * Set creditAgency
     *
     * @param string $creditAgency
     * @return ForumCase
     */
    public function setCreditAgency($creditAgency)
    {
        $this->creditAgency = $creditAgency;

        return $this;
    }

    /**
     * Get creditAgency
     *
     * @return string 
     */
    public function getCreditAgency()
    {
        return $this->creditAgency;
    }

    /**
     * Set forumCaseCategory
     *
     * @param \AppBundle\Entity\ForumCaseCategory $forumCaseCategory
     * @return ForumCase
     */
    public function setForumCaseCategory(\AppBundle\Entity\ForumCaseCategory $forumCaseCategory = null)
    {
        $this->forumCaseCategory = $forumCaseCategory;

        return $this;
    }

    /**
     * Get forumCaseCategory
     *
     * @return \AppBundle\Entity\ForumCaseCategory 
     */
    public function getForumCaseCategory()
    {
        return $this->forumCaseCategory;
    }
}
