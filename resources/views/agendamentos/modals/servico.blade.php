<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Serviços </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
</div>
<div class="modal-body">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <tr>
                            <th scope="row">Nome: </th>
                            <td>{{$servico->nome_servico}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Serviço: </th>
                            <td>{{ucfirst($servico->tipo_servico)}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Duração: </th>
                            <td>{{$servico->tempo_estimado}} horas</td>
                        </tr>
                        <tr>
                            <th scope="row">Preço: </th>
                            <td>R$ {{number_format($servico->preco_servico, 2, ',', ' ')}}</td>
                        </tr>
                        <tr>
                            <th class="align-middle" scope="row">Descrição:</th>
                            <td>{{$servico->descricao_servico}} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>