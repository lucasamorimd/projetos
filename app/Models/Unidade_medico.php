<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade_medico extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =  [
        'id_unidade',
        'id_medico'
    ];
}
