<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_servico',
        'tipo_servico',
        'tempo_estimado',
        'preco_servico',
        'descricao_servico'
    ];
}
