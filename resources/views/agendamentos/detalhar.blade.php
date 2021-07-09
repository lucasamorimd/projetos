@extends('adminlte::page')
@section('title', 'Agendamentos')
@section('content_header')
<h1>{{$agendamento->nome_atendimento}}</h1>
@endsection
@section('content')
<div class="card">
    <h4 class="card-header text-center">Dados do Atendimento</h4>
    <div class="card-body">
        <div class="row  justify-content-center">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="text-left">
                            <tr>
                                <th>Contato do Paciente</th>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody class="text-left">
                            <tr>
                                <th scope="row">Nome: </th>
                                <td>{{$agendamento->nome_paciente}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Telefone: </th>
                                <td>{{$agendamento->telefone_paciente}}</td>
                            </tr>
                            <tr>
                                <th scope="row">E-mail: </th>
                                <td>{{$agendamento->email_paciente}}</td>
                            </tr>
                            <thead class="text-left">
                                <tr>
                                    <th scope="row">Informações do agendamento</th>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            <tr>
                                <th scope="row">Tipo de Atendimento: </th>
                                <td>{{ucfirst($agendamento->tipo_atendimento)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nome do Atendimento: </th>
                                <td>{{ucfirst($agendamento->nome_atendimento)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Data do atendimento: </th>
                                <td>{{date('d/m/Y',strtotime($agendamento->data_atendimento))}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Horário do atendimento: </th>
                                <td>{{date('h:i',strtotime($agendamento->hora_atendimento))}} horas</td>
                            </tr>
                            <tr>
                                <th scope="row">Dados do Médico </th>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#medico">{{$medico->nome_medico}}</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Dados da Unidade </th>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#unidade">{{$unidade->nome_unidade}}</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Dados do Serviço </th>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#servico">{{$servico->nome_servico}}</button>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row">Unidade:</th>
                                <td>{{$unidade->nome_unidade}} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted text-center">
        <a class="btn btn-primary" href="{{route('atenderPendente',$agendamento->id_agendamento)}}">Atender</a>
    </div>
    <div id="medico" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                @include('agendamentos.modals.medico',['medico'=>$medico])
            </div>
        </div>
    </div>
    <div id="unidade" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                @include('agendamentos.modals.unidade',['unidade'=>$unidade])
            </div>
        </div>
    </div>
    <div id="servico" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                @include('agendamentos.modals.servico',['servico'=>$servico])
            </div>
        </div>
    </div>
</div>
@endsection