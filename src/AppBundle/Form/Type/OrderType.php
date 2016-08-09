<?php
// src/AppBundle/Form/Type/OrderType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("customerFullName", 'text', [
                'label' => "order.customer_full_name.label",
                'attr'  => [
                    'placeholder' => "order.customer_full_name.placeholder"
                ]
            ])
            ->add("customerEmail", 'email', [
                'label' => "order.customer_email.label",
                'attr'  => [
                    'placeholder' => "order.customer_email.placeholder"
                ]
            ])
            ->add("customerPhone", 'tel', [
                'required' => FALSE,
                'label'    => "order.customer_phone.label",
                'attr'  => [
                    'placeholder' => "order.customer_phone.placeholder"
                ]
            ])
            ->add("companyName", 'text', [
                'label' => "order.company_name.label",
                'attr'  => [
                    'placeholder' => "order.company_name.placeholder"
                ]
            ])
            ->add("companyAddress", 'text', [
                'label' => "order.company_address.label",
                'attr'  => [
                    'placeholder' => "order.company_address.placeholder"
                ]
            ])
            ->add("companyIndex", 'text', [
                'label' => "order.company_index.label",
                'attr'  => [
                    'placeholder' => "order.company_index.placeholder"
                ]
            ])
            ->add("ticketsAmount", 'text', [
                'label' => "order.tickets_amount.label",
                'attr'  => [
                    'placeholder' => "order.tickets_amount.placeholder"
                ]
            ])
            ->add("promoCode", 'text', [
                'required' => FALSE,
                'label'    => "order.promo_code.label",
                'attr'     => [
                    'placeholder' => "order.promo_code.placeholder"
                ]
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => 'AppBundle\Entity\Order',
            'translation_domain' => 'forms'
        ]);
    }

    public function getName()
    {
        return "orderType";
    }
}