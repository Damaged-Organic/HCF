<?php
// src/AppBundle/Admin/ProgrammeItemAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class ProgrammeItemAdmin extends Admin
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
                'label' => "Название пункта"
            ])
            ->add('timeFrom', "datetime", [
                'label'  => "Время начала",
                'format' => "H:i"
            ])
            ->add('timeTo', "datetime", [
                'label'  => "Время окончания",
                'format' => "H:i"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', "text", [
                'label' => "Название пункта"
            ])
            ->add('timeFrom', "time", [
                'required' => FALSE,
                'label'    => "Время начала (часы:минуты)",
                'widget'   => "single_text"
            ])
            ->add('timeTo', "time", [
                'required' => FALSE,
                'label'    => "Время окончания (часы:минуты)",
                'widget'   => "single_text"
            ])
            ->add('shortDescription', "textarea", [
                'required' => FALSE,
                'label'    => "Краткое описание"
            ])
            ->add('fullDescription', 'sonata_formatter_type', [
                'required'             => FALSE,
                'label'                => "Развернутое описание",
                'event_dispatcher'     => $formMapper->getFormBuilder()->getEventDispatcher(),
                'format_field'         => 'contentFormatter',
                'source_field'         => 'rawContent',
                'ckeditor_context'     => 'standard_config',
                'source_field_options' => [
                    'attr' => [
                        'class' => 'span10', 'rows' => 10
                    ]
                ],
                'listener'             => TRUE,
                'target_field'         => 'fullDescription'
            ])
        ;
    }
}