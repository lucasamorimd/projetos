<?php
$titulo = "Cadastre-se";
include('header.php');
?>
<header>
    <h1 class="center-align">
        Cadastrar
    </h1>
</header>
<div class="row">
    <div class="col s12 m4 offset-m4">
        <div class="card">
            <div class="card-action indigo darken-3 white-text">
                <h3 class="center-align">Preencha os campos</h3>
            </div>
            <div class="card-content">

                <form action="../controllers/ctrl_cadastro.php" method="POST">
                    <div class="form-field">
                        <label for="nomeUsuario">Usuario</label>
                        <input type="text" name="nome" id="nomeUsuario">
                    </div><br />
                    <div class="form-field">
                        <label for="emailUsuario">Email</label>
                        <input type="email" name="email" id="emailUsuario">
                    </div><br />
                    <div class="form-field">
                        <label for="senhaUsuario">Senha</label>
                        <input type="password" name="senha" id="senhaUsuario">
                    </div><br />
                    <div class="form-field">
                        <button class="btn-large indigo darken-3 waves-effect waves-dark" style="width: 100%;">Cadastrar</button>
                    </div><br />
                </form>
            </div>
        </div>
    </div>
</div>