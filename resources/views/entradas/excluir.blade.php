@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Entrada</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('entradas.delete') }}" method="post">
            @csrf
            <input type="hidden" name="entrada_id" value="{{ $entrada->id }}">
            <div class="row">
                <div class="col-md-12 form-group">
                    <p>Tem certeza que deseja excluir a entrada do fornecedor {{ $entrada->nm_fornecedor }} da data {{ dataDbForm($entrada->dt_entrada) }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="submit" value="Excluir" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
