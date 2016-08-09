<?php
// src/AppBundle/Service/InvoicePriceCounter.php
namespace AppBundle\Service;

use AppBundle\Entity\Ticket,
    AppBundle\Entity\Order;

class InvoicePriceCounter
{
    private $singleTicketPrice;
    private $totalTicketPrice;

    private $discountTotalPrice;

    private $totalPriceWithoutVAT;
    private $totalPriceWithVAT;

    private $VAT;

    public function countInvoicePrice(Ticket $ticket, Order $order)
    {
        $this->singleTicketPrice = $ticket->getPriceWithoutVAT();

        $this->totalTicketPrice = $ticket->getPriceWithoutVAT() * $order->getTicketsAmount();

        if( $order->getPromoDiscount() ) {
            $this->discountTotalPrice = $this->totalTicketPrice * ($order->getPromoDiscount() / 100);
        } else {
            $this->discountTotalPrice = FALSE;
        }

        if( $this->discountTotalPrice ) {
            $this->totalPriceWithoutVAT = $this->totalTicketPrice - $this->discountTotalPrice;
        } else {
            $this->totalPriceWithoutVAT = $this->totalTicketPrice;
        }

        $this->VAT = $order->getTicketsPrice() - $order->getPriceWithoutVAT();

        $this->totalPriceWithVAT = $order->getTicketsPrice();

        return $this;
    }

    public function getSingleTicketPrice()
    {
        return $this->singleTicketPrice;
    }

    public function getTotalTicketPrice()
    {
        return $this->totalTicketPrice;
    }

    public function getDiscountTotalPrice()
    {
        return $this->discountTotalPrice;
    }

    public function getTotalPriceWithoutVAT()
    {
        return $this->totalPriceWithoutVAT;
    }

    public function getTotalPriceWithVAT()
    {
        return $this->totalPriceWithVAT;
    }

    public function getVAT()
    {
        return $this->VAT;
    }
}