@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Movimentação de Rastreadores</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rastreador</h5>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="">Cod:</label><br>
                        <b>{{ $rastreador->cod_rastreador }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Marca:</label><br>
                        <b>{{ $rastreador->marca->nm_marca }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tipo:</label><br>
                        <b>{{ $rastreador->tipo->nm_tipo_rastreador }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Modelo:</label><br>
                        <b>{{ $rastreador->modelo->nm_modelo }}</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Movimentações</h5>
                @foreach($movs as $mov)
                    @php
                    $var = explode(' ', $mov->dt_mov);
                    @endphp
                    <div class="card mt-3">
                        <div class="card-header">
                            {{ 'Data: '.dataDbForm($var[0])." ".$var[1]." - Usuário: ".$mov->nome }}
                        </div>
                        <div class="card-body">
                            {!! $mov->ds_movimentacao !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
