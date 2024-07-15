@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Usuários</h1>
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
                <a href="{{ route('usuarios.add') }}" class='btn btn-primary mb-3'>Adicionar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="tabela-index display" id="table-index">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($usuarios as $usuario)
                            @php
                            if($usuario->imagem == ""){
                                $avatar = '/public/img/avatar.png';
                            }
                            else{
                                $avatar = '/public/img/usuarios/'.$usuario->imagem."?".date('Ymdhis');
                            }
                            @endphp
                            <tr>
                                <td> <img src="{{ $avatar }}" style='height:40px; border-radius: 20px' alt=""> </td>
                                <td>{{ $usuario->nome }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->tipo }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('usuarios.editar', $usuario->id) }}"> Editar</a>
                                            <a class="dropdown-item" href="{{ route('usuarios.excluir', $usuario->id) }}"> Excluir</a>
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
    order: [[1, 'asc']],
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
