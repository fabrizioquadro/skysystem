@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Movimentação de SimCards</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Simcard</h5>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="">ID:</label><br>
                        <b>{{ $simcard->id }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Operadora:</label><br>
                        <b>{{ $simcard->operadora->nm_operadora }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Tel:</label><br>
                        <b>{{ $simcard->nr_tel }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">ICC:</label><br>
                        <b>{{ $simcard->nr_icc }}</b>
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
