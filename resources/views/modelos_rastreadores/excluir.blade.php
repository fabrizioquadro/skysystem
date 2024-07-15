@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Modelo de Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('modelos_rastreadores.delete') }}" method="post">
            @csrf
            <input type="hidden" name="modelo_id" value="{{ $modelo->id }}">
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <p>Tem certeza que deseja excluir o modelo {{ $modelo->nm_modelo }} da marca {{ $modelo->marca->nm_marca }}?</p>
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
