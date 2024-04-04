<?php

namespace Validators;

use Src\Validator\AbstractValidator;
use DateTime;

class AgeValidator extends AbstractValidator
{
    protected string $message = 'Field :field must be between 18 and 65 years old';

    public function rule(): bool
    {
        $dob = new DateTime($this->value);
        $now = new DateTime();
        $age = $now->diff($dob)->y;

        return $age >= 1 && $age <= 65;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
