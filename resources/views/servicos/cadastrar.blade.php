@extends('adminlte::page')
@section('title','Novo Serviço')
@section('content_header')
<h1>Novo Serviço</h1>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="text-center">Formulário de Cadastro de Serviço</h4>
    </div>
    <div class="card-body">
        <div class="row  justify-content-center">
            <div class="col">
                <form id="cadastrar_servico" action="{{route('salvarServico')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input name="nome" id="nome" type="text" class="form-control " placeholder="Nome do Serviço">
                            @error('nome')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipo_servico" class="col-sm-2 col-form-label">Tipo de serviço</label>
                        <div class="col-sm-10">
                            <select id="tipo_servico" class="custom-select " name="tipo_servico">
                                <option value="exames">Exame</option>
                                <option value="procedimentos">Procedimento</option>
                                <option value="consultas">Consulta</option>
                            </select>
                            @error('tipo_servico')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempo_estimado" class="col-sm-2 col-form-label">Tempo de duração</label>
                        <div class="col-sm-10">
                            <input name="tempo_estimado" id="tempo_estimado" type="number" class="form-control " placeholder="Número de horas de duração estimada">

                            @error('tempo_estimado')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="preco" class="col-sm-2 col-form-label">Preço</label>
                        <div class="col-sm-10">
                            <input name="preco" id="preco" type="number" class="form-control " placeholder="Qual será o valor do serviço?">
                            @error('preco')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descricao" class="col-sm-2 col-form-label">Descrição</label>
                        <div class="col-sm-10">
                            <textarea name="descricao" id="descricao" type="text" class="form-control " placeholder="Diga um resumo do serviço"></textarea>
                            @error('descricao')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unidades" class="col-sm-2 col-form-label">Unidades</label>
                        <div class="col-sm-10">
                            @foreach($unidades as $unidade)
                            <div class="custom-control custom-checkbox">
                                <input name="unidades[]" class="custom-control-input" type="checkbox" value="{{$unidade->id_unidade}}" id="defaultCheck{{$unidade->id_unidade}}">
                                <label class="custom-control-label" for="defaultCheck{{$unidade->id_unidade}}">
                                    {{$unidade->nome_unidade}}
                                </label>
                            </div>
                            @endforeach
                            @error('unidades[]')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            <button class="btn btn-primary" type="submit" onclick="cadastrar_servico()">Salvar</button>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    function cadastrar_servico() {
        var form = document.getElementById('cadastrar_servico')
        form.submit()
    }
</script>
@endsection