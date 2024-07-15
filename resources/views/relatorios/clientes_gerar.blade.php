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
    <input type="hidden" name="nm_pagina" value="Relatório de Clientes">
</form>
<div id='div_dados'>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Relatórios Cliente: {{ "Data Geração: ".date('d/m/Y H:i:s') }}</h5>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th class='text-center'>Nr. Veículos</th>
                                <th class='text-center'>Nr. Instalações</th>
                                <th class='text-center'>Instalações Ativas</th>
                                <th class='text-center'>Instalações Inativas</th>
                                <th class='text-center'>Patrimônio Alocado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_valores = 0;
                            $total_veiculos = 0;
                            $total_instalacoes_totais = 0;
                            $total_instalacoes_ativas = 0;
                            $total_instalacoes_inativas = 0;
                            @endphp
                            @foreach($array_clientes as $cliente)
                                @php
                                $total_valores += $cliente['vl_ferramentas'];
                                $total_veiculos += $cliente['nr_veiculos'];
                                $total_instalacoes_totais += $cliente['nr_intalacoes_totais'];
                                $total_instalacoes_ativas += $cliente['nr_intalacoes_ativas'];
                                $total_instalacoes_inativas += $cliente['nr_intalacoes_desinstaladas'];
                                @endphp
                                <tr>
                                    <td>{{ $cliente['nm_cliente'] }}</td>
                                    <td class='text-center'>{{ $cliente['nr_veiculos'] }}</td>
                                    <td class='text-center'>{{ $cliente['nr_intalacoes_totais'] }}</td>
                                    <td class='text-center'>{{ $cliente['nr_intalacoes_ativas'] }}</td>
                                    <td class='text-center'>{{ $cliente['nr_intalacoes_desinstaladas'] }}</td>
                                    <td class='text-center'>{{ "R$ ".valorDbForm($cliente['vl_ferramentas']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td class='text-center'><b>{{ $total_veiculos }}</b></td>
                                <td class='text-center'><b>{{ $total_instalacoes_totais }}</b></td>
                                <td class='text-center'><b>{{ $total_instalacoes_ativas }}</b></td>
                                <td class='text-center'><b>{{ $total_instalacoes_inativas }}</b></td>
                                <td class='text-center'><b>{{ "R$ ".valorDbForm($total_valores) }}</b></td>
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
