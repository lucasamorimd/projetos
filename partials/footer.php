<div class="position-sticky fixed-bottom">
    <footer class="footer">
        <div class="container-fluid">
            <div class="col-md-8 bg-dark">
                <form id="mensagem">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="form-group">
                                    
                                    <textarea id="conteudo" class="form-control text-white" rows="1" name="body"></textarea>
                                    <label class="bmd-label-floating bd-default" for="conteudo"> Escreva aqui suas ideias</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button id="enviar" type="submit" class="btn btn-info "><i class="material-icons">send</i></button>
                        </div>
                    </div>
                    <input id="user_to_nome" type="hidden" value="<?= $chatInfo['user_to_nome'] ?>" name="user_to_nome">
                    <input id="user_to" type="hidden" value="<?= $chatInfo['user_to'] ?>" name="user_to">
                    
                </form>
            </div>
        </div>
    </footer>

</div>
</div>

</div>