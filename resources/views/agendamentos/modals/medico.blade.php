<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{$medico->nome_medico}} </h5>
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
                            <td>{{$medico->nome_medico}}</td>
                        </tr>
                        <tr>
                            <th scope="row">CRM: </th>
                            <td>{{$medico->crm}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Área de Atuação: </th>
                            <td>{{$medico->area_atuacao}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Data de Cadastro: </th>
                            <td>{{date('d/m/Y',strtotime($medico->data_cadastro))}}</td>
                        </tr>
                        <tr>
                            <th class="align-middle" scope="row">Unidade:</th>
                            <td>{{$unidade->nome_unidade}} </td>
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