<?php
$titulo = "Login";
require('header.php');

?>
<div class="row">
    <div class="col s12 m4 offset-m4">
        <div class="card">
            <div class="card-action indigo darken-3 white-text">
                <h3 class="center-align">Login</h3>
            </div>
            <div class="card-content">

                <form action="../controllers/login.php" method="POST">
                    <div class="form-field">
                        <label for="nomeUsuario">Usuario</label>
                        <input type="text" name="nome" id="nomeUsuario">
                    </div><br />
                    <div class="form-field">
                        <label for="senhaUsuario">Senha</label>
                        <input type="password" name="senha" id="senhaUsuario">
                    </div><br />
                    <div class="form-field">
                        <button class="btn-large indigo darken-3 waves-effect waves-dark" style="width: 100%;">Logar</button>
                    </div><br />
                </form>
                <p class="center-align"><a href="cadastrar.php">Cadastre-se</a></p>
            </div>
        </div>
    </div>
</div>
<script>
<?php echo $toast;
$_SESSION['aviso'] = null;
?>
</script>