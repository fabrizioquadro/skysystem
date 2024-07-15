@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Oficina / Simcards</h1>
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
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="tabela-index display" id="table-index">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Operadora</th>
                                <th>Telefone</th>
                                <th>Icc</th>
                                <th>Situação</th>
                                <th>Rastreador</th>
                                <th>Veículo</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($simcards as $simcard)
                            <tr>
                                <td>{{ $simcard->id }}</td>
                                <td>{{ $simcard->operadora->nm_operadora }}</td>
                                <td>{{ $simcard->nr_tel }}</td>
                                <td>{{ $simcard->nr_icc }}</td>
                                <td>{{ $simcard->st_simcard }}</td>
                                <td>{{ $simcard->rastreador ? "Cod: ".$simcard->rastreador->cod_rastreador." Marca: ".$simcard->rastreador->marca->nm_marca." Tipo: ".$simcard->rastreador->tipo->nm_tipo_rastreador.' Modelo: '.$simcard->rastreador->modelo->nm_modelo : '' }}</td>
                                <td>{{ $simcard->rastreador && $simcard->rastreador->veiculo ? $simcard->rastreador->veiculo->cliente->nm_cliente." - ".$simcard->rastreador->veiculo->marca->nm_marca." ".$simcard->rastreador->veiculo->ds_modelo." Placa:".$simcard->rastreador->veiculo->nr_placa." Chassi:".$simcard->rastreador->veiculo->nr_chassi : '' }}</td>
                                <td>
                                    @if($simcard->st_simcard != "Baixado" && $simcard->st_simcard != 'Vinculado')
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if($simcard->st_simcard == "Bloqueado")
                                                    <a class="dropdown-item" href="{{ route('oficina.simcards.desbloquear', $simcard->id) }}"> Desbloquear </a>
                                                @endif
                                                @if($simcard->st_simcard != "Vinculado")
                                                    <a class="dropdown-item" href="{{ route('oficina.simcards.baixar', $simcard->id) }}"> Baixar </a>
                                                @endif
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
