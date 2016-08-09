<?php
// src/AppBundle/Admin/ForumCaseAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

class ForumCaseAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', 'number', [
                'label' => "ID"
            ])
            ->addIdentifier('title', 'text', [
                'label' => "Название кейса"
            ])
            ->add('forumCaseCategory', 'text', [
                'label' => "Категория кейса"
            ])
            ->add('year', 'number', [
                'label' => "Год выхода"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', [
                'label' => "Название кейса"
            ])
            ->add('forumCaseCategory', 'sonata_type_model', [
                'label' => "Категория кейса"
            ])
            ->add('year', 'number', [
                'label' => "Год выхода"
            ])
            ->add('description', 'textarea', [
                'required' => FALSE,
                'label'    => "Описание"
            ])
            ->add('creditClient', 'text', [
                'required' => FALSE,
                'label'    => "Клиент"
            ])
            ->add('creditAdvertiser', 'text', [
                'required' => FALSE,
                'label'    => "Рекламодатель"
            ])
            ->add('creditProduct', 'text', [
                'required' => FALSE,
                'label'    => "Продукт"
            ])
            ->add('creditAgency', 'text', [
                'required' => FALSE,
                'label'    => "Агентство"
            ])
            ->add('videoLink', 'url', [
                'label'    => "Ссылка на видео из YouTube"
            ])
        ;
    }
}