@extends('adminlte::page')
@section('title')
{{$usuario->nome}}
@endsection
@section('content_header')
<h1>{{$usuario->nome}}</h1>
@endsection
@section('content')
<div class="card">
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
                                <td>{{$usuario->nome}}</td>
                            </tr>
                            <tr>
                                <th scope="row">R.G: </th>
                                <td>{{$usuario->rg}}</td>
                            </tr>
                            <tr>
                                <th scope="row">E-mail: </th>
                                <td>{{$usuario->email}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Telefone: </th>
                                <td>{{$usuario->telefone}}</td>
                            </tr>
                            <tr>
                                <th scope="row">CEP: </th>
                                <td>{{$usuario->cep}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Endereço: </th>
                                <td>{{$usuario->endereco}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Cidade: </th>
                                <td>{{$usuario->cidade}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Estado: </th>
                                <td>{{$usuario->estado}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sexo: </th>
                                <td>{{($usuario->sexo) == 'm' ? 'Masculino':'Feminino'}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Data de Nescimento: </th>
                                <td>{{date('d/m/Y',strtotime($usuario->data_nascimento))}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Data de Cadastro: </th>
                                <td>{{date('d/m/Y',strtotime($usuario->data_cadastro))}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection