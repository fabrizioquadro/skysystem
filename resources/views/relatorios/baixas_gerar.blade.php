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
    <input type="hidden" name="nm_pagina" value="Relatório de Baixas">
</form>
<div id='div_dados'>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Relatórios Baixas: {{ "Data Geração: ".date('d/m/Y H:i:s') }}</h5>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Motivo</th>
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_quantidade = 0;
                            @endphp
                            @foreach($array_produtos as $linha)
                                @php
                                $total_quantidade += $linha['quantidade'];
                                @endphp
                                <tr>
                                    <td>{{ $linha['data'] }}</td>
                                    <td>{{ $linha['motivo'] }}</td>
                                    <td>{{ $linha['produto'] }}</td>
                                    <td class="text-center">{{ $linha['quantidade'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='3' class="text-right"><b>TOTAL</b></td>
                                <td class="text-center"><b>{{ $total_quantidade }}</b></td>
                                <td></td>
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
