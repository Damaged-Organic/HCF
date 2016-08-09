<?php
// src/AppBundle/Admin/SponsorAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

class SponsorAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', 'number', [
                'label' => "ID"
            ])
            ->addIdentifier('title', "text", [
                'label' => "Название компании спонсора"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $sponsor = $this->getSubject() )
        {
            $logoRequired = ( $sponsor->getLogoName() ) ? FALSE : TRUE;

            $logoHelpOption = ( $logoPath = $sponsor->getLogoPath() )
                ? '<img src="'.$logoPath.'" class="admin-preview" />'
                : FALSE;
        } else {
            $logoRequired   = TRUE;
            $logoHelpOption = FALSE;
        }

        $formMapper
            ->add('title', "text", [
                'label' => "Название компании спонсора"
            ])
            ->add('logoFile', 'vich_file', [
                'label'         => "Логотип",
                'required'      => $logoRequired,
                'allow_delete'  => FALSE,
                'download_link' => FALSE,
                'help'          => $logoHelpOption
            ])
            ->add('link', 'url', [
                'label'    => "Ссылка на сайт компании",
                'required' => FALSE
            ])
        ;
    }
}