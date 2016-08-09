<?php
// src/AppBundle/Service/OrderNotifier.php
namespace AppBundle\Service;

use Symfony\Bundle\TwigBundle\TwigEngine;

use Doctrine\ORM\EntityManager;

use Swift_Attachment;

use AppBundle\Entity\Order,
    AppBundle\Entity\Ticket;

class OrderNotifier
{
    private $_manager;

    private $_translator;
    private $_templating;

    private $_DOMPDFShortcut;
    private $_mailerShortcut;

    private $_imageCreatorShortcut;

    private $_invoicePriceCounter;
    private $_priceToStringFormatter;

    public function __construct(
        EntityManager $manager,
        $translator,
        TwigEngine $templating,
        DOMPDFShortcut $DOMPDFShortcut,
        MailerShortcut $mailerShortcut,
        ImageCreatorShortcut $imageCreatorShortcut,
        InvoicePriceCounter $invoicePriceCounter,
        PriceToStringFormatter $priceToStringFormatter
    ) {
        $this->_manager = $manager;

        $this->_translator = $translator;
        $this->_templating = $templating;

        $this->_DOMPDFShortcut = $DOMPDFShortcut;
        $this->_mailerShortcut = $mailerShortcut;

        $this->_imageCreatorShortcut = $imageCreatorShortcut;

        $this->_invoicePriceCounter    = $invoicePriceCounter;
        $this->_priceToStringFormatter = $priceToStringFormatter;
    }

    public function finalizeInvoice(Order $order, Ticket $ticket)
    {
        $order->setOrderId(
            $this->_manager->getRepository('AppBundle:Order')->findMaxOrderId() + 1
        );

        $promoCode = FALSE;

        if( $order->getPromoCode() )
        {
            $promoCode = $this->_manager->getRepository('AppBundle:PromoCode')->findOneBy(['uniquePromoCode' => $order->getPromoCode()]);

            if( $promoCode && $promoCode->getIsActive() )
            {
                $promoCode->setIsActive(FALSE);

                $this->_manager->persist($promoCode);
                $this->_manager->flush();
            } else {
                $order->setPromoCode(NULL);
            }
        }

        if( $promoCode )
        {
            $order->setPromoDiscount($promoCode->getDiscountPercent());

            $price = $order->getTicketsAmount() * $ticket->getPrice();

            $price = $price - ($price / 100 * $order->getPromoDiscount());

            $order->setTicketsPrice($price);
        } else {
            $price = $order->getTicketsAmount() * $ticket->getPrice();

            $order->setTicketsPrice($price);
        }

        return $order;
    }

    public function sendInvoice(Order $order, Ticket $ticket, $emailNoReply, $emailPrimary)
    {
        $to = $emailNoReply;

        $from = [$emailPrimary, $order->getCustomerEmail()];

        $subject = $this->_translator->trans("order.subject", [], 'emails');

        $body = $this->_templating->render('AppBundle:Email:order.html.twig', [
            'order' => $order
        ]);

        $invoicePrice = $this->_invoicePriceCounter->countInvoicePrice($ticket, $order);

        $priceString = $this->_priceToStringFormatter->num2str($order->getTicketsPrice());

        $pdfDocument = $this->_DOMPDFShortcut->generatePdf(
            $this->_templating->render('AppBundle:Order:invoice.html.twig', [
                'order'        => $order,
                'ticket'       => $ticket,
                'invoicePrice' => $invoicePrice,
                'priceString'  => $priceString
            ])
        );

        $attachment = Swift_Attachment::newInstance($pdfDocument, "invoice_HCF_" . str_pad($order->getOrderId(), 3, '0', STR_PAD_LEFT) . ".pdf", "application/pdf");

        return $this->_mailerShortcut->sendMail($to, $from, $subject, $body, $attachment);
    }

    public function finalizeTickets(Order $order)
    {
        $ticketsResources = [];

        $totalTicketsAmount = $this->getTotalTicketsAmount();
        $firstTicketNumber  = $this->getFirstTicketNumber($totalTicketsAmount, $order->getTicketsAmount());

        $prefix = $this->_translator->trans("ticket.ticket_number", [], 'emails') . $order->getOrderDatetime()->format('dmy');

        for($i = $firstTicketNumber; $i <= $totalTicketsAmount; $i++)
        {
            $prefixedTicketNumber =  "{$prefix}_" . str_pad($i, 3, '0', STR_PAD_LEFT);

            $ticketsResources[$i] = $this->_imageCreatorShortcut->generateSignedTicket(
                $prefixedTicketNumber, $order->getCompanyName()
            );
        }

        return $ticketsResources;
    }

    public function sendTickets(Order $order, $ticketsResources, $emailNoReply, $emailPrimary)
    {
        $to = $emailNoReply;

        $from = [$emailPrimary, $order->getCustomerEmail()];

        $subject = $this->_translator->trans("ticket.subject", [], 'emails');

        $body = $this->_templating->render('AppBundle:Email:tickets.html.twig', [
            'order' => $order
        ]);

        $attachments = [];

        foreach($ticketsResources as $ticketNumber => $attachment) {
            $attachments[] = Swift_Attachment::newInstance($attachment, "ticket_" . str_pad($ticketNumber, 3, '0', STR_PAD_LEFT) . ".jpg", "image/jpeg");
        }

        return $this->_mailerShortcut->sendMail($to, $from, $subject, $body, $attachments);
    }

    public function getTotalTicketsAmount()
    {
        return $this->_manager->getRepository('AppBundle:Order')->findSumOfTickets();
    }

    public function getFirstTicketNumber($totalTicketsAmount, $orderTicketsAmount)
    {
        return $totalTicketsAmount - $orderTicketsAmount + 1;
    }
}