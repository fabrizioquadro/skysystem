@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Relatórios</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-md-12" align='right'>
        <button type="button" id="btn_imprimir" class="btn btn-primary btn-sm">Imprimir</button>
    </div>
</div>
<form id='formulario' action="{{ route('export.imprimir') }}" method="post" target='_blank'>
    <input type="hidden" name="dados_impimir" id='dados_imprimir'>
    <input type="hidden" name="nm_pagina" value="Relatório de Simcards">
</form>
<div id='div_dados'>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Relatórios SimCards: {{ "Data Geração: ".date('d/m/Y H:i:s') }}</h5>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Simcards</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Operadora</th>
                                <th>Tel</th>
                                <th>Icc</th>
                                <th>Situação</th>
                                <th>Rastreador</th>
                                <th>Veiculo</th>
                                <th>Baixa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($simcards as $simcard)
                                <tr>
                                    <td>{{ $simcard->id }}</td>
                                    <td>{{ $simcard->operadora->nm_operadora }}</td>
                                    <td>{{ $simcard->nr_tel }}</td>
                                    <td>{{ $simcard->nr_icc }}</td>
                                    <td>{{ $simcard->st_simcard }}</td>
                                    <td>{{ $simcard->rastreador ? $simcard->rastreador->cod_rastreador." ".$simcard->rastreador->marca->nm_marca." ".$simcard->rastreador->tipo->nm_tipo_rastreador." ".$simcard->rastreador->modelo->nm_modelo : "" }}</td>
                                    <td>{{ $simcard->rastreador && $simcard->rastreador->veiculo ? $simcard->rastreador->veiculo->cliente->nm_cliente." ".$simcard->rastreador->veiculo->marca->nm_marca." ".$simcard->rastreador->veiculo->ds_modelo." ".$simcard->rastreador->veiculo->nr_placa." Chassi:".$simcard->rastreador->veiculo->nr_chassi : "" }}</td>
                                    <td>{{ $simcard->ds_motivo_baixa }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('btn_imprimir').addEventListener('click', ()=>{
    document.getElementById('dados_imprimir').value = document.getElementById('div_dados').innerHTML;
    document.getElementById('formulario').submit();
})
</script>
@endsection
