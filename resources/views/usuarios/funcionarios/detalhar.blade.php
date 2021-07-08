@extends('adminlte::page')
@section('title')
{{$funcionario->nome_funcionario}}
@endsection
@section('content_header')
<h1>{{$funcionario->nome_funcionario}}</h1>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row  justify-content-center">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="row">Informações da Conta</th>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody class="text-left">
                            <tr>
                                <th scope="row">Nome: </th>
                                <td>{{$funcionario->nome_funcionario}}</td>
                            </tr>
                            <tr>
                                <th scope="row">E-mail: </th>
                                <td>{{$funcionario->email}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Perfil: </th>
                                <td>{{$funcionario->tipo_perfil}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Data de Cadastro: </th>
                                <td>{{date('d/m/Y',strtotime($funcionario->created_at))}}</td>
                            </tr>

                            <thead>
                                <tr>
                                    <th scope="row">Informações da Unidade</th>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            <tr>
                                <th scope="row">Unidade: </th>
                                <td>{{$unidade->nome_unidade}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Endereço: </th>
                                <td>{{$unidade->endereco_unidade}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Cidade: </th>
                                <td>{{$unidade->cidade_unidade}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Estado: </th>
                                <td>{{$unidade->estado_unidade}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Telefone: </th>
                                <td>{{$unidade->telefone_unidade}}</td>
                            </tr>
                            <tr>
                                <th scope="row">CNPJ: </th>
                                <td>{{$unidade->cnpj_unidade}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted text-center">
        <a class="btn btn-primary" href="#">Alterar</a>
    </div>
</div>
@endsection