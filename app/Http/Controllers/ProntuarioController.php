<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Prontuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProntuarioController extends Controller
{
    public function baixarPDF($id, $nome_arquivo)
    {

        $prontuario = Prontuario::where('nome_arquivo', $nome_arquivo)->select('id_prontuario')->first();
        $agendamento = Agendamento::where('id_prontuario', $prontuario->id_prontuario)->select('id_usuario')->first();
        if ($id == $agendamento->id_usuario) {
            $filepath = storage_path() . "\app\public\prontuarios/" . $nome_arquivo;
            return response()->download($filepath);
            //return Storage::download('public/prontuarios', $nome_arquivo);
        }
    }
}
