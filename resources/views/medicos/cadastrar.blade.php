@extends('adminlte::page')
@section('title','Novo Médico')
@section('content_header')
<h1>Novo Médico</h1>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="text-center">Formulário de Cadastro de Médico</h4>
    </div>
    <div class="card-body">
        @include('components.validation')
        <div class="row  justify-content-center">
            <div class="col">
                <form enctype="multipart/form-data" id="cadastrar" action="{{route('salvarMedico')}}" method="POST">
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
                        <label for="crm" class="col-sm-2 col-form-label">CR</label>
                        <div class="col-sm-10">
                            <input name="crm" id="crm" type="text" class="form-control " placeholder="Informe a CR do novo Médico">
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
                            <input name="area_atuacao" id="area_atuacao" type="text" class="form-control " placeholder="Em quê o novo médico é especializado?">

                            @error('area_atuacao')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customFile" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input name="foto_medico" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Selecionar Foto (apenas jpg ou png)</label>
                            </div>

                            @error('foto_medico')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unidade" class="col-sm-2 col-form-label">Unidade</label>
                        <div class="col-sm-10">
                            <select id="unidade" class="custom-select " name="unidade">
                                <option value="">Selecione a Unidade do novo funcionário</option>
                                @foreach($unidades as $unidade)
                                <option value="{{$unidade->id_unidade}}">{{$unidade->nome_unidade}}</option>
                                @endforeach
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
                        <div id="container" class="col-sm-10">

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
<script>
    var unidade = document.getElementById('unidade');
    unidade.addEventListener('change', function() {
        var container = document.getElementById('container')
        var contents = document.getElementById('contents')
        if (contents) {
            container.removeChild(contents)
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "{{route('servicosAjax')}}",
            data: {
                id: unidade.value
            },
            dataType: 'json',
            success: function(resultado) {
                var div_contents = document.createElement('div')
                var div_conteiner_checkbox = document.createElement('div')

                div_contents.setAttribute('id', 'contents')

                div_conteiner_checkbox.classList.add('col-sm-10')
                div_conteiner_checkbox.setAttribute('id', 'servicos_check')

                resultado.map(function(obj) {
                    var div_checkbox = document.createElement('div')
                    var input_checkbox = document.createElement('input')
                    var label_checkbox = document.createElement('label')

                    input_checkbox.classList.add('custom-control-input')
                    input_checkbox.setAttribute('name', 'servicos[]')
                    input_checkbox.setAttribute('type', 'checkbox')
                    input_checkbox.setAttribute('value', obj.id_servico)
                    input_checkbox.setAttribute('id', 'defaultCheck' + obj.id_servico)


                    label_checkbox.classList.add('custom-control-label')
                    label_checkbox.setAttribute('for', 'defaultCheck' + obj.id_servico)
                    label_checkbox.innerHTML = `${obj.nome_servico} (${obj.tipo_servico})`

                    div_checkbox.classList.add('custom-control')
                    div_checkbox.classList.add('custom-checkbox')

                    div_checkbox.setAttribute('id', 'check' + obj.id_servico)
                    div_checkbox.appendChild(input_checkbox)
                    div_checkbox.appendChild(label_checkbox)
                    div_conteiner_checkbox.appendChild(div_checkbox)
                    div_contents.appendChild(div_conteiner_checkbox)
                    container.appendChild(div_contents)
                })
            }
        })
    })
</script>
@endsection