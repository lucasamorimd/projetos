@extends('adminlte::page')
@section('title')
{{$agendamento->nome_paciente}}
@endsection
@section('content_header')
<h1>
    Atender {{$agendamento->nome_paciente}}
</h1>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="text-center">Formulário de Atendimento</h2>
    </div>
    <div class="card-body">
        <div class="row  justify-content-center">
            <div class="col">
                <form enctype="multipart/form-data" id="atender_pendente" action="{{route('salvarAtendimento')}}" method="POST">
                    @csrf
                    <h4 class="text-center"> informações do paciente</h4>
                    <hr />
                    <div class="form-group row">
                        <label for="nome_paciente" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input readonly name="nome_paciente" id="nome_paciente" type="text" class="form-control " value="{{$agendamento->nome_paciente}}">
                            @error('nome_paciente')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input readonly name="email" id="email" type="text" class="form-control " value="{{$agendamento->email_paciente}}">
                            @error('email')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                        <div class="col-sm-10">
                            <input readonly name="telefone" id="telefone" type="text" class="form-control " value="{{$agendamento->telefone_paciente}}">
                            @error('telefone')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <hr />
                    <h4 class="text-center">Informações do Atendimento</h4>
                    <hr />
                    <div class="form-group row">
                        <label for="data_atendimento" class="col-sm-3 col-form-label">Data do Atendimento</label>
                        <div class="col-sm-9">
                            <input readonly name="data_atendimento" id="data_atendimento" type="text" class="form-control " value="{{date('d/m/Y',strtotime($agendamento->data_atendimento))}}">

                            @error('data_atendimento')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hora_atendimento" class="col-sm-3 col-form-label">Horário do Atendimento</label>
                        <div class="col-sm-9">
                            <input readonly name="hora_atendimento" id="hora_atendimento" type="text" class="align-center form-control " value="{{date('H:i',strtotime($agendamento->hora_atendimento))}}">

                            @error('hora_atendimento')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="data_abertura" class="col-sm-3 col-form-label">Data do Agendamento</label>
                        <div class="col-sm-9">
                            <input readonly name="data_abertura" id="data_abertura" type="text" class="form-control " value="{{date('d/m/Y H:i',strtotime($agendamento->data_abertura))}}">

                            @error('data_abertura')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <hr />
                    <h4 class="text-center">Informações do Servço</h4>
                    <hr />
                    <div class="form-group row">
                        <label for="nome_servico" class="col-sm-2 col-form-label">Serviço</label>
                        <div class="col-sm-10">
                            <input readonly name="nome_servico" id="nome_servico" type="text" class="form-control " value="{{$servico->nome_servico}}">
                            @error('nome_servico')
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
                            <input readonly name="tempo_estimado" id="tempo_estimado" type="number" class="form-control " value="{{$servico->tempo_estimado}}">

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
                            <input readonly name="preco" id="preco" type="number" class="form-control " value="{{$servico->preco_servico}}">
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
                            <textarea readonly name="descricao" id="descricao" type="text" class="form-control " value="{{$servico->descricao_servico}}">{{$servico->descricao_servico}}</textarea>
                            @error('descricao')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            Unidade
                            <div class="custom-control custom-checkbox">
                                <input onclick="return false" checked name="unidade" class="custom-control-input" type="checkbox" value="{{$unidade->id_unidade}}" id="unidade{{$unidade->id_unidade}}">
                                <label class="custom-control-label" for="unidade{{$unidade->id_unidade}}">
                                    {{$unidade->nome_unidade}}
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            Médico

                            <div class="custom-control custom-checkbox">
                                <input onclick="return false" checked name="medico" class="custom-control-input" type="checkbox" value="{{$medico->id_medico}}" id="medico{{$medico->id_medico}}">
                                <label class="custom-control-label" for="medico{{$medico->id_medico}}">
                                    {{$medico->nome_medico}}
                                </label>
                            </div>

                            @error('unidades[]')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <hr />
                    <h4 class="text-center">Informações do Prontuário</h4>
                    <hr />
                    <div class="form-group row">
                        <label for="customFile" class="col-sm-2 col-form-label">Resultado</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input name="arquivo_prontuario" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Selecionar Arquivo (apenas PDF)</label>
                            </div>
                            @error('arquivo_prontuario')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="resumo" class="col-sm-2 col-form-label">Resumo</label>
                        <div class="col-sm-10">
                            <textarea name="resumo" id="resumo" type="text" class="form-control " placeholder="Coloque aqui um resumo do prontuário"></textarea>
                            @error('resumo')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="id_agendamento" value="{{$agendamento->id_agendamento}}">
                </form>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            <button class="btn btn-primary" type="submit" onclick="atender_pendente()">Salvar</button>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    function atender_pendente() {
        var form = document.getElementById('atender_pendente')
        form.submit()
    }
</script>
@endsection