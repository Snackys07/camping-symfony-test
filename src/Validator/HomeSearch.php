<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HomeSearch extends Constraint
{
    public function getTargets(): string
    {
        return static::CLASS_CONSTRAINT;
    }
}
