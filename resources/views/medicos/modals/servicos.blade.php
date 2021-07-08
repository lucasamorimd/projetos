<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Serviços </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
</div>
<div class="modal-body">
    <div class="row">
        @foreach($servicos as $servico)
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-medkit"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><a href="#">{{$servico->nome_servico}}</a></span>
                    <span class="info-box-number">{{ucfirst($servico->tipo_servico)}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>