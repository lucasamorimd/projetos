<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Medico;
use App\Models\Servico;
use App\Models\Unidade;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($situacaoInicial)
    {
        $situacao = substr($situacaoInicial, 0, -1);
        $agendamentos = Agendamento::where('situacao', $situacao)->get();
        return view('agendamentos.home', ['agendamentos' => $agendamentos, 'titulo' => $situacaoInicial]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show(
        Agendamento $agendamento,
        Usuario $usuario,
        Unidade $unidade,
        Servico $servico,
        Medico $medico,
        $situacao,
        $id
    ) {
        $dados_agendamento = $agendamento->where('id_agendamento', $id)->first();
        $dados_usuario = $usuario->where('id_usuario', $dados_agendamento->id_usuario)->first();
        $dados_unidade = $unidade->where('id_unidade', $dados_agendamento->id_unidade)->first();
        $dados_servico = $servico->where('id_servico', $dados_agendamento->id_servico)->first();
        $dados_medico = $medico->where('id_medico', $dados_agendamento->id_medico)->first();
        return view('agendamentos.detalhar', [
            'agendamento' => $dados_agendamento,
            'usuario' => $dados_usuario,
            'unidade' => $dados_unidade,
            'servico' => $dados_servico,
            'medico' => $dados_medico,
            'situacao' => $situacao,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamento $agendamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento)
    {
        //
    }
}
