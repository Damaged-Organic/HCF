<?php
// src/AppBundle/Admin/OrderAdmin.php
namespace AppBundle\Admin;

use AppBundle\Service\OrderNotifier;
use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

use AppBundle\Entity\Order;

class OrderAdmin extends Admin
{
    private $_orderNotifier;

    public function setOrderNotifier(OrderNotifier $orderNotifier)
    {
        $this->_orderNotifier = $orderNotifier;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('delete')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('orderId', 'number', [
                'label' => "ID заказа"
            ])
            ->addIdentifier('companyName', "text", [
                'label' => "Название компании"
            ])
            ->add('orderDatetime', "datetime", [
                'label'  => "Дата заказа",
                'format' => "d-m-Y H:i:s",
            ])
            ->add('ticketsAmount', "number", [
                'label' => "Количество билетов"
            ])
            ->add('ticketsPrice', 'number', [
                'label'     => "Стоимость билетов, грн.",
                'precision' => 2
            ])
            ->add('promoCode', "text", [
                'label' => "Промо-код (если был указан)"
            ])
            ->add('isInvoiceSolved', "boolean", [
                'label' => "Был ли оплачен счет"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $order = $this->getSubject() )
        {
            $discountData = ( $order->getPromoDiscount() )
                ? $order->getPromoDiscount()
                : "без скидки";

            $isCheckboxDisabled = $order->getIsInvoiceSolved();
        } else {
            $discountData       = NULL;
            $isCheckboxDisabled = FALSE;
        }

        $formMapper
            ->add('orderId', 'number', [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "ID заказа"
            ])
            ->add('companyName', "text", [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "Название компании"
            ])
            ->add('companyAddress', 'text', [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "Адрес для отправки документов"
            ])
            ->add('companyIndex', 'text', [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "Почтовый индекс"
            ])
            ->add('customerFullName', 'text', [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "ФИО контактного лица"
            ])
            ->add('customerEmail', 'text', [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "E-mail контактного лица"
            ])
            ->add('customerPhone', 'text', [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "Телефон контактного лица"
            ])
            ->add('orderDatetime', "datetime", [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "Дата заказа",
                'format'    => "dd-MM-yyyy HH:mm:ss",
                'widget'    => "single_text"
            ])
            ->add('ticketsAmount', "number", [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "Количество билетов"
            ])
            ->add('ticketsPrice', 'number', [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "Стоимость билетов, грн.",
                'precision' => 2
            ])
            ->add('promoCode', "text", [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "Промо-код (если был указан)"
            ])
            ->add('promoDiscount', 'text', [
                'required'  => FALSE,
                'read_only' => TRUE,
                'label'     => "% скидки (если указан промо-код)",
                'data'      => $discountData
            ])
            ->add('isInvoiceSolved', "checkbox", [
                'required'  => FALSE,
                'disabled'  => $isCheckboxDisabled,
                'label'     => "Поставьте галочку и нажмите \"Сохранить\", если клиент оплатил счет.",
                'help'      => "Внимание! После этого клиенту будут высланы билеты на мероприятие.",
            ])
        ;
    }

    public function postUpdate($order)
    {
        if( !($order instanceof Order) )
            return;

        if( !$order->getIsInvoiceSolved() )
            return;

        $ticketsResources = $this->_orderNotifier->finalizeTickets($order);

        $emailNoReply = [$this->getConfigurationPool()->getContainer()->getParameter('personal_email')['no_reply'] => "Healthcare Creative Forum"];
        $emailPrimary = $this->getConfigurationPool()->getContainer()->getParameter('personal_email')['primary'];

        $this->_orderNotifier->sendTickets($order, $ticketsResources, $emailNoReply, $emailPrimary);
    }
}