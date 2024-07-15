@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Visualizar Entrada</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Dados Entrada</h5>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Fornecedor:</label><br>
                        <b>{{ $entrada->nm_fornecedor }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Nota Fiscal:</label><br>
                        <b>{{ $entrada->nr_notafiscal }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Data Entrada:</label><br>
                        <b>{{ dataDbForm($entrada->dt_entrada) }}</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Produtos</h5>
                <table class='table mt-3'>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Estoque</th>
                        </tr>
                    </thead>
                    <tbody id='tabela_produtos'>
                        @foreach($produtos as $prod)
                            <tr>
                                <td>{{ $prod->produto->nm_produto." - ".$prod->produto->marca->nm_marca }}</td>
                                <td>{{ $prod->qt_produto }}</td>
                                <td>{{ "R$ ".$prod->vl_produto }}</td>
                                <td>{{ $prod->estoque->nm_estoque }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
