@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Produto</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('produtos.update') }}" method="post">
            @csrf
            <input type="hidden" name="produto_id" value="{{ $produto->id }}">
            <div class="row align-items-end">
                <div class="col-md-3 form-group">
                    <label for="">Marca:</label>
                    <select name="marca_id" required class="form-control combobox">
                        <option></option>
                        @foreach($marcas as $marca)
                            <option @if($marca->id == $produto->marca_id) selected @endif value="{{ $marca->id }}">{{ $marca->nm_marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Nome:</label>
                    <input required type="text" name="nm_produto" class="form-control" value="{{ $produto->nm_produto }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Qt Mínima:</label>
                    <input required type="number" name="qt_minima" class="form-control" value="{{ $produto->qt_minima }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Unidade:</label>
                    <select name="ds_unidade" required class="form-control">
                        <option></option>
                        <option @if($produto->ds_unidade == 'Unidade') selected @endif value="Unidade">Unidade</option>
                        <option @if($produto->ds_unidade == 'KG') selected @endif value="KG">KG</option>
                        <option @if($produto->ds_unidade == 'Metro') selected @endif value="Metro">Metro</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Descrição:</label>
                    <textarea name="ds_produto" class="form-control">{{ $produto->ds_produto }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Observação:</label>
                    <textarea name="ds_obs" class="form-control">{{ $produto->ds_obs }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
