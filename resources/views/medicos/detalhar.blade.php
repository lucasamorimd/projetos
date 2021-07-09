@extends('adminlte::page')
@section('title', 'Medicos')
@section('content_header')
<h1>{{$medico->nome_medico}}</h1>
@endsection
@section('content')
<div class="card">
    <h4 class="card-header text-center">Dados do(a) médico(a)</h4>
    <div class="card-body">
        <div class="row  justify-content-center">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                            </tr>
                        </thead>
                        <tbody class="text-left">
                            <tr>
                                <th scope="row">Nome: </th>
                                <td>{{$medico->nome_medico}}</td>
                            </tr>
                            <tr>
                                <th scope="row">CRM: </th>
                                <td>{{$medico->crm}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Área de Atuação: </th>
                                <td>{{$medico->area_atuacao}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Data de Cadastro: </th>
                                <td>{{date('d/m/Y',strtotime($medico->data_cadastro))}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Serviços que Realiza: </th>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#servico">Detalhar</button>
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
        @can('admin')
        <a class="btn btn-primary" href="{{route('alterarMedico',$medico->id_medico)}}">Alterar</a>
        @endcan
    </div>
    <div id="servico" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                @include('medicos.modals.servicos',['servicos'=>$servicos])
            </div>
        </div>
    </div>
</div>
@endsection