<?php

namespace Validators;

class ImgValidator
{
    private $message = '';
//
    public function validate(array $data): bool
    {

        if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $allowed_extensions)) {
                $this->message = 'Не хороший формат для изображения';
                return false;
            }
            if ($_FILES['img']['size'] > 2 * 1024 * 1024) { // 2 MB
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