<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data_atual = date('Y-m-d');
        $exames_realizados = Agendamento::where('id_unidade', Auth::user()
            ->id_unidade)
            ->where('situacao', 'realizado')
            ->where('tipo_atendimento', 'exames')->get();

        $exames_pendentes = Agendamento::where('id_unidade', Auth::user()
            ->id_unidade)
            ->where('situacao', 'pendente')
            ->where('tipo_atendimento', 'exames')
            ->where('data_atendimento', $data_atual)
            ->get();

        $exames_aguardando = Agendamento::where('id_unidade', Auth::user()
            ->id_unidade)
            ->where('situacao', 'aguardando-resultado')
            ->where('tipo_atendimento', 'exames')->get();

        $procedimentos_realizados = Agendamento::where('id_unidade', Auth::user()
            ->id_unidade)
            ->where('situacao', 'realizado')
            ->where('tipo_atendimento', 'procedimentos')->get();

        $procedimentos_pendentes = Agendamento::where('id_unidade', Auth::user()
            ->id_unidade)
            ->where('situacao', 'pendente')
            ->where('tipo_atendimento', 'procedimentos')
            ->where('data_atendimento', $data_atual)
            ->get();

        $procedimentos_aguardando = Agendamento::where('id_unidade', Auth::user()
            ->id_unidade)
            ->where('situacao', 'aguardando-resultado')
            ->where('tipo_atendimento', 'procedimentos')->get();

        $consultas_realizadas = Agendamento::where('id_unidade', Auth::user()
            ->id_unidade)
            ->where('situacao', 'realizado')
            ->where('tipo_atendimento', 'consultas')->get();

        $consultas_pendentes = Agendamento::where('id_unidade', Auth::user()
            ->id_unidade)
            ->where('situacao', 'pendente')
            ->where('tipo_atendimento', 'consultas')
            ->where('data_atendimento', $data_atual)
            ->get();

        $consultas_aguardando = Agendamento::where('id_unidade', Auth::user()
            ->id_unidade)
            ->where('situacao', 'aguardando-resultado')
            ->where('tipo_atendimento', 'consultas')->get();

        return view(
            'home',
            [

                'procedimentos' => [
                    'realizados' => $procedimentos_realizados,
                    'pendentes' => $procedimentos_pendentes,
                    'aguardando' => $procedimentos_aguardando
                ],

                'exames' => [
                    'realizados' => $exames_realizados,
                    'pendentes' => $exames_pendentes,
                    'aguardando' => $exames_aguardando
                ],

                'consultas' => [
                    'realizados' => $consultas_realizadas,
                    'pendentes' => $consultas_pendentes,
                    'aguardando' => $consultas_aguardando
                ]


            ]
        );
    }
}
