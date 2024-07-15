@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Patrimônio / Ferramentas</h1>
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
                <a href="{{ route('ferramentas.add') }}" class='btn btn-primary mb-3'>Adicionar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="tabela-index display" id="table-index">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Marca</th>
                                <th>Valor</th>
                                <th>Situação</th>
                                <th>Estoque</th>
                                <th>Motivo Baixa</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($ferramentas as $ferramenta)
                            <tr>
                                <td>{{ $ferramenta->id }}</td>
                                <td>{{ $ferramenta->nm_ferramenta }}</td>
                                <td>{{ $ferramenta->ds_ferramenta }}</td>
                                <td>{{ $ferramenta->marca->nm_marca }}</td>
                                <td>{{ "R$ ".valorDbForm($ferramenta->vl_ferramenta) }}</td>
                                <td>{{ $ferramenta->st_ferramenta }}</td>
                                <td>@if($ferramenta->estoque) {{ $ferramenta->estoque->nm_estoque }} @endif</td>
                                <td>{{ $ferramenta->ds_motivo_baixa }}</td>
                                <td>
                                    @if($ferramenta->st_ferramenta == "Habilitada")
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('ferramentas.editar', $ferramenta->id) }}"> Editar</a>
                                                <a class="dropdown-item" href="{{ route('ferramentas.excluir', $ferramenta->id) }}"> Excluir</a>
                                                <a class="dropdown-item" href="{{ route('ferramentas.alterarEstoque', $ferramenta->id) }}"> Alterar Estoque</a>
                                                <a class="dropdown-item" href="{{ route('ferramentas.enviar_manutencao', $ferramenta->id) }}"> Enviar Manutenção</a>
                                                <a class="dropdown-item" href="{{ route('ferramentas.baixar', $ferramenta->id) }}"> Baixar Ferramenta</a>
                                            </div>
                                        </div>
                                    @elseif($ferramenta->st_ferramenta == "Manutenção")
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('ferramentas.retorno_manutencao', $ferramenta->id) }}"> Retorno de Manutenção</a>
                                            <a class="dropdown-item" href="{{ route('ferramentas.alterarEstoque', $ferramenta->id) }}"> Alterar Estoque</a>
                                            <a class="dropdown-item" href="{{ route('ferramentas.baixar', $ferramenta->id) }}"> Baixar Ferramenta</a>
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
