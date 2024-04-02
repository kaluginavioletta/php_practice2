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
<<<<<<< HEAD
=======
        'login',
>>>>>>> f7fdead (2 done)
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

<<<<<<< HEAD

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
=======
>>>>>>> f7fdead (2 done)
    public function composition()
    {
        return $this->belongsTo(Composition::class, 'id_composition');
    }
<<<<<<< HEAD
=======

    public function search($query)
    {
        return self::where('surname', 'LIKE', '%'.$query.'%')
            ->orWhere('name', 'LIKE', '%'.$query.'%')
            ->orWhere('patronymic', 'LIKE', '%'.$query.'%')
            ->get();
    }
>>>>>>> f7fdead (2 done)
}