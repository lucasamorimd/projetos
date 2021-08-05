@extends('adminlte::page')
@section('title')
{{$servico->nome_servico}}
@endsection
@section('content_header')
<h1>{{$servico->nome_servico}}</h1>
@endsection
@section('content')
<div class="card">
    <h4 class="card-header text-center">Dados do Serviço</h4>
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
                                <td>{{$servico->nome_servico}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tipo de Serviço: </th>
                                <td>{{$servico->tipo_servico}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Preço do Serviço: </th>
                                <td>R$ {{number_format($servico->preco_servico, 2, ',', ' ')}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tempo de Duração </th>
                                <td>{{$servico->tempo_estimado}}</td>
                            </tr>
                            <tr>
                                <th class="align-middle" scope="row">Descrição:</th>
                                <td>{{$servico->descricao_servico}} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer text-muted text-center">
        @can('admin')
        <a href="{{route('alterarServico',$servico->id_servico)}}" class="btn btn-primary">Alterar</a>
        @endcan
    </div>
</div>
@endsection