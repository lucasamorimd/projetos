<?php
require dirname(__DIR__) . '/autoload.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$nome = filter_input(INPUT_POST, 'nome');
$senha = filter_input(INPUT_POST, 'senha');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$apelido = filter_input(INPUT_POST, 'apelido');
$descricao = filter_input(INPUT_POST, 'descricao');
$corNavBg = filter_input(INPUT_POST, 'navbarCor');
$corSeletor = filter_input(INPUT_POST, 'seletorCor');

$avatar = $_FILES['avatar'];



if ($senha && $nome && $email) {

    if ($avatar['name']) {
        $upload_avatar = new upload();
        $upload_avatar->width = 400;
        $upload_avatar->height = 400;
        $resultado = $upload_avatar->salvar(dirname(__DIR__) . '/media/avatar/', $avatar, $userInfo->id_usuario);
        $nome_avatar = $resultado['nome'];
    } else {
        $nome_avatar = $userInfo->avatar;
    }
    $auth->updateUser($userInfo->id_usuario, $nome, $email, $senha, $apelido, $descricao, $nome_avatar);
    $auth->updateUserConfigs($userInfo->id_usuario, $corNavBg, $corSeletor);
    $_SESSION['aviso'] = "Alteração Feita";
    $_SESSION['cor'] = 3;
} else {
    $_SESSION['aviso'] = "Você não deixou o Nome, Senha ou Email Vazio";
    $_SESSION['cor'] = 2;
}

header("Location:" . $base . "/views/perfil.php");
exit;
