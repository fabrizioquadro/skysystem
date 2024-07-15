@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Estoque</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('estoques.delete') }}" method="post">
            @csrf
            <input type="hidden" name="estoque_id" value="{{ $estoque->id }}">
            <div class="row">
                <div class="col-md-6 form-group">
                    <p>Tem certeza que deseja excluir o estoque {{ $estoque->nm_estoque }}</p>
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
