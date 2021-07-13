@extends('adminlte::page')
@section('title', 'Unidades')
@section('content_header')
<h1> Unidades <a href="{{route('cadastrarUnidade')}}" class="btn btn-primary">Nova Unidade</a></h1>
@endsection
@section('content')
<div class="card">
    <h4 class="card-header text-center">Unidades cadastradas no sistema</h4>
    <div class="card-body">
        <div class="row justify-content-center">
            @foreach($unidades as $unidade)
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-hospital"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><a href="{{route('detalharUnidade',$unidade->id_unidade)}}">{{$unidade->nome_unidade}}</a></span>
                        <span class="info-box-number">{{$unidade->cidade_unidade}}</span>
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
@if(session('aviso'))
@section('js')
@include('components.toast')
@endsection
@endif