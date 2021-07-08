@extends('adminlte::page')
@section('title', 'Medicos')
@section('content_header')
<h1> Medicos <a href="{{route('cadastrarMedico')}}" class="btn btn-primary">Novo Médico</a></h1>
@endsection
@section('content')
<div class="card">
    <h4 class="card-header text-center">Médicos cadastrados no sistema</h4>
    <div class="card-body">
        <div class="row">
            @foreach($medicos as $medico)
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-user-md"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{route('detalharMedico',$medico->id_medico)}}">{{$medico->nome_medico}}</a></span>
                        <span class="info-box-number">CRM: {{$medico->crm}}</span>
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