<?php
$titulo = "Chat";
include('header.php');
?>
<style>
    #fixado {
        position: fixed;
    }

    .quebra {
        word-wrap: break-word;
    }
</style>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper indigo darken-3">
            <div class="row">
                <form class="col s10" id="formMensagem">
                    <div class="input-field">
                        <input class="materialize-textarea" placeholder="Digite sua mensagem" id="mensagem" type="search">
                        <label class="label-icon" for="mensagem"><i class="material-icons">send</i></label>

                    </div>

                    <input id="nomeUser" type="hidden" value="<?= $_SESSION['UserName'] ?>">
                </form>
                <div class="col s1">
                    <a class="btn-large waves-effect waves-light hide-on-small-only" id="butao">
                        Enviar
                    </a>
                    <a href="#" data-target="slide-out" class="sidenav-trigger hide-on-large-only"><i class="material-icons">menu</i></a>
                </div>

                <div class="col s1">
                    <a class="btn-large waves0efect waves-light hide-on-small-only" href="../controllers/login.php?logout=true">Logout</a>
                </div>
            </div>
            <ul id="nav-mobile" class="right hide-on-med-and-up">
                <li><a href="sass.html">Sass</a></li>
                <li><a href="badges.html">Components</a></li>
                <li><a href="collapsible.html">JavaScript</a></li>
            </ul>
        </div>
    </nav>
</div>
<ul id="slide-out" class="sidenav">
    <li class="center">
        <div class="col s1">
            <a class="btn-large waves0efect waves-light" href="../controllers/login.php?logout=true">Logout</a>
        </div>
    </li>
</ul>

<header id="headDig">
    <h1 class="center-align"><?= $_SESSION['UserName'] ?>

</header>

<div class="container" id="containerChat">
    <div class="row" id="CardMensagem">

    </div>
    <div div id="digitando" style="display: none;" class="row">
        <div id="camada1" class="col s12 m6 offset-m6">
            <div id="camada2" class="card blue-grey darken-1">
                <div id="camada3" class="card-content white-text">
                    <p id="camada4">Digitando...</p>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    <?php if (isset($toast)) {
        echo $toast;
        $_SESSION['aviso'] = null;
    }
    ?>
</script>
<script src="../socket/socket.js"></script>
</body>

</html>