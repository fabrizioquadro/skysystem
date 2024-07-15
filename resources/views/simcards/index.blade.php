@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">SimCards</h1>
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
                <a href="{{ route('simcards.add') }}" class='btn btn-primary mb-3'>Adicionar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="tabela-index display" id="table-index">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Operadora</th>
                                <th>Telefone</th>
                                <th>ICC</th>
                                <th>Situação</th>
                                <th>Ratreador</th>
                                <th>Veículo</th>
                                <th>Motivo Baixa</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($sims as $sim)
                            <tr>
                                <td>{{ $sim->id }}</td>
                                <td>{{ $sim->operadora->nm_operadora }}</td>
                                <td>{{ $sim->nr_tel }}</td>
                                <td>{{ $sim->nr_icc }}</td>
                                <td>{{ $sim->st_simcard }}</td>
                                <td>{{ $sim->rastreador ? "Cod: ".$sim->rastreador->cod_rastreador." Marca: ".$sim->rastreador->marca->nm_marca." Tipo: ".$sim->rastreador->tipo->nm_tipo_rastreador.' Modelo: '.$sim->rastreador->modelo->nm_modelo : '' }}</td>
                                <td>{{ $sim->rastreador && $sim->rastreador->veiculo ? $sim->rastreador->veiculo->cliente->nm_cliente." - ".$sim->rastreador->veiculo->marca->nm_marca." ".$sim->rastreador->veiculo->ds_modelo." Placa:".$sim->rastreador->veiculo->nr_placa." Chassi:".$sim->rastreador->veiculo->nr_chassi : '' }}</td>
                                <td>{{ $sim->ds_motivo_baixa }}</td>
                                <td>
                                    @if($sim->st_simcard != 'Baixado')
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('simcards.editar', $sim->id) }}"> Editar</a>
                                                <a class="dropdown-item" href="{{ route('simcards.excluir', $sim->id) }}"> Excluir</a>
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
