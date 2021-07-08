@extends('adminlte::page')
@section('title','Novo Funcionário')
@section('content_header')
<h1>Novo Funcionário</h1>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="text-center">Formulário de Cadastro de Funcionário</h4>
    </div>
    <div class="card-body">
        <div class="row  justify-content-center">
            <div class="col">
                <form id="cadastrar_func" action="{{route('salvarFuncionario')}}" method="POST">
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
                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-10">
                            <input name="email" id="email" type="text" class="form-control " placeholder="exemplo@email.com">

                            @error('email')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="senha" class="col-sm-2 col-form-label">Senha</label>
                        <div class="col-sm-10">
                            <input name="senha" id="senha" type="password" class="form-control ">
                            @error('senha')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirmacao_senha" class="col-sm-2 col-form-label">Confirme a Senha</label>
                        <div class="col-sm-10">
                            <input name="senha_confirmation" id="confirmacao_senha" type="password" class="form-control ">
                            @error('senha')
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
                        <label for="perfil" class="col-sm-2 col-form-label">Perfil de Usuário</label>
                        <div class="col-sm-10">
                            <select name="perfil" id="perfil" class="custom-select ">
                                <option value="">Selecione o nível de autorização do perfil</option>

                                <option value="administrador">Administrador</option>
                                <option value="funcionario">Funcionário</option>

                            </select>
                            @error('unidade')
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
            <button class="btn btn-primary" type="submit" onclick="cadastrar_func()">Salvar</button>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    function cadastrar_func() {
        var form = document.getElementById('cadastrar_func')
        form.submit()
    }
</script>
@endsection