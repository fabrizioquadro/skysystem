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
    <input type="hidden" name="nm_pagina" value="Relatório de Instalações">
</form>
<div id='div_dados'>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Relatórios Instalação: {{ "Data Geração: ".date('d/m/Y H:i:s') }}</h5>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Instalações</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Cliente</th>
                                <th>Veículo</th>
                                <th>Rastreador</th>
                                <th>Simcard</th>
                                <th>Situação</th>
                                <th>Data Desinstalação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($array_instalacoes as $instalacao)
                                <tr>
                                    <td>{{ dataDbForm($instalacao->dt_instalacao) }}</td>
                                    <td>{{ $instalacao->cliente->nm_cliente }}</td>
                                    <td>{{ $instalacao->veiculo->marca->nm_marca." ".$instalacao->veiculo->ds_modelo.", Placa ".$instalacao->veiculo->nr_placa." Chassi ".$instalacao->veiculo->nr_chassi }}</td>
                                    <td>{{ "Cod: ".$instalacao->rastreador->cod_rastreador." Marca: ".$instalacao->rastreador->marca->nm_marca." Tipo: ".$instalacao->rastreador->tipo->nm_tipo_rastreador.' Modelo: '.$instalacao->rastreador->modelo->nm_modelo }}</td>
                                    <td>{{ "Id: ".$instalacao->simcard->id." - Operadora: ".$instalacao->simcard->operadora->nm_operadora." Tel: ".$instalacao->simcard->nr_tel." ICC: ".$instalacao->simcard->nr_icc }}</td>
                                    <td>{{ $instalacao->st_instalacao }}</td>
                                    <td>{{ $instalacao->dt_desinstalacao ? dataDbForm($instalacao->dt_desinstalacao) : "" }}</td>
                                    <td><a href="{{ route('oficina.instalacoes.visualizar', $instalacao->id) }}" class="btn btn-warning btn-sm d-print-none" target="_blank">Detalhes</a></td>
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
