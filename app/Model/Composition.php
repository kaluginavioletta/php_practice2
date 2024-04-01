<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\Auth;
use Src\Request;

class Composition extends Model
{
    use HasFactory;

    protected $table = 'compositions'; // Название таблицы с адресами

    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function getComposition()
    {
        return "{$this->name}";
    }
}