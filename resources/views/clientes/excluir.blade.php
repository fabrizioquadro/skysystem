@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Clinte</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('clientes.delete') }}" method="post">
            @csrf
            <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <p>Tem certeza que deseja excluir o cliente {{ $cliente->nm_cliente }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Excluir" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
