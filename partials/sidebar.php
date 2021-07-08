<div class="sidebar" data-color="<?= $userConfigs->seletor ?>" data-background-color="<?= $userConfigs->navbar ?>" data-image="<?= $base ?>/assets/img/sidebar-2.jpg">
    <!--Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag-->
    <div class="logo"><a href="<?= $base ?>/index.php" class="simple-text logo-normal">
            <?= $nome_usuario[0]; ?>
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li id="home" class="nav-item <?= $activeMenu == 'home' ? 'active' : ''; ?>  " onclick=" menu_animation({url:'<?= $base ?>/index.php',active:'home'})">
                <a class="nav-link" href="#">
                    <i class="material-icons">first_page</i>
                    <p>Inicial</p>
                </a>
            </li>
            <li id="perfil" class="nav-item <?= $activeMenu == 'perfil' ? 'active' : ''; ?>" onclick=" menu_animation({url:'<?= $base ?>/views/perfil.php',active:'perfil'})">
                <a class="nav-link" href="#">
                    <i class="material-icons">person</i>
                    <p>Perfil</p>
                </a>
            </li>
            <li id="mensagens" class="nav-item <?= $activeMenu == 'mensagens' ? 'active' : ''; ?>" onclick=" menu_animation({url:'<?= $base ?>/views/mensagens.php',active:'mensagens'})">
                <a class="nav-link" href="#">
                    <i class="material-icons">content_paste</i>
                    <p>Mensagens</p>
                </a>
            </li>
            <li id="seguindo" class="nav-item <?= $activeMenu == 'seguindo' ? 'active' : ''; ?>" onclick=" menu_animation({url:'<?= $base ?>/views/following.php',active:'seguindo'})">
                <a class="nav-link" href="#">
                    <i class="material-icons">people_alt</i>
                    <p id="countFollowings">Seguindo <?= count($countFollowing) ?></p>
                </a>
            </li>
            <li id="seguidores" class="nav-item <?= $activeMenu == 'seguidores' ? 'active' : ''; ?>" onclick=" menu_animation({url:'<?= $base ?>/views/followed.php',active:'seguidores'})">
                <a class="nav-link" href="#">
                    <i class="material-icons">supervisor_account</i>
                    <p>Seguidores <?= count($countFollowed) ?></p>
                </a>
            </li>
        </ul>
    </div>
</div>