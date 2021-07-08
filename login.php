<?php
$titulo = "Login";
require 'config.php';
if (isset($_SESSION['aviso'])) {
    $toast = " M.toast({html: '" . $_SESSION['aviso'] . "'});";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= $base ?>/assets/css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?php echo $titulo ?></title>
</head>

<body>
    <script src="<?= $base ?>/assets/js/materialize.min.js"></script>
    <script src="<?= $base ?>/assets/js/jquery.js"></script>
    <script src="<?= $base ?>/assets/js/fun.js"></script>
    <div class="row">
        <div class="col s12 m4 offset-m4">
            <div class="card">
                <div class="card-action indigo darken-3 white-text">
                    <h3 class="center-align">Social Post</h3>
                </div>
                <div class="card-content">

                    <form action="<?= $base ?>/login_ctrl.php" method="POST">
                        <div class="form-field">
                            <label for="emailUsuario">Email</label>
                            <input type="email" name="email" id="emailUsuaio">
                        </div><br />
                        <div class="form-field">
                            <label for="senhaUsuario">Senha</label>
                            <input type="password" name="senha" id="senhaUsuario">
                        </div><br />
                        <div class="form-field">
                            <button class="btn-large indigo darken-3 waves-effect waves-dark" style="width: 100%;">Logar</button>
                        </div><br />
                    </form>
                    <p class="center-align"><a href="<?= $base ?>/cadastrar.php">Cadastre-se</a></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        <?php echo $toast;
        $_SESSION['aviso'] = null;
        ?>
    </script>
</body>

</html>