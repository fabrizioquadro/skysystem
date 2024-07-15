@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Movimentação de Ferramenta</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ferramenta</h5>
                <div class="row">
                    <div class="col-md-1 form-group">
                        <label for="">ID:</label><br>
                        <b>{{ $ferramenta->id }}</b>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Marca:</label><br>
                        <b>{{ $ferramenta->marca->nm_marca }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Nome:</label><br>
                        <b>{{ $ferramenta->nm_ferramenta }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Estoque Atual:</label><br>
                        <b>{{ $ferramenta->estoque ? $ferramenta->estoque->nm_estoque : '' }}</b>
                    </div>
                    <div class="col-md-1 form-group">
                        <label for="">Valor:</label><br>
                        <b>R$ {{ valorDbForm($ferramenta->vl_ferramenta) }}</b>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Situação:</label><br>
                        <b>{{ $ferramenta->st_ferramenta }}</b>
                    </div>
                </div>
                @if($ferramenta->ds_ferramenta)
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Descrição:</label><br>
                            <b>{{ $ferramenta->ds_ferramenta }}</b>
                        </div>
                    </div>
                @endif
                @if($ferramenta->ds_motivo_baixa)
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Motivo Baixa:</label><br>
                            <b>{{ $ferramenta->ds_motivo_baixa }}</b>
                        </div>
                    </div>
                @endif
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
