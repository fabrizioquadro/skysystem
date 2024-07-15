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
    <input type="hidden" name="nm_pagina" value="Relatório de Transferências">
</form>
<div id='div_dados'>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Relatórios Transferências: {{ "Data Geração: ".date('d/m/Y H:i:s') }}</h5>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Transferências</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Produto</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th class='text-center'>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($array_transferencias as $transferencia)
                                <tr>
                                    <td>{{ dataDbForm($transferencia->dt_transferencia) }}</td>
                                    <td>{{ $transferencia->produto->nm_produto." - ".$transferencia->produto->marca->nm_marca }}</td>
                                    <td>{{ $transferencia->origem->nm_estoque }}</td>
                                    <td>{{ $transferencia->destino->nm_estoque }}</td>
                                    <td class='text-center'>{{ $transferencia->qt_produto }}</td>
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
