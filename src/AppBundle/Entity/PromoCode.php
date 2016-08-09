<?php
// src/AppBundle/Entity/PromoCode.php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper;

/**
 * @ORM\Table(name="promo_codes")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PromoCodeRepository")
 */
class PromoCode
{
    use IdMapper;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $companyTitle;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $uniquePromoCode;

    /**
     * @ORM\Column(type="integer", nullable=false)
     *
     * @Assert\Range(
     *      min = 1,
     *      max = 100
     * )
     */
    protected $discountPercent;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $isActive;

    public function __construct()
    {
        $this->isActive = TRUE;
    }

    /**
     * Set companyTitle
     *
     * @param string $companyTitle
     * @return PromoCode
     */
    public function setCompanyTitle($companyTitle)
    {
        $this->companyTitle = $companyTitle;

        return $this;
    }

    /**
     * Get companyTitle
     *
     * @return string 
     */
    public function getCompanyTitle()
    {
        return $this->companyTitle;
    }

    /**
     * Set uniquePromoCode
     *
     * @param string $uniquePromoCode
     * @return PromoCode
     */
    public function setUniquePromoCode($uniquePromoCode)
    {
        $this->uniquePromoCode = $uniquePromoCode;

        return $this;
    }

    /**
     * Get uniquePromoCode
     *
     * @return string
     */
    public function getUniquePromoCode()
    {
        return $this->uniquePromoCode;
    }

    /**
     * Set discountPercent
     *
     * @param integer $discountPercent
     * @return PromoCode
     */
    public function setDiscountPercent($discountPercent)
    {
        $this->discountPercent = $discountPercent;

        return $this;
    }

    /**
     * Get discountPercent
     *
     * @return integer 
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    /**
     * Set isActive
     *
     * @param integer $isActive
     * @return PromoCode
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return integer
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}