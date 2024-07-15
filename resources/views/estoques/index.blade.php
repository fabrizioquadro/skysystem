@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Estoques</h1>
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
                <a href="{{ route('estoques.add') }}" class='btn btn-primary mb-3'>Adicionar</a>
                <a href="{{ route('estoques.adm') }}" class='btn btn-warning mb-3'>Estoque Adm</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="tabela-index display" id="table-index">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Local</th>
                                <th>CNPJ/CPF</th>
                                <th>Email</th>
                                <th>Tel</th>
                                <th>Cel</th>
                                <th>Estoque Adm.</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($estoques as $estoque)
                            <tr>
                                <td>{{ $estoque->nm_estoque }}</td>
                                <td>{{ $estoque->ds_local }}</td>
                                <td>{{ $estoque->nr_cnpj_cpf }}</td>
                                <td>{{ $estoque->ds_email }}</td>
                                <td>{{ $estoque->nr_tel }}</td>
                                <td>{{ $estoque->nr_cel }}</td>
                                <td>{{ $estoque->st_estoque_adm }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('estoques.editar', $estoque->id) }}"> Editar</a>
                                            <a class="dropdown-item" href="{{ route('estoques.excluir', $estoque->id) }}"> Excluir</a>
                                        </div>
                                    </div>
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
