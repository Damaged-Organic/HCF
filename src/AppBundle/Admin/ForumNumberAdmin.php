<?php
// src/AppBundle/Admin/ForumNumberAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class ForumNumberAdmin extends Admin
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
            ->addIdentifier('number', "number", [
                'label' => "Название пункта"
            ])
            ->add('title', "text", [
                'label' => "Описание"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('number', "text", [
                'label' => "Название пункта"
            ])
            ->add('title', "text", [
                'label' => "Описание"
            ])
        ;
    }
}
