<?php
// src/AppBundle/Controller/ContentController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ContentController extends Controller
{
    /**
     * @Method({"GET"})
     * @Route(
     *      "/pdf_invoice/{orderId}/{orderCheckSum}",
     *      name="pdf_invoice",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function pdfInvoiceAction($orderId, $orderCheckSum)
    {
        $order = $this->getDoctrine()->getManager()->getRepository('AppBundle:Order')
            ->findVerifiedClientOrder($orderId, $orderCheckSum);

        if( !$order )
            throw $this->createNotFoundException();

        $ticket = $this->getDoctrine()->getManager()->getRepository('AppBundle:Ticket')
            ->findSingleTicket();

        $invoicePrice = $this->get('app.invoice_price_counter')->countInvoicePrice($ticket, $order);

        $priceString = $this->get('runcore.price_to_string_formatter')->num2str($order->getTicketsPrice());

        $pdfDocument = $this->get('app.dompdf_shortcut')->generatePdf(
            $this->renderView('AppBundle:Order:invoice.html.twig', [
                'order'        => $order,
                'ticket'       => $ticket,
                'invoicePrice' => $invoicePrice,
                'priceString'  => $priceString
            ])
        );

        return new Response($pdfDocument, 200, [
            'Content-Type' => 'application/pdf'
        ]);
    }
}