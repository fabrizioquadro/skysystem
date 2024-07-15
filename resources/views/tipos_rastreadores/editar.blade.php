@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Tipo Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('tipos_rastreadores.update') }}" method="post">
            @csrf
            <input type="hidden" name="tipo_id" value="{{ $tipo->id }}">
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Tipo:</label>
                    <input required type="text" name="nm_tipo_rastreador" class="form-control" value="{{ $tipo->nm_tipo_rastreador }}">
                </div>
                <div class="col-md-6 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
