@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Configurar Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('oficina.rastreadores.configurar.set') }}" method="post">
            @csrf
            <input type="hidden" name="rastreador_id" value="{{ $rastreador->id }}">
            <div class="row align-items-end">
                <div class="col-md-12 form-group">
                    <p>Você tem certeza que deseja setar como 'Configurado' o rastreador {{ $rastreador->marca->nm_marca." - Tipo: ".$rastreador->tipo->nm_tipo_rastreador.", Modelo: ".$rastreador->modelo->nm_modelo." Id: ".$rastreador->cod_rastreador }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Configurar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
