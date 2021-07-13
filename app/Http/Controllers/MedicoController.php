<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoStoreRequest;
use App\Models\Medico;
use App\Models\Medico_servico;
use App\Models\Servico;
use App\Models\Unidade;
use App\Models\Unidade_medico;
use App\Models\Unidade_servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class MedicoController extends Controller
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
    public function index()
    {
        if (Auth::user()->tipo_perfil === 'administrador') {
            $dados_medicos = Medico::all();
        } else {
            $dados_medicos = Medico::where('id_unidade', Auth::user()->id_unidade)->get();
        }
        return view('medicos.home', ['medicos' => $dados_medicos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('admin')) {
            return redirect()->route('home')->with('aviso', ['msg' => 'Não autorizado']);
        }
        $dados_unidades = Unidade::all();
        return view('medicos.cadastrar', ['unidades' => $dados_unidades]);
    }

    public function servicosAjax(Request $request)
    {
        if (!Gate::allows('admin')) {
            return redirect()->route('home')->with('aviso', ['msg' => 'Não autorizado']);
        }
        $id_servicos = Unidade_servico::where('id_unidade', $request->id)->select('id_servico')->get();
        $unidade_servicos = Servico::whereIn('id_servico', $id_servicos)->get();

        return $unidade_servicos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicoStoreRequest $request)
    {
        if (!Gate::allows('admin')) {
            return redirect()->route('home')->with('aviso', ['msg' => 'Não autorizado']);
        }
        $novo_medico = Medico::create([
            'id_unidade' => $request->unidade,
            'crm' => $request->crm,
            'nome_medico' => $request->nome,
            'area_atuacao' => $request->area_atuacao
        ]);

        if ($request->servicos) {
            foreach ($request->servicos as $servico) {
                $nome_servico = Servico::where('id_servico', $servico)->select('tipo_servico')->first();

                Medico_servico::create([
                    'id_servico' => $servico,
                    'id_medico' => $novo_medico->id,
                    'nome_servico' => $nome_servico->tipo_servico
                ]);
            }
        }
        Unidade_medico::create([
            'id_unidade' => $request->unidade,
            'id_medico' => $novo_medico->id
        ]);

        $notify_title = 'Cadastro';
        $notify_subtitle = 'Médico';

        $msg = 'Médico Cadastrado!';
        $bg_notificacao = 'bg-primary';

        return redirect()->route('medicos')->with('aviso', [
            'msg' => $msg,
            'bg_notificacao' => $bg_notificacao,
            'titulo_notificacao' => $notify_title,
            'subtitulo_notificacao' => $notify_subtitle
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(
        Medico $medico,
        Unidade $unidade,
        Medico_servico $medico_servico,
        Servico $servico,
        $id
    ) {


        $dados_medico = $medico->where('id_medico', $id)->first();

        $dados_unidade = $unidade->where('id_unidade', $dados_medico->id_unidade)->first();

        $id_servicos = $medico_servico->where('id_medico', $id)->select('id_servico')->get();

        $medico_servicos = $servico->whereIn('id_servico', $id_servicos)->get();

        return view('medicos.detalhar', [
            'medico' => $dados_medico,
            'unidade' => $dados_unidade,
            'servicos' => $medico_servicos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Medico $medico,
        Unidade $unidade,
        Unidade_servico $unidade_servico,
        Medico_servico $medico_servico,
        Servico $servico,
        $id
    ) {

        if (!Gate::allows('admin')) {
            return redirect()->route('home')->with('aviso', ['msg' => 'Não autorizado']);
        }

        $dados_medico = $medico->where('id_medico', $id)->first();

        $dados_unidade = $unidade->where('id_unidade', $dados_medico->id_unidade)->first();

        $id_servicos = $unidade_servico->where('id_unidade', $dados_unidade->id_unidade)->select('id_servico')->get();

        $id_servicos_medico = $medico_servico->where('id_medico', $id)->select('id_servico')->get();

        $dados_servicos_medico = $servico->whereIn('id_servico', $id_servicos_medico)->get();

        $dados_servicos = $servico->whereIn('id_servico', $id_servicos)->get();


        $colection_servicos = collect($dados_servicos);
        $colection_servicos_medico = collect($dados_servicos_medico);

        $servicos_disponiveis = $colection_servicos->diff($colection_servicos_medico);


        return view('medicos.alterar', [
            'medico' => $dados_medico,
            'unidade' => $dados_unidade,
            'servicos' => $servicos_disponiveis,
            'servicos_medico' => $dados_servicos_medico,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medico)
    {

        if (!Gate::allows('admin')) {
            return redirect()->route('home')->with('aviso', ['msg' => 'Não autorizado']);
        }

        $alteracao_medico = $medico->where('id_medico', $request->id_medico)
            ->update([
                'nome_medico' => $request->nome,
                'crm' => $request->crm,
                'area_atuacao' => $request->area_atuacao
            ]);
        Medico_servico::where('id_medico', $request->id_medico)->delete();
        foreach ($request->servicos as $servico) {
            $nome_servico = Servico::where('id_servico', $servico)->select('tipo_servico')->first();
            Medico_servico::create([
                'id_medico' => $request->id_medico,
                'id_servico' => $servico,
                'nome_servico' => $nome_servico->tipo_servico
            ]);
        }

        if ($alteracao_medico === 1) {
            $msg = "Médico alterado com sucesso!";
            $bg_notificacao = 'bg-primary';
        } else {
            $msg = "Houve algum problema na alteração, tente novamente";
            $bg_notificacao = 'bg-danger';
        }

        $notify_title = 'Cadastro';
        $notify_subtitle = 'Médico';


        return redirect()->route('alterarMedico', $request->id_medico)->with('aviso', [
            'msg' => $msg,
            'bg_notificacao' => $bg_notificacao,
            'titulo_notificacao' => $notify_title,
            'subtitulo_notificacao' => $notify_subtitle
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico, $id)
    {

        if (!Gate::allows('admin')) {
            return redirect()->route('home')->with('aviso', ['msg' => 'Não autorizado']);
        }

        $deletar_medico = $medico->where('id_medico', $id)->delete();
        if ($deletar_medico === 1) {
            $msg = "Médico excluído com sucesso";
            $bg_notificacao = 'bg-primary';
        } else {
            $msg = "Erro ao excluír, tente novamente";
            $bg_notificacao = 'bg-danger';
        }
        $notify_title = 'Cadastro';
        $notify_subtitle = 'Médico';

        return redirect()->route('medicos')->with('aviso', [
            'msg' => $msg,
            'bg_notificacao' => $bg_notificacao,
            'titulo_notificacao' => $notify_title,
            'subtitulo_notificacao' => $notify_subtitle
        ]);
    }
}
