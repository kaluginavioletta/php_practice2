<?php

namespace Validators;

use Model\Employee;
use Model\Post;
use Model\Unit;
use Model\Composition;

class EmployeeValidator
{
    private $message = '';

    public function validate(array $data): bool
    {
        if (!isset($data['surname']) || empty($data['surname']) || strlen($data['surname']) > 255) {
            $this->message = 'Не введена фамилия или больше 255 символов';
            return false;
        }

        if (!isset($data['name']) || empty($data['name']) || strlen($data['name']) > 255) {
            $this->message = 'Не введено имя или больше 255 символов';
            return false;
        }

        // Validate date of birth
        if (!isset($data['dob']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['dob'])) {
            $this->message = 'Введите ДР';
            return false;
        }

        // Validate address
        if (!isset($data['address']) || empty($data['address']) || strlen($data['address']) > 255) {
            $this->message = 'Не введён адрес или больше 255 символов';
            return false;
        }

        // Validate image
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