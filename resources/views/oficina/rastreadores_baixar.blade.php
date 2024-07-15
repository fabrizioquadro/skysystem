@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Baixar Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('oficina.rastreadores.baixar.set') }}" method="post">
            @csrf
            <input type="hidden" name="rastreador_id" value="{{ $rastreador->id }}">
            <div class="row align-items-end">
                <div class="col-md-12 form-group">
                    <p>Você tem certeza que deseja 'Baixar' o rastreador {{ $rastreador->marca->nm_marca." - Tipo: ".$rastreador->tipo->nm_tipo_rastreador.", Modelo: ".$rastreador->modelo->nm_modelo." Cod: ".$rastreador->cod_rastreador }} ?</p>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-md-12 form-group">
                    <label for="">Motivo:</label>
                    <input type="text" name="ds_motivo_baixa" required class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Baixar" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
