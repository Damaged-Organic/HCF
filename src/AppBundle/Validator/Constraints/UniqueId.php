<?php
// src/AppBundle/Validator/Constraints/UniqueId.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueId extends Constraint
{
    public $message = "order.promo_code.valid";
}