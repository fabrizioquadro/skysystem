@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Relatórios</h1>
</div>
@if($mensagem = Session::get('mensagem'))
    <div class="alert alert-success" role="alert">
        {{ $mensagem }}
    </div>
@endif
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-md-12" align='right'>
        <button type="button" id="btn_imprimir" class="btn btn-primary btn-sm">Imprimir</button>
    </div>
</div>
<form id='formulario' action="{{ route('export.imprimir') }}" method="post" target='_blank'>
    <input type="hidden" name="dados_impimir" id='dados_imprimir'>
    <input type="hidden" name="nm_pagina" value="Relatório de Produtos">
</form>
<div id='div_dados'>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Relatórios Produto: {{ $produto->nm_produto." - ".$produto->marca->nm_marca." : Data Geração: ".date('d/m/Y H:i:s') }}</h5>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Estoques</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Estoque</th>
                                <th>Unidade</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_quantidade = 0;
                            $total_valores = 0;
                            @endphp
                            @foreach($array_estoques as $estoque)
                                @php
                                $total_valores += $estoque['vl_produto'] * $estoque['qt_produto'];
                                $total_quantidade += $estoque['qt_produto'];
                                @endphp
                                <tr>
                                    <td>{{ $estoque['nm_estoque'] }}</td>
                                    <td>{{ $estoque['ds_unidade'] }}</td>
                                    <td>{{ $estoque['qt_produto'] }}</td>
                                    <td>{{ "R$ ".valorDbForm($estoque['vl_produto']) }}</td>
                                    <td>{{ "R$ ".valorDbForm($estoque['vl_produto'] * $estoque['qt_produto']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='2' class="text-right"><b>TOTAL</b></td>
                                <td><b>{{ $total_quantidade }}</b></td>
                                <td></td>
                                <td><b>{{ "R$ ".valorDbForm($total_valores)."*" }}</b></td>
                            </tr>
                            <tr>
                                <td colspan='5'>* Valores com base na ultíma inclusão do produto no sistema.</td>
                            </tr>
                        </tfoot>
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
