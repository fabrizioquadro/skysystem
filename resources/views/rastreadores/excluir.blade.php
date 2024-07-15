@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('rastreadores.delete') }}" method="post">
            @csrf
            <input type="hidden" name="rastreador_id" value="{{ $rastreador->id }}">
            <div class="row align-items-end">
                <div class="col-md-12 form-group">
                    <p>Tem certeza que deseja excluir o rastreador {{ $rastreador->marca->nm_marca." / ".$rastreador->tipo->nm_tipo_rastreador." - ".$rastreador->modelo->nm_modelo }} de codigo {{ $rastreador->cod_rastreador }}?</p>
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
