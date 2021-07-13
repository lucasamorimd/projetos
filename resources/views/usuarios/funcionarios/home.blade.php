@extends('adminlte::page')

@section('title', 'Funcionários')

@section('content_header')

<h1>Funcionários <a href="{{route('cadastrarFuncionario')}}" class="btn btn-primary">Novo Funcionário</a></h1>

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
                <h6 class="card-category text-gray text-center">Lista de Funcionários cadastrados</h6>
                <h4 class="card-title"></h4>


                <div class="row">
                    <div class="col">
                        <div class="card">
                            <h4 class="card-header text-center">Funcionarios</h4>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nome</th>
                                                <th scope="col">E-mail</th>
                                                <th scope="col">Perfil</th>
                                                <th scope="col">Detalhar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($funcionarios as $funcionario)
                                            @if($funcionario->id != Auth::user()->id)
                                            <tr>
                                                <th scope="row">{{$funcionario->nome_funcionario}}</th>
                                                <td>{{$funcionario->email}}</td>
                                                <td>{{ucfirst($funcionario->tipo_perfil)}}</td>
                                                <td> <a href="{{route('detalharFuncionario', $funcionario->id)}}" class="btn btn-primary"><i class="fas fa-info-circle"></i></a></td>
                                            </tr>
                                            @endif
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
@if(session('aviso'))
@section('js')
@include('components.toast')
@endsection
@endif