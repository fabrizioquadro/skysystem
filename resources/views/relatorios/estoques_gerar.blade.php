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
    <input type="hidden" name="nm_pagina" value="Relatório de Estoques">
</form>
<div id='div_dados'>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Relatórios Estoques: {{ $estoque->nm_estoque." - Data Geração: ".date('d/m/Y H:i:s') }}</h5>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Patrimônio / Ferramentas</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Marca</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_ferramentas = 0;
                            @endphp
                            @foreach($ferramentas as $ferramenta)
                                @php
                                $total_ferramentas += $ferramenta->vl_ferramenta;
                                @endphp
                                <tr>
                                    <td>{{ $ferramenta->id }}</td>
                                    <td>{{ $ferramenta->nm_ferramenta }}</td>
                                    <td>{{ $ferramenta->marca->nm_marca }}</td>
                                    <td>{{ "R$ ".valorDbForm($ferramenta->vl_ferramenta) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='3' class="text-right"><b>TOTAL</b></td>
                                <td><b>{{ "R$ ".valorDbForm($total_ferramentas) }}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Marca</th>
                                <th>Unidade</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_produtos = 0;
                            @endphp
                            @foreach($array_produtos as $produto)
                                @php
                                $total_produtos += $produto['vl_produto'] * $produto['qt_produto'];
                                @endphp
                                <tr>
                                    <td>{{ $produto['nm_produto'] }}</td>
                                    <td>{{ $produto['nm_marca'] }}</td>
                                    <td>{{ $produto['ds_unidade'] }}</td>
                                    <td>{{ $produto['qt_produto'] }}</td>
                                    <td>{{ "R$ ".valorDbForm($produto['vl_produto']) }}</td>
                                    <td>{{ "R$ ".valorDbForm($produto['vl_produto'] * $produto['qt_produto']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='4'>* Valores com base na ultíma inclusão do produto no sistema.</td>
                                <td class="text-right"><b>TOTAL</b></td>
                                <td><b>{{ "R$ ".valorDbForm($total_produtos)."*" }}</b></td>
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
