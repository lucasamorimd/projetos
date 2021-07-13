@extends('adminlte::page')
@section('title', 'Home')
@section('content_header')
<h1> Painel de Controle</h1>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>Exames</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{route('agendamentos','realizados')}}">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{count($exames['realizados'])}}</h3>
                                    <p>Realizados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('agendamentos','pendentes')}}">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{count($exames['pendentes'])}}</h3>
                                    <p>Pendentes de {{date('d/m/Y')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa fa-calendar-alt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('agendamentos','aguardando-resultado')}}">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{count($exames['aguardando'])}}</h3>
                                    <p>Aguardando Resultado</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-laptop-medical"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>Procedimentos</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{route('agendamentos','realizados')}}">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{count($procedimentos['realizados'])}}</h3>
                                    <p>Realizados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('agendamentos','pendentes')}}">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{count($procedimentos['pendentes'])}}</h3>
                                    <p>Pendentes de {{date('d/m/Y')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa fa-calendar-alt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('agendamentos','aguardando-resultado')}}">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{count($procedimentos['aguardando'])}}</h3>
                                    <p>Aguardando Resultado</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-laptop-medical"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>Consultas</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{route('agendamentos','realizados')}}">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{count($consultas['realizados'])}}</h3>
                                    <p>Realizados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('agendamentos','pendentes')}}">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{count($consultas['pendentes'])}}</h3>
                                    <p>Pendentes de {{date('d/m/Y')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa fa-calendar-alt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('agendamentos','aguardando-resultado')}}">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{count($consultas['aguardando'])}}</h3>
                                    <p>Aguardando Resultado</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-laptop-medical"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
