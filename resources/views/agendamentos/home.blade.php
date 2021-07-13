@extends('adminlte::page')
@section('title')
{{ucfirst($titulo)}}
@endsection
@section('content_header')
@if(session('aviso'))
<div class="alert {{session('aviso')['bg_notificacao']}}">{{session('aviso')['msg']}}</div>
@endif
<h1>{{ucfirst($titulo)}}</h1>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-profile ">
            <div class="card-avatar">
                <a href="javascript:;">
                    <img class="img" src="" />
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-category text-gray text-center">Lista de Agendamentos {{$titulo}}</h6>
                <h4 class="card-title"></h4>


                <div class="row">
                    <div class="col">
                        <div class="card">
                            <h4 class="card-header text-center">Agendamentos</h4>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-hover table-striped">
                                        <caption>Lista de Agendamentos {{$titulo}}</caption>
                                        <thead>
                                            <tr>
                                                <th scope="col">Paciente</th>
                                                <th scope="col">Telefone</th>
                                                <th scope="col">Tipo de Atendimento</th>
                                                <th scope="col">Nome do Serviço</th>
                                                <th scope="col">Data de atendimento</th>
                                                <th scope="col">Detalhar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($agendamentos as $agendamento)
                                            <tr>
                                                <th scope="row">{{$agendamento->nome_paciente}}</th>
                                                <td>{{$agendamento->telefone_paciente}}</td>
                                                <td>{{ucfirst($agendamento->tipo_atendimento)}}</td>
                                                <td>{{$agendamento->nome_atendimento}}</td>
                                                <td>{{date('d/m/Y',strtotime($agendamento->data_atendimento))}}</td>
                                                <td> <a href="{{route('detalharAgendamento', [$url, $agendamento->id_agendamento])}}" class="btn btn-primary"><i class="fas fa-info-circle"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-muted">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection