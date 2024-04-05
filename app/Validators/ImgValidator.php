<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class ImgValidator extends AbstractValidator
{

    protected string $message = 'Field :field does not match the format';
    public function rule(): bool
    {
        if (isset($this->value['name']) && !empty($this->value['name'])) {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = strtolower(pathinfo($this->value['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $allowed_extensions)) {
                $this->message = 'Не хороший формат для изображения';
                return false;
            }
            if ($this->value['size'] > 2 * 1024 * 1024) { // 2 MB
                $this->message = 'Больше 2 Мб';
                return false;
            }
        }

        return true;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}