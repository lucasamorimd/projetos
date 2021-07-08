@extends('adminlte::page',['teste'=> Auth::user()->nome_funcionario])
@section('title')
{{$servico->nome_servico}}
@endsection
@section('content_header')
<h1>{{$servico->nome_servico}} {{Auth::user()->nome_funcionario}}</h1>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="text-center">Informações do serviço ({{$servico->nome_servico}})</h4>
    </div>
    <div class="card-body">
        <div class="row  justify-content-center">
            <div class="col">
                <form id="alterar_servico" action="{{route('salvarAlteracaoServico')}}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input name="nome" id="nome" type="text" class="form-control " value="{{$servico->nome_servico}}">
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
                                <option value="{{$servico->tipo_servico}}" selected>{{ucfirst($servico->tipo_servico)}}</option>
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
                            <input name="tempo_estimado" id="tempo_estimado" type="number" class="form-control " value="{{$servico->tempo_estimado}}">

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
                            <input name="preco" id="preco" type="number" class="form-control " value="{{$servico->preco_servico}}">
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
                            <textarea name="descricao" id="descricao" type="text" class="form-control " value="{{$servico->descricao_servico}}">{{$servico->descricao_servico}}</textarea>
                            @error('descricao')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @foreach($unidades as $unidade)
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-4">
                            <div class="custom-control custom-checkbox">
                                <input checked name="unidades[]" class="custom-control-input" type="checkbox" value="{{$unidade->id_unidade}}" id="defaultCheck{{$unidade->id_unidade}}">
                                <label class="custom-control-label" for="defaultCheck{{$unidade->id_unidade}}">
                                    {{$unidade->nome_unidade}}
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            Médicos
                            @foreach($medicos as $medico)
                            @if($medico->id_unidade === $unidade->id_unidade)
                            <div class="custom-control custom-checkbox">
                                <input checked name="medicos[]" class="custom-control-input" type="checkbox" value="{{$medico->id_medico}}" id="medico{{$medico->id_medico}}">
                                <label class="custom-control-label" for="medico{{$medico->id_medico}}">
                                    {{$medico->nome_medico}}
                                </label>
                            </div>
                            @endif
                            @endforeach
                            @foreach($medicos_disp as $medico)
                            @if($medico->id_unidade === $unidade->id_unidade)
                            <div class="custom-control custom-checkbox">
                                <input name="medicos[]" class="custom-control-input" type="checkbox" value="{{$medico->id_medico}}" id="medico{{$medico->id_medico}}">
                                <label class="custom-control-label" for="medico{{$medico->id_medico}}">
                                    {{$medico->nome_medico}}
                                </label>
                            </div>
                            @endif
                            @endforeach
                            @error('unidades[]')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    @endforeach
                    @foreach($unidades_disp as $unidade)
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <div class="custom-control custom-checkbox">
                                <input name="unidades[]" class="custom-control-input" type="checkbox" value="{{$unidade->id_unidade}}" id="unidade{{$unidade->id_unidade}}">
                                <label class="custom-control-label" for="unidade{{$unidade->id_unidade}}">
                                    {{$unidade->nome_unidade}}
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            Médicos

                            @foreach($medicos_disp as $medico)
                            @if($medico->id_unidade === $unidade->id_unidade)
                            <div class="custom-control custom-checkbox">
                                <input name="medicos[]" class="custom-control-input" type="checkbox" value="{{$medico->id_medico}}" id="medico{{$medico->id_medico}}">
                                <label class="custom-control-label" for="medico{{$medico->id_medico}}">
                                    {{$medico->nome_medico}}
                                </label>
                            </div>
                            @endif
                            @endforeach
                            @error('unidades[]')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    @endforeach
                    <input type="hidden" name="id_servico" value="{{$servico->id_servico}}">
                </form>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            <button class="btn btn-primary" type="submit" onclick="alterar_servico()">Salvar</button>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    function alterar_servico() {
        var form = document.getElementById('alterar_servico')
        form.submit()
    }
</script>
@endsection