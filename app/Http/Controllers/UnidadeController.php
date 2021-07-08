<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadeStoreRequest;
use App\Models\Medico;
use App\Models\Medico_servico;
use App\Models\Servico;
use App\Models\Unidade;
use App\Models\Unidade_medico;
use App\Models\Unidade_servico;
use Illuminate\Http\Request;

class UnidadeController extends Controller
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
        $unidades = Unidade::all();
        return view('unidades.home', ['unidades' => $unidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados_servicos = Servico::all();
        return view('unidades.cadastrar', ['servicos' => $dados_servicos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadeStoreRequest $request)
    {
        $nova_unidade = Unidade::create(
            [
                'nome_unidade' => $request->nome,
                'endereco_unidade' => $request->endereco,
                'cidade_unidade' => $request->cidade,
                'estado_unidade' => $request->estado,
                'telefone_unidade' => $request->telefone,
                'cnpj_unidade' => $request->cnpj,
            ]

        );
        if ($request->servicos) {
            foreach ($request->servicos as $servico) {
                $nome_servico = Servico::where('id_servico', $servico)->select('tipo_servico')->first();

                Unidade_servico::create([
                    'id_servico' => $servico,
                    'id_unidade' => $nova_unidade->id,
                    'nome_servico' => $nome_servico->tipo_servico
                ]);
            }
        }
        $msg = "Unidade cadastrada";
        return redirect()->route('unidades')->with('aviso', ['msg' => $msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function show(
        Unidade $unidade,
        Medico $medico,
        Unidade_servico $id_servicos,
        Servico $servicos,
        $id
    ) {
        $dados_unidade = $unidade->where('id_unidade', $id)->first();
        $id_servicos = $id_servicos->where('id_unidade', $id)->select('id_servico')->get();
        $dados_servicos = $servicos->whereIn('id_servico', $id_servicos)->get();
        $dados_medicos = $medico->where('id_unidade', $id)->get();

        return view(
            'unidades.detalhar',
            [
                'unidade' => $dados_unidade,
                'medicos' => $dados_medicos,
                'servicos' => $dados_servicos
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Unidade $unidade,
        Unidade_medico $unidade_medico,
        Unidade_servico $unidade_servico,
        Servico $servico,
        Medico $medico,
        $id
    ) {
        $dados_unidade = $unidade->where('id_unidade', $id)->first();
        $id_medicos = $unidade_medico->where('id_unidade', $id)->select('id_medico')->get();
        $id_servicos = $unidade_servico->where('id_unidade', $id)->select('id_servico')->get();

        $dados_servicos = $servico->whereIn('id_servico', $id_servicos)->get();
        $dados_medicos = $medico->whereIn('id_medico', $id_medicos)->get();

        $dados_gerais_servicos = $servico->all();
        $dados_gerais_medicos = $medico->all();

        $collection_unidade_servicos = collect($dados_servicos);
        $collection_servicos = collect($dados_gerais_servicos);

        $servicos_disponiveis = $collection_servicos->diff($collection_unidade_servicos);

        $collection_unidade_medicos = collect($dados_medicos);
        $collection_medicos = collect($dados_gerais_medicos);

        $medicos_disponiveis = $collection_medicos->diff($collection_unidade_medicos);

        return view('unidades.alterar', [
            'servicos' => $servicos_disponiveis,
            'medicos' => $medicos_disponiveis,
            'unidade' => $dados_unidade,
            'unidade_medicos' => $dados_medicos,
            'unidade_servicos' => $dados_servicos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidade $unidade)
    {
        $alterar_unidade = $unidade->where('id_unidade', $request->id_unidade)->update(
            [
                'nome_unidade' => $request->nome,
                'endereco_unidade' => $request->endereco,
                'cidade_unidade' => $request->cidade,
                'estado_unidade' => $request->estado,
                'telefone_unidade' => $request->telefone,
                'cnpj_unidade' => $request->cnpj
            ]
        );
        Unidade_servico::where('id_unidade', $request->id_unidade)->delete();
        foreach ($request->servicos as $servico) {
            $nome_servico = Servico::where('id_servico', $servico)->select('tipo_servico')->first();
            Unidade_servico::create([
                'id_unidade' => $request->id_unidade,
                'id_servico' => $servico,
                'nome_servico' => $nome_servico->tipo_servico
            ]);
        }
        Unidade_medico::where('id_unidade', $request->id_unidade)->delete();

        foreach ($request->medicos as $medico) {
            Medico_servico::where('id_medico', $medico)->delete();
            Unidade_medico::create([
                'id_unidade' => $request->id_unidade,
                'id_medico' => $medico
            ]);
            Medico::where('id_medico', $medico)->update([
                'id_unidade' => $request->id_unidade
            ]);
        }
        $msg = "Alteração realizada com sucesso!";
        return redirect()->route('alterarUnidade', $request->id_unidade)->with('aviso', ['msg' => $msg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
    }
    public function destroyServicoUnidade($id_servico, $id_unidade)
    {
        Unidade_servico::where('id_servico', $id_servico)->where('id_unidade', $id_unidade)->delete();
        $id_medicos = Medico::where('id_unidade', $id_unidade)->select('id_medico')->get();
        Medico_servico::whereIn('id_medico', $id_medicos)->where('id_servico', $id_servico)->delete();

        return redirect()->route('detalharUnidade', $id_unidade)->with('aviso', ['msg' => 'Excluído com sucesso!']);
    }
}
