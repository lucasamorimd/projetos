<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade_servico extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable =
    [
        'id_servico',
        'id_unidade',
        'nome_servico'
    ];
}
