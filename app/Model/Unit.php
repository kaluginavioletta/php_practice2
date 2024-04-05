<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\Auth;
use Src\Request;
class Unit extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'unit_name',
        'id_view'
    ];

    public function getUnits()
    {
        return "{$this->unit_name}, {$this->view->getViews()}";
    }

    public function view()
    {
        return $this->belongsTo(View::class, 'id_view', 'id_view');
    }
}