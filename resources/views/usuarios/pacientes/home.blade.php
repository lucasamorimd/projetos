@extends('adminlte::page')
@section('title','Pacientes')
@section('content_header')
<h1>Usuários</h1>
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
                <h6 class="card-category text-gray text-center">Lista de Pacientes cadastrados</h6>
                <h4 class="card-title"></h4>


                <div class="row">
                    <div class="col">
                        <div class="card">
                            <h4 class="card-header text-center">Pacientes</h4>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Paciente</th>
                                                <th scope="col">Telefone</th>
                                                <th scope="col">E-mail</th>
                                                <th scope="col">Detalhar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pacientes as $paciente)
                                            <tr>
                                                <th scope="row">{{$paciente->nome}}</th>
                                                <td>{{$paciente->telefone}}</td>
                                                <td>{{$paciente->email}}</td>
                                                <td> <a href="{{route('detalharPaciente', $paciente->id_usuario)}}" class="btn btn-primary"><i class="fas fa-info-circle"></i></a></td>
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