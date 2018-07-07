<?php 

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotAllowedEmails extends Constraint
{
    public $message = "core_user.email.not_allowed";
} 