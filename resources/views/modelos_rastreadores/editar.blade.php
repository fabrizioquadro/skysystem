@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Modelo de Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('modelos_rastreadores.update') }}" method="post">
            @csrf
            <input type="hidden" name="modelo_id" value="{{ $modelo->id }}">
            <div class="row align-items-end">
                <div class="col-md-4 form-group">
                    <label for="">Marca:</label>
                    <select name="marca_id" required class="form-control combobox">
                        <option></option>
                        @foreach($marcas as $marca)
                            <option @if($marca->id == $modelo->marca_id) selected @endif value="{{ $marca->id }}">{{ $marca->nm_marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Tipo:</label>
                    <select name="tiporastreador_id" required class="form-control combobox">
                        <option></option>
                        @foreach($tipos as $tipo)
                            <option @if($tipo->id == $modelo->tiporastreador_id) selected @endif value="{{ $tipo->id }}">{{ $tipo->nm_tipo_rastreador }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Modelo:</label>
                    <input required type="text" name="nm_modelo" class="form-control" value="{{ $modelo->nm_modelo }}">
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
