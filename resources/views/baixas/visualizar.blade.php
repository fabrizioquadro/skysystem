@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Visualizar Baixa</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Baixa</h5>
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label for="">Data Baixa:</label><br>
                        <b>{{ dataDbForm($baixa->dt_baixa) }}</b>
                    </div>
                    <div class="col-md-10 form-group">
                        <label for="">Motivo:</label><br>
                        <b>{{ $baixa->ds_motivo }}</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Produtos</h5>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos_cad as $prod)
                            <tr>
                                <td>{{ $prod->produto->nm_produto." - ".$prod->produto->marca->nm_marca }}</td>
                                <td>{{ $prod->qt_produto }}</td>
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
