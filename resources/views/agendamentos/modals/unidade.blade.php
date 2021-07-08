<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Unidade </h5>
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
                            <td>{{$unidade->nome_unidade}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Endereço: </th>
                            <td>{{$unidade->endereco_unidade}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Cidade: </th>
                            <td>{{$unidade->cidade_unidade}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Estado </th>
                            <td>{{$unidade->estado_unidade}}</td>
                        </tr>
                        <tr>
                            <th class="align-middle" scope="row">Telefone:</th>
                            <td>{{$unidade->telefone_unidade}} </td>
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