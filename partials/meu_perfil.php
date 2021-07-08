<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Editar Perfil</h4>
                <p class="card-category">Complete suas informações</p>
            </div>
            <div class="card-body">
                <form action="<?=$base?>/controlls/perfil_ctrl.php" enctype="multipart/form-data" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="" for="nomeUser">Nome Completo</label>
                                <input id="nomeUser" type="text" class="form-control" value="<?= $userInfo->nome ?>" name="nome">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="bmd-label-floating">Senha</label>
                                <input class="form-control" type="password" name="senha">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">Email</label>
                                <input type="email" class="form-control" value="<?= $userInfo->email ?>" name="email">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="">Apelido</label>
                                <input type="text" class="form-control" value="<?= $userInfo->apelido ?>" name="apelido">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label>
                                <div class="form-group">
                                    <label class="bmd-label-floating"> Diga um pouco sobre você!</label>
                                    <textarea class="form-control" rows="5" name="descricao"><?= $userInfo->descricao; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-center">Cor da Navbar</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body text-center">
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="navbarCor" id="inlineRadio1" value="black" checked=""> Preto
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="navbarCor" id="inlineRadio2" value="white"> Branco
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title text-center">Cor do Seletor de Janelas</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body text-center">
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="seletorCor" id="inlineRadio3" value="purple" checked=""> Roxo
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="seletorCor" id="inlineRadio4" value="azure"> Azul
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="seletorCor" id="inlineRadio5" value="green"> Verde
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="seletorCor" id="inlineRadio6" value="orange"> Laranja
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="seletorCor" id="inlineRadio7" value="danger"> Vermelho
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                            <div class="card-header card-header-primary">
                                    <h4 class="card-title text-center">Alterar Foto de Perfil</h4>
                                    <p class="card-category"></p>
                                </div>
                                <img class="card-img-top" src="<?= $base ?>/media/avatar/<?= $userInfo->avatar ?>" rel="nofollow" alt="<?=$base?>/media/avatar/marc.jpg">
                                <div class="card-body">
                                    <p class="card-text align-center">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">                                       
                                        <div>
                                            <span class="btn btn-raised btn-round btn-default btn-file">
                                                <span class="fileinput-new"></span>
                                                <input type="file" name="avatar" />   
                                            </span>
                                        </div>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remover o arquivo de Upload" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">Remove </a>
                                        </p>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Atualizar Perfil</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>



        </div>

        <?php foreach ($postsPerfil as $item) : ?>
            <?php require dirname(__DIR__) . '/partials/posts.php'; ?>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="javascript:;">
                    <img class="img" src="<?= $base ?>/media/avatar/<?= $userInfo->avatar ?>" />
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-category text-gray">CEO / Co-Founder</h6>
                <h4 class="card-title"><?= $nome_usuario[0]; ?></h4>
                <p class="card-description">
                    <?= $userInfo->descricao ?>
                </p>
                <a href="javascript:;" class="btn btn-primary btn-round disabled"></a>
            </div>
        </div>
    </div>
</div>