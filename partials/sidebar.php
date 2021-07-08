<div class="sidebar" data-color="<?=$userConfigs->seletor?>" data-background-color="<?=$userConfigs->navbar?>" data-image="<?=$base?>/assets/img/sidebar-1.jpg">
    <!--Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag-->
    <div class="logo"><a href="<?=$base?>/index.php" class="simple-text logo-normal">
            <?=$nome_usuario[0];?>
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item <?= $activeMenu == 'home' ? 'active' : ''; ?>  ">
                <a class="nav-link" href="<?=$base?>/index.php">
                    <i class="material-icons">first_page</i>
                    <p>Inicial</p>
                </a>
            </li>
            <li class="nav-item <?= $activeMenu == 'perfil' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?=$base?>/perfil.php">
                    <i class="material-icons">person</i>
                    <p>Perfil</p>
                </a>
            </li>
            <li class="nav-item <?= $activeMenu == 'mensagens' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?=$base?>/mensagens.php">
                    <i class="material-icons">content_paste</i>
                    <p>Mensagens</p>
                </a>
            </li>
            <li class="nav-item <?= $activeMenu == 'seguindo' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?=$base?>/following.php">
                    <i class="material-icons">people_alt</i>
                    <p id="countFollowings">Seguindo <?=count($countFollowing)?></p>
                </a>
            </li>
            <li class="nav-item <?= $activeMenu == 'seguidores' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?=$base?>/followed.php">
                    <i class="material-icons">supervisor_account</i>
                    <p>Seguidores <?=count($countFollowed)?></p>
                </a>
            </li>
        </ul>
    </div>
</div>