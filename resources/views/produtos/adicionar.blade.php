@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Produto</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('produtos.insert') }}" method="post">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-3 form-group">
                    <label for="">Marca:</label>
                    <select name="marca_id" required class="form-control combobox">
                        <option></option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nm_marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Nome:</label>
                    <input required type="text" name="nm_produto" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Qt Mínima:</label>
                    <input required type="number" name="qt_minima" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Unidade:</label>
                    <select name="ds_unidade" required class="form-control">
                        <option></option>
                        <option value="Unidade">Unidade</option>
                        <option value="KG">KG</option>
                        <option value="Metro">Metro</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Descrição:</label>
                    <textarea name="ds_produto" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Observação:</label>
                    <textarea name="ds_obs" class="form-control"></textarea>
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
