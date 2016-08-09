<?php
// src/AppBundle/Entity/Order.php
namespace AppBundle\Entity;

use DateTime;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Validator\Constraints as CustomAssert;;

/**
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\OrderRepository")
 */
class Order
{
    use IdMapper;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $orderId;

    /**
     * @ORM\Column(type="string", length=13, nullable=false)
     */
    protected $orderCheckSum;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $orderDatetime;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(
     *      message = "order.customer_full_name.not_blank"
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "order.customer_full_name.length_min",
     *      maxMessage = "order.customer_full_name.length_min"
     * )
     */
    protected $customerFullName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(
     *      message = "order.customer_email.not_blank"
     * )
     * @Assert\Email(
     *      message = "order.customer_email.valid"
     * )
     */
    protected $customerEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(
     *      message = "order.customer_phone.not_blank"
     * )
     */
    protected $customerPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(
     *      message = "order.company_name.not_blank"
     * )
     * @Assert\Length(
     *      max = 511,
     *      maxMessage = "order.company_name.length.max"
     * )
     */
    protected $companyName;

    /**
     * @ORM\Column(type="string", length=1023, nullable=false)
     *
     * @Assert\NotBlank(
     *      message = "order.company_address.not_blank"
     * )
     * @Assert\Length(
     *      max = 1023,
     *      maxMessage = "order.company_address.length.max"
     * )
     */
    protected $companyAddress;

    /**
     * @ORM\Column(type="string", length=5, nullable=false)
     *
     * @Assert\NotBlank(
     *      message = "order.company_index.not_blank"
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      exactMessage = "order.company_index.length.exact"
     * )
     */
    protected $companyIndex;

    /**
     * @ORM\Column(type="integer", nullable=false)
     *
     * @Assert\NotBlank(
     *      message = "order.tickets_amount.not_blank"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 99,
     *      minMessage = "order.tickets_amount.range.invalid",
     *      maxMessage = "order.tickets_amount.range.invalid"
     * )
     */
    protected $ticketsAmount;

    /**
     * @ORM\Column(type="string", length=13, nullable=true)
     *
     * @CustomAssert\UniqueId
     */
    protected $promoCode;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $ticketsPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $promoDiscount;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $isInvoiceSolved;

    public function __construct()
    {
        $this
            ->setOrderCheckSum(uniqid())
            ->setOrderDatetime(new DateTime("NOW"))
            ->setIsInvoiceSolved(FALSE)
        ;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     * @return Order
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set orderCheckSum
     *
     * @param integer $orderCheckSum
     * @return Order
     */
    public function setOrderCheckSum($orderCheckSum)
    {
        $this->orderCheckSum = $orderCheckSum;

        return $this;
    }

    /**
     * Get orderCheckSum
     *
     * @return integer
     */
    public function getOrderCheckSum()
    {
        return $this->orderCheckSum;
    }

    /**
     * Set orderDatetime
     *
     * @param \DateTime $orderDatetime
     * @return Order
     */
    public function setOrderDatetime($orderDatetime)
    {
        $this->orderDatetime = $orderDatetime;

        return $this;
    }

    /**
     * Get orderDatetime
     *
     * @return \DateTime 
     */
    public function getOrderDatetime()
    {
        return $this->orderDatetime;
    }

    /**
     * Set customerFullName
     *
     * @param string $customerFullName
     * @return Order
     */
    public function setCustomerFullName($customerFullName)
    {
        $this->customerFullName = $customerFullName;

        return $this;
    }

    /**
     * Get customerFullName
     *
     * @return string 
     */
    public function getCustomerFullName()
    {
        return $this->customerFullName;
    }

    /**
     * Set customerEmail
     *
     * @param string $customerEmail
     * @return Order
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * Get customerEmail
     *
     * @return string 
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * Set customerPhone
     *
     * @param string $customerPhone
     * @return Order
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * Get customerPhone
     *
     * @return string 
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return Order
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set companyAddress
     *
     * @param string $companyAddress
     * @return Order
     */
    public function setCompanyAddress($companyAddress)
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    /**
     * Get companyAddress
     *
     * @return string 
     */
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    /**
     * Set companyIndex
     *
     * @param string $companyIndex
     * @return Order
     */
    public function setCompanyIndex($companyIndex)
    {
        $this->companyIndex = $companyIndex;

        return $this;
    }

    /**
     * Get companyIndex
     *
     * @return string 
     */
    public function getCompanyIndex()
    {
        return $this->companyIndex;
    }

    /**
     * Set ticketsAmount
     *
     * @param integer $ticketsAmount
     * @return Order
     */
    public function setTicketsAmount($ticketsAmount)
    {
        $this->ticketsAmount = $ticketsAmount;

        return $this;
    }

    /**
     * Get ticketsAmount
     *
     * @return integer 
     */
    public function getTicketsAmount()
    {
        return $this->ticketsAmount;
    }

    /**
     * Set promoCode
     *
     * @param boolean $promoCode
     * @return Order
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * Get promoCode
     *
     * @return boolean
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set ticketsPrice
     *
     * @param string $ticketsPrice
     * @return Order
     */
    public function setTicketsPrice($ticketsPrice)
    {
        $this->ticketsPrice = $ticketsPrice;

        return $this;
    }

    /**
     * Get ticketsPrice
     *
     * @return string 
     */
    public function getTicketsPrice()
    {
        return $this->ticketsPrice;
    }

    /**
     * Set promoDiscount
     *
     * @param integer $promoDiscount
     * @return Order
     */
    public function setPromoDiscount($promoDiscount)
    {
        $this->promoDiscount = $promoDiscount;

        return $this;
    }

    /**
     * Get promoDiscount
     *
     * @return integer 
     */
    public function getPromoDiscount()
    {
        return $this->promoDiscount;
    }

    /**
     * Set isInvoiceSolved
     *
     * @param integer $isInvoiceSolved
     * @return Order
     */
    public function setIsInvoiceSolved($isInvoiceSolved)
    {
        $this->isInvoiceSolved = $isInvoiceSolved;

        return $this;
    }

    /**
     * Get isInvoiceSolved
     *
     * @return integer
     */
    public function getIsInvoiceSolved()
    {
        return $this->isInvoiceSolved;
    }

    /* Custom method */

    public function getPriceWithoutVAT()
    {
        return $this->ticketsPrice - ( $this->ticketsPrice / 6 );
    }
}