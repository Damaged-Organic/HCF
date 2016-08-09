<?php
// src/AppBundle/Admin/MainSlideAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class MainSlideAdmin extends Admin
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
            ->addIdentifier('slogan', "text", [
                'label' => "Слоган"
            ])
            ->add('eventWhen', "text", [
                'label' => "Дата проведения"
            ])
            ->add('eventWhere', "text", [
                'label' => "Место проведения"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('slogan', "text", [
                'label' => "Слоган"
            ])
            ->add('eventWhen', "text", [
                'label' => "Дата проведения"
            ])
            ->add('eventWhere', "text", [
                'label' => "Место проведения"
            ])
            ->add('datetime', 'sonata_type_datetime_picker', [
                'label' => "Дата таймера"
            ])
        ;
    }
}