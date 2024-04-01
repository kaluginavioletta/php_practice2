<?php

namespace Model;

use Model\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'post_name',
    ];

    public function getPost()
    {
        return "{$this->post_name}";
    }
}