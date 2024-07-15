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
    <input type="hidden" name="nm_pagina" value="Relatório de Rastreadores">
</form>
<div id='div_dados'>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Relatórios Rastreadores: {{ "Data Geração: ".date('d/m/Y H:i:s') }}</h5>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Rastreadores</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Modelo</th>
                                <th>Situação</th>
                                <th>Simcard</th>
                                <th>Veículo</th>
                                <th>Estoque</th>
                                <th>Baixa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rastreadores as $rastreador)
                                <tr>
                                    <td>{{ $rastreador->cod_rastreador }}</td>
                                    <td>{{ $rastreador->marca->nm_marca }}</td>
                                    <td>{{ $rastreador->tipo->nm_tipo_rastreador }}</td>
                                    <td>{{ $rastreador->modelo->nm_modelo }}</td>
                                    <td>{{ $rastreador->st_rastreador }}</td>
                                    <td>{{ $rastreador->simcard ? $rastreador->simcard->id." ".$rastreador->simcard->operadora->nm_operadora." ".$rastreador->simcard->nr_tel." Icc:".$rastreador->simcard->nr_icc : "" }}</td>
                                    <td>{{ $rastreador->veiculo ? $rastreador->veiculo->cliente->nm_cliente." ".$rastreador->veiculo->marca->nm_marca." ".$rastreador->veiculo->ds_modelo." ".$rastreador->veiculo->nr_placa." Chassi: ".$rastreador->veiculo->nr_chassi : "" }}</td>
                                    <td>{{ $rastreador->estoque ? $rastreador->estoque->nm_estoque : "" }}</td>
                                    <td>{{ $rastreador->ds_motivo_baixa }}</td>
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
