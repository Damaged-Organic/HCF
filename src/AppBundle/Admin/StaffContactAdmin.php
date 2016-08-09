<?php
// src/AppBundle/Admin/StaffContactAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class StaffContactAdmin extends Admin
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
            ->addIdentifier('position', "text", [
                'label' => "Должность"
            ])
            ->add('name', "text", [
                'label'  => "Имя"
            ])
            ->add('email', "text", [
                'label'  => "E-mail"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('position', "text", [
                'label' => "Должность"
            ])
            ->add('name', "text", [
                'label'  => "Имя"
            ])
            ->add('email', "text", [
                'label'  => "E-mail"
            ])
        ;
    }
}