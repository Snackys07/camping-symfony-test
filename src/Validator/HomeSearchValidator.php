<?php

namespace App\Validator;

use App\Form\Data\HomeSearchData;
use Symfony\Component\Validator\{
    Constraint,
    ConstraintValidator
};

class HomeSearchValidator extends ConstraintValidator
{
    /**
     * @param HomeSearchData $homeSearchData
     */
    public function validate($homeSearchData, Constraint $constraint)
    {
        if (
            \is_null($homeSearchData->getName())
            && \is_null($homeSearchData->getStartDate())
            && \is_null($homeSearchData->getEndDate())
            && \is_null($homeSearchData->getLocation())
            && \is_null($homeSearchData->getStatus())
        ) {
            $this
                ->context
                ->buildViolation('aaaaa')
                ->addViolation();
        }
    }
}
