@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Marca</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('marcas.update') }}" method="post">
            @csrf
            <input type="hidden" name="marca_id" value="{{ $marca->id }}">
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Nome:</label>
                    <input required type="text" name="nm_marca" class="form-control" value="{{ $marca->nm_marca }}">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Tipo:</label>
                    <select name="tp_marca" class="form-control">
                        <option></option>
                        <option @if($marca->tp_marca == 'Produto/Ferramentas') selected @endif value="Produto/Ferramentas">Produto/Ferramentas</option>
                        <option @if($marca->tp_marca == 'Veículo') selected @endif value="Veículo">Veículo</option>
                        <option @if($marca->tp_marca == 'Rastreador') selected @endif value="Rastreador">Rastreador</option>
                    </select>
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
