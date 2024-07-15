@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Transferências de Estoques</h1>
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
                <a href="{{ route('transferencias.add') }}" class='btn btn-primary mb-3'>Adicionar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="tabela-index display" id="table-index">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($transferencias as $transferencia)
                            <tr>
                                <td><span style='display: none'>{{ strtotime($transferencia->dt_transferencia) }}</span>{{ dataDbForm($transferencia->dt_transferencia) }}</td>
                                <td>{{ $transferencia->origem->nm_estoque }}</td>
                                <td>{{ $transferencia->destino->nm_estoque }}</td>
                                <td>{{ $transferencia->produto->nm_produto." - ".$transferencia->produto->marca->nm_marca }}</td>
                                <td>{{ $transferencia->qt_produto }}</td>
                                <td> <a href="{{ route('transferencias.excluir', $transferencia->id) }}" class="btn btn-danger btn-sm">Excluir</a> </td>
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
