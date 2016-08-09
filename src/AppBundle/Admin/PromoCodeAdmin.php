<?php
// src/AppBundle/Admin/PromoCodeAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

class PromoCodeAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', 'number', [
                'label' => "ID"
            ])
            ->addIdentifier('companyTitle', "text", [
                'label' => "Название компании"
            ])
            ->add('discountPercent', "text", [
                'label' => "Процент скидки"
            ])
            ->add('isActive', "boolean", [
                'label' => "Активен ли код"
            ])
            ->add('uniquePromoCode', "text", [
                'label' => "Промо код"
            ]);
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('companyTitle', "text", [
                'label' => "Название компании"
            ])
            ->add('discountPercent', "text", [
                'label' => "Процент скидки (число)"
            ])
        ;

        if( $promoCode = $this->getSubject() )
        {
            if( $promoCode->getUniquePromoCode() )
                $formMapper
                    ->add('uniquePromoCode', "text", [
                        'read_only' => TRUE,
                        'label'     => "Промо код"
                    ])
                    ->add('isActive', "checkbox", [
                        'disabled' => TRUE,
                        'label'    => "Активен ли код",
                        'help'     => ( $promoCode->getIsActive() ) ? "Активен" : "Неактивен"
                    ]);
        }
    }

    public function prePersist($promoCode) {
        $promoCode->setUniquePromoCode(uniqid());
    }
}