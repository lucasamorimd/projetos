@extends('adminlte::page')
@section('title')
{{$unidade->nome_unidade}}
@endsection
@section('content_header')
<h1> {{$unidade->nome_unidade}}</h1>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-profile ">
            <div class="card-header">
                <h2 class="text-center">
                    {{$unidade->nome_unidade}}
                </h2>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <h4 class="card-header text-center">Médicos da Unidade</h4>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-hover table-striped">
                                        <caption>Lista de Médicos dessa Unidade</caption>
                                        <thead>
                                            <tr>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Área de atuação</th>
                                                <th scope="col">CRM</th>
                                                <th scope="col">Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($medicos as $medico)
                                            <tr>
                                                <th scope="row">{{$medico->nome_medico}}</th>
                                                <td>{{$medico->area_atuacao}}</td>
                                                <td>{{$medico->crm}}</td>
                                                <td> <a href="{{route('alterarMedico',$medico->id_medico)}}" class="btn btn-primary"><i class="fas fa-user-edit"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <h4 class="card-header text-center">Servicos da Unidade</h4>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-hover table-striped">
                                        <caption>Lista de Serviços dessa Unidade</caption>
                                        <thead>
                                            <tr>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Preço</th>
                                                <th scope="col">Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($servicos as $servico)
                                            <tr>
                                                <th scope="row">{{$servico->nome_servico}}</th>
                                                <td>{{$servico->tipo_servico}}</td>
                                                <td>R$ {{number_format($servico->preco_servico, 2, ',', ' ')}}</td>
                                                <td><a href="{{route('excluirServicoUnidade',[$servico->id_servico,$unidade->id_unidade])}}" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-muted text-center">
                <a href="{{route('alterarUnidade',$unidade->id_unidade)}}" class="btn btn-primary">Alterar</a>
            </div>
        </div>
    </div>
</div>
@endsection