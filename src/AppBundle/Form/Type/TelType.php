<?php
// src/AppBundle/Form/Type/TelType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class TelType extends AbstractType
{
    public function getName()
    {
        return 'tel';
    }

    public function getParent()
    {
        return 'text';
    }
}