<?php
// src/AppBundle/Admin/MetadataAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class MetadataAdmin extends Admin
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
            ->addIdentifier('title', "text", [
                'label' => "Заголовок страницы"
            ])
            ->add('route', "text", [
                'label'    => "Роутер (Системная настройка)"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', "text", [
                'label' => "Заголовок страницы"
            ])
            ->add('route', "text", [
                'label'    => "Роутер (Системная настройка)",
                'disabled' => TRUE
            ])
            ->add('description', 'textarea', [
                'label'    => "Описание страницы",
                'required' => FALSE
            ])
            ->add('robots', 'text', [
                'label'    => "Метаданные для поисковых ботов",
                'required' => FALSE
            ])
        ;
    }
}