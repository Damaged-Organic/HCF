<?php
// src/AppBundle/Admin/TicketAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class TicketAdmin extends Admin
{
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
            ->addIdentifier('eventTitle', "text", [
                'label' => "Название мероприятия"
            ])
            ->add('price', 'number', [
                'label'     => "Цена билета (влючая НДС)",
                'precision' => 2
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('eventTitle', "text", [
                'label' => "Название мероприятия"
            ])
            ->add('price', 'number', [
                'label'     => "Цена билета (влючая НДС)",
                'precision' => 2
            ])
        ;
    }
}