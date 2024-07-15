@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Modelo de Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('modelos_rastreadores.insert') }}" method="post">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-4 form-group">
                    <label for="">Marca:</label>
                    <select name="marca_id" required class="form-control combobox">
                        <option></option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nm_marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Tipo:</label>
                    <select name="tiporastreador_id" required class="form-control combobox">
                        <option></option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nm_tipo_rastreador }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Modelo:</label>
                    <input required type="text" name="nm_modelo" class="form-control">
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
