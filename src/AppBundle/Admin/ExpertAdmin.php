<?php
// src/AppBundle/Admin/ExpertAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

class ExpertAdmin extends Admin
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
            ->add('position', "text", [
                'label' => "Должность"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $expert = $this->getSubject() )
        {
            $photoRequired = ( $expert->getPhotoName() ) ? FALSE : TRUE;

            $photoHelpOption = ( $photoPath = $expert->getPhotoPath() )
                ? '<img src="'.$photoPath.'" class="admin-preview" />'
                : FALSE;
        } else {
            $photoRequired   = TRUE;
            $photoHelpOption = FALSE;
        }

        $formMapper
            ->add('name', "text", [
                'label' => "Имя эксперта"
            ])
            ->add('photoFile', 'vich_file', [
                'label'         => "Фотография",
                'required'      => $photoRequired,
                'allow_delete'  => FALSE,
                'download_link' => FALSE,
                'help'          => $photoHelpOption
            ])
            ->add('position', "text", [
                'label' => "Должность"
            ])
            ->add('description', "textarea", [
                'required' => FALSE,
                'label'    => "Краткое описание"
            ])
        ;
    }
}