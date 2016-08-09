<?php
// src/AppBundle/Admin/ExpertThoughtAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

class ExpertThoughtAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', 'number', [
                'label' => "ID"
            ])
            ->addIdentifier('name', "text", [
                'label' => "Имя эксперта"
            ])
            ->add('thought', "text", [
                'label' => "Мысль"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', "text", [
                'label' => "Имя эксперта"
            ])
            ->add('thought', "textarea", [
                'label' => "Мысль"
            ])
        ;
    }
}