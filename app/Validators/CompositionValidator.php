<?php

namespace Validators;

use Model\Composition;

class CompositionValidator
{
    private $message = '';

    public function validate(array $data): bool
    {
        // Validate name
        if (!isset($data['name']) || empty($data['name']) || strlen($data['name']) > 255) {
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