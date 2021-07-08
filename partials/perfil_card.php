<div class="col-md-4 sticky-top  d-none d-md-block">
    <div class="card card-profile sticky-top">
        <div class="card-avatar">
            <a href="javascript:;">
                <img class="img" src="<?= $base ?>/media/avatar/<?= $userInfo->avatar ?>" />
            </a>
        </div>
        <div class="card-body">
            <h6 class="card-category text-gray">CEO / Co-Founder</h6>
            <h4 class="card-title"><?= $nome_usuario[0]; ?></h4>
            <p class="card-description">
                <?=$userInfo->descricao?>
            </p>
            <a href="#" class="btn btn-primary btn-round disabled"></a>
        </div>
    </div>
</div>