<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Faça um post</h4>
        <p class="card-category">no que está pensando?</p>
    </div>
    <div class="card-body">
        <form action="post_ctrl.php" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="form-group">
                            <label class="bmd-label-floating"> Escreva aqui suas ideias</label>
                            <textarea class="form-control" rows="1" name="body"></textarea>
                        </div>
                    </div>


                </div>
                <div class="col" style="padding-top: 6.1%;">
                    <button type="submit" class="btn btn-primary btn-fab btn-fab-mini btn-round"><i class="material-icons">send</i></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>