<?php
// src/AppBundle/Validator/Constraints/UniqueIdValidator.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint,
    Symfony\Component\Validator\ConstraintValidator;

class UniqueIdValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if( !$value )
            return;

        if( !preg_match('/^[a-z0-9]{13}$/', $value, $matches) ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}