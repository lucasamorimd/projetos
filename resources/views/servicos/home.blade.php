@extends('adminlte::page')
@section('title', 'Serviços')
@section('content_header')
<h1> Serviços <a href="{{route('cadastrarServico')}}" class="btn btn-primary">Novo Serviço</a></h1>
@endsection
@section('content')
<div class="card">
    <h4 class="card-header text-center">Serviços cadastrados no sistema</h4>
    <div class="card-body">
        <div class="row justify-content-center">
            @foreach($servicos as $servico)
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-stethoscope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{route('detalharServico', $servico->id_servico)}}">{{$servico->nome_servico}}</a></span>
                        <span class="info-box-number">{{$servico->tipo_servico}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>
@endsection