<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_unidade',
        'endereco_unidade',
        'cidade_unidade',
        'estado_unidade',
        'telefone_unidade',
        'cnpj_unidade'
    ];
}
