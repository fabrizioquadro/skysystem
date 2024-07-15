@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Produto</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('produtos.delete') }}" method="post">
            @csrf
            <input type="hidden" name="produto_id" value="{{ $produto->id }}">
            <div class="row">
                <div class="col-md-12 form-group">
                    <p>Tem certeza que deseja excluir o produto {{ $produto->nm_produto }}</p>
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
