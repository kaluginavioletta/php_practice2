<?php

namespace Model;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'gender',
        'dob',
        'address',
        'id_post',
        'id_unit',
        'check_unit',
        'id_composition',
        'img'
    ];

    //Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    //Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }


    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
    public function composition()
    {
        return $this->belongsTo(Composition::class, 'id_composition');
    }
}
