<div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar bg-dark navbar-expand-lg navbar-absolute position-sticky sticky-top">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="<?= $base ?>">Início</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <form class="navbar-form" action="perfil_pesquisa_nome.php" method="POST">
                    <div class="input-group no-border">
                        <input type="hidden" id="id_user_logado" value="<?=$userInfo->id_usuario?>">
                        <input id="room" type="hidden" value="<?= $chatRoom ?>" name="chatRoom">
                        <input name="pesquisaNome" type="text" value="" class="form-control" placeholder="Search...">
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">notifications</i>
                            <span class="notification">1</span>
                            <p class="d-lg-none d-md-block">
                                Notificações
                            </p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Aqui será implementado notificações</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">manage_accounts</i>
                            <p class="d-lg-none d-md-block">
                                Opções
                            </p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            <a class="dropdown-item" href="<?= $base ?>/views/perfil.php">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= $base ?>/logout.php">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>