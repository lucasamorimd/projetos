@extends('adminlte::page')
@section('title','Novo Médico')
@section('content_header')
@if(session('aviso'))
<div class="alert {{session('aviso')['bg_notificacao']}}">{{session('aviso')['msg']}}</div>
@endif
<h1>{{$medico->nome_medico}} <a class="btn btn-danger" href="{{route('excluirMedico',$medico->id_medico)}}">Excluir</a></h1>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-center">Informações</h4>
    </div>
    <div class="card-body">
        <div class="row  justify-content-center">
            <div class="col">
                <form id="alterar" action="{{route('salvarAlteracaoMedico')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input name="nome" id="nome" type="text" class="form-control " value="{{$medico->nome_medico}}">
                            @error('nome')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crm" class="col-sm-2 col-form-label">CR</label>
                        <div class="col-sm-10">
                            <input name="crm" id="crm" type="text" class="form-control " value="{{$medico->crm}}">
                            @error('crm')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="area_atuacao" class="col-sm-2 col-form-label">Área de Atuação</label>
                        <div class="col-sm-10">
                            <input name="area_atuacao" id="area_atuacao" type="text" class="form-control " value="{{$medico->area_atuacao}}">

                            @error('area_atuacao')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unidade" class="col-sm-2 col-form-label">Unidade</label>
                        <div class="col-sm-10">
                            <select id="unidade" class="custom-select " name="unidade" readonly>
                                <option selected value="{{$unidade->id_unidade}}">{{$unidade->nome_unidade}}</option>
                            </select>
                            @error('unidade')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="servico" class="col-sm-2 col-form-label">Serviços</label>
                        <div class="col-sm-10">
                            @foreach($servicos_medico as $servico_med)
                            <div class="custom-control custom-checkbox">
                                <input name="servicos[]" class="custom-control-input" type="checkbox" value="{{$servico_med->id_servico}}" id="defaultCheck{{$servico_med->id_servico}}" checked>
                                <label class="custom-control-label" for="defaultCheck{{$servico_med->id_servico}}">
                                    {{$servico_med->nome_servico}} ({{$servico_med->tipo_servico}})
                                </label>
                            </div>
                            @endforeach
                            @foreach($servicos as $servico)
                            <div class="custom-control custom-checkbox">
                                <input name="servicos[]" class="custom-control-input" type="checkbox" value="{{$servico->id_servico}}" id="defaultCheck{{$servico->id_servico}}">
                                <label class="custom-control-label" for="defaultCheck{{$servico->id_servico}}">
                                    {{$servico->nome_servico}} ({{$servico->tipo_servico}})
                                </label>
                            </div>
                            @endforeach
                            @error('servicos[]')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <input type="hidden" value="{{$medico->id_medico}}" name="id_medico" />
                </form>
            </div>
        </div>
        @include('components.button_alterar')
    </div>
</div>

@endsection
@section('js')
@include('components.alterar_ajax')
@endsection