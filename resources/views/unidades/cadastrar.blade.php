@extends('adminlte::page')
@section('title','Nova Unidade')
@section('content_header')
<h1>Nova Unidade</h1>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="text-center">Formulário de Cadastro de Unidade</h4>
    </div>
    <div class="card-body">
        @include('components.validation')
        <div class="row  justify-content-center">
            <div class="col">
                <form id="cadastrar" action="{{route('salvarUnidade')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input name="nome" id="nome" type="text" class="form-control " placeholder="Nome Completo">
                            @error('nome')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                        <div class="col-sm-10">
                            <input name="telefone" id="telefone" type="text" class="form-control " placeholder="(DDD) 99999-9999">
                            @error('telefone')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="endereco" class="col-sm-2 col-form-label">Endereço</label>
                        <div class="col-sm-10">
                            <input name="endereco" id="endereco" type="text" class="form-control " placeholder="Endereço da nova Unidade">

                            @error('endereco')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cidade" class="col-sm-2 col-form-label">Cidade</label>
                        <div class="col-sm-10">
                            <input name="cidade" id="cidade" type="text" class="form-control " placeholder="Em qual cidade fica a nova Unidade?">
                            @error('cidade')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                        <div class="col-sm-10">
                            <input name="estado" id="estado" type="text" class="form-control " placeholder="Em qual estado fica a nova Unidade?">
                            @error('estado')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cnpj" class="col-sm-2 col-form-label">CNPJ</label>
                        <div class="col-sm-10">
                            <input name="cnpj" id="cnpj" type="text" class="form-control " placeholder="Informe o CNPJ da nova Unidade">
                            @error('cnpj')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="servico" class="col-sm-2 col-form-label">Serviços</label>
                        <div class="col-sm-10">
                            @foreach($servicos as $servico)
                            <div class="custom-control custom-checkbox">
                                <input name="servicos[]" class="custom-control-input" type="checkbox" value="{{$servico->id_servico}}" id="defaultCheck{{$servico->id_servico}}">
                                <label class="custom-control-label" for="defaultCheck{{$servico->id_servico}}">
                                    {{$servico->nome_servico}}
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
                </form>
            </div>
        </div>
        @include('components.button_cadastrar')
    </div>
</div>

@endsection
@section('js')
@include('components.cadastrar_ajax')
@endsection