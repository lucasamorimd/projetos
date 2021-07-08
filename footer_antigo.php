<footer class="footer row position-sticky fixed-bottom">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form id="mensagem">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="form-group">
                                    <label class="bmd-label-floating"> Escreva aqui suas ideias</label>
                                    <textarea id="conteudo" class="form-control" rows="1" name="body"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button id="enviar" type="submit" class="btn btn-primary "><i class="material-icons">send</i></button>
                        </div>
                    </div>
                    <input id="user_to_nome" type="hidden" value="<?= $chatInfo['user_to_nome'] ?>" name="user_to_nome">
                    <input id="user_to" type="hidden" value="<?= $chatInfo['user_to'] ?>" name="user_to">
                    <input id="room" type="hidden" value="<?= $chatRoom ?>" name="chatRoom">
                </form>
            </div>
        </div>
    </div>
</footer>