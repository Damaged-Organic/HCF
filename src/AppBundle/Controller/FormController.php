<?php
// src/AppBundle/Controller/FormController.php
namespace AppBundle\Controller;

use DateTime;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\JsonResponse,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Controller\Utility\FormErrorHandlerTrait,
    AppBundle\Entity\Order,
    AppBundle\Form\Type\OrderType;

class FormController extends Controller
{
    use FormErrorHandlerTrait;

    /**
     * @Method({"POST"})
     * @Route(
     *      "/order_send",
     *      name="order_send",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function orderSendAction(Request $request)
    {
        $orderForm = $this->createForm(new OrderType, ($order = new Order));

        $orderForm->handleRequest($request);

        if( !($orderForm->isValid()) ) {
            $response = [
                'data' => ['message' => $this->stringifyFormErrors($orderForm)],
                'code' => 500
            ];
        } else {
            $ticket = $this->getDoctrine()->getManager()->getRepository('AppBundle:Ticket')
                ->findSingleTicket();

            $order = $this->get('app.order_notifier')->finalizeInvoice($order, $ticket);

            $emailNoReply = [$this->container->getParameter('personal_email')['no_reply'] => "Healthcare Creative Forum"];
            $emailPrimary = $this->container->getParameter('personal_email')['primary'];

            $invoiceSent = $this->get('app.order_notifier')->sendInvoice($order, $ticket, $emailNoReply, $emailPrimary);

            if( $invoiceSent ) {
                $this->getDoctrine()->getManager()->persist($order);
                $this->getDoctrine()->getManager()->flush();

                $pdfDownloadLink = $this->generateUrl('pdf_invoice', [
                    'orderId'       => $order->getOrderId(),
                    'orderCheckSum' => $order->getOrderCheckSum()
                ]);

                $response = [
                    'data' => ['message' => $this->get('translator')->trans("order.success", [], 'responses'), 'invoice' => $pdfDownloadLink],
                    'code' => 200
                ];
            } else {
                $response = [
                    'data' => ['message' => $this->get('translator')->trans("order.fail", [], 'responses')],
                    'code' => 500
                ];
            }
        }

        return new JsonResponse($response['data'], $response['code']);
    }

    public function orderFormAction()
    {
        $orderForm = $this->createForm(new OrderType, new Order);

        return $this->render('AppBundle:Form:orderForm.html.twig', [
            'orderForm' => $orderForm->createView()
        ]);
    }
}