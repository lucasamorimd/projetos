<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico_servico extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =
    [
        'id_medico',
        'id_servico',
        'nome_servico'
    ];
}
