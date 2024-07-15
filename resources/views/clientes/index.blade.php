@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Clientes</h1>
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
                <a href="{{ route('clientes.add') }}" class='btn btn-primary mb-3'>Adicionar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="tabela-index display" id="table-index">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CNPJ/CPF</th>
                                <th>Email</th>
                                <th>Cel/Tel</th>
                                <th>Cidade</th>
                                <th>Contato</th>
                                <th>Email</th>
                                <th>Cel/Tel</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nm_cliente }}</td>
                                <td>{{ $cliente->nr_cnpjcpf }}</td>
                                <td>{{ $cliente->ds_email }}</td>
                                <td>{{ $cliente->nr_tel." / ".$cliente->nr_cel }}</td>
                                <td>{{ $cliente->nm_cidade }}</td>
                                <td>{{ $cliente->nm_contato }}</td>
                                <td>{{ $cliente->ds_emailcontato }}</td>
                                <td>{{ $cliente->nr_telcontato." / ".$cliente->nr_celcontato }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('clientes.editar', $cliente->id) }}"> Editar</a>
                                            <a class="dropdown-item" href="{{ route('clientes.excluir', $cliente->id) }}"> Excluir</a>
                                            <a class="dropdown-item" href="{{ route('clientes.visualizar', $cliente->id) }}"> Visualizar</a>
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
