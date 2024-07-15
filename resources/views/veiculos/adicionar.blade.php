@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Veículo</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('veiculos.insert') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Cliente:</label>
                    <select name="cliente_id" required class="form-control combobox">
                        <option></option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nm_cliente }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Marca:</label>
                    <select name="marca_id" required class="form-control combobox">
                        <option></option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nm_marca }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="">Modelo</label>
                    <input required type="text" name="ds_modelo" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Placa:</label>
                    <input type="text" name="nr_placa" required class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Chassi:</label>
                    <input type="text" name="nr_chassi" required class="form-control">
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
