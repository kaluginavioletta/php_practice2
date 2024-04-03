<?php

namespace Validators;

use Model\Unit;

class UnitValidator
{
    private $message = '';

    public function validate(array $data): bool
    {
        // Validate unit_name
        if (!isset($data['unit_name']) || empty($data['unit_name']) || strlen($data['unit_name']) > 255) {
            $this->message = 'Нe введено название или больше 255 символов';
            return false;
        }

        return true;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}