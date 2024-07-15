@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Marca</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('marcas.insert') }}" method="post">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Nome:</label>
                    <input required type="text" name="nm_marca" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Tipo:</label>
                    <select name="tp_marca" class="form-control">
                        <option></option>
                        <option value="Produto/Ferramentas">Produto/Ferramentas</option>
                        <option value="Veículo">Veículo</option>
                        <option value="Rastreador">Rastreador</option>
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
