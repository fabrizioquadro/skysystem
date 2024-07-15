@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Rastreadores</h1>
</div>
@if($mensagem = Session::get('mensagem'))
    <div class="alert alert-success" role="alert">
        {{ $mensagem }}
    </div>
@endif
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12" align='right'>
                <a href="{{ route('rastreadores.add') }}" class='btn btn-primary mb-3'>Adicionar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="tabela-index display" id="table-index">
                        <thead>
                            <tr>
                                <th>Cod</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Modelo</th>
                                <th>Situação</th>
                                <th>Estoque</th>
                                <th>SimCard</th>
                                <th>Veículo</th>
                                <th>Motivo Baixa</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($rastreadores as $rastreador)
                            <tr>
                                <td>{{ $rastreador->cod_rastreador }}</td>
                                <td>{{ $rastreador->marca->nm_marca }}</td>
                                <td>{{ $rastreador->tipo->nm_tipo_rastreador }}</td>
                                <td>{{ $rastreador->modelo->nm_modelo }}</td>
                                <td>{{ $rastreador->st_rastreador }}</td>
                                <td>{{ $rastreador->estoque ? $rastreador->estoque->nm_estoque : "" }}</td>
                                <td>{{ $rastreador->simcard != null ? "Id: ".$rastreador->simcard->id." - Operadora: ".$rastreador->simcard->operadora->nm_operadora." Tel: ".$rastreador->simcard->nr_tel." ICC: ".$rastreador->simcard->nr_icc : '' }}</td>
                                <td>{{ $rastreador->veiculo ? $rastreador->veiculo->cliente->nm_cliente." - ".$rastreador->veiculo->marca->nm_marca." ".$rastreador->veiculo->ds_modelo.", Placa:".$rastreador->veiculo->nr_placa." Chassi:".$rastreador->veiculo->nr_chassi : '' }}</td>
                                <td>{{ $rastreador->ds_motivo_baixa }}</td>
                                <td>
                                    @if($rastreador->st_rastreador != "Baixado")
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('rastreadores.editar', $rastreador->id) }}"> Editar</a>
                                                <a class="dropdown-item" href="{{ route('rastreadores.excluir', $rastreador->id) }}"> Excluir</a>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    order: [[0, 'asc']],
    "language": {
			"sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });
})

</script>

@endsection
