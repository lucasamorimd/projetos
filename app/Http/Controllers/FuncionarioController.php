<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioStoreRequest;
use App\Models\Funcionario;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller
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
        $funcionarios = Funcionario::all();
        return view('usuarios.funcionarios.home', ['funcionarios' => $funcionarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados_unidade = Unidade::all();
        return view('usuarios.funcionarios.cadastrar', ['unidades' => $dados_unidade]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuncionarioStoreRequest $request)
    {
        if (!Gate::allows('cadastrar-usuario')) {
            return redirect()->route('home')->with('aviso', ['msg' => 'Não autorizado']);
        }

        $novo_funcionario = Funcionario::create([
            'nome_funcionario' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->senha),
            'id_unidade' => $request->unidade,
            'tipo_perfil' => $request->perfil
        ]);

        $bg_notificacao = 'success';
        $msg = 'Funcionário Cadastrado';
        $notify_title = 'Cadastro';
        $notify_subtitle = 'Funcionários';
        $route = route('funcionarios');
        return  [
            'msg' => $msg,
            'bg_notificacao' => $bg_notificacao,
            'titulo_notificacao' => $notify_title,
            'subtitulo_notificacao' => $notify_subtitle,
            'route' => $route
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario, Unidade $unidade, $id)
    {
        $dados_funcionario = $funcionario->where('id', $id)->first();
        $dados_unidade = $unidade->where('id_unidade', $dados_funcionario->id_unidade)->first();

        return view('usuarios.funcionarios.detalhar', [
            'funcionario' => $dados_funcionario,
            'unidade' => $dados_unidade
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        //
    }
}
