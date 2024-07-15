@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Visualizar Instalação</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Dados Instalação</h5>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Cliente:</label><br>
                        <b>{{ $instalacao->cliente->nm_cliente }}</b>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Veículo:</label><br>
                        <b>{{ $instalacao->veiculo->marca->nm_marca." ".$instalacao->veiculo->ds_modelo." Placa ".$instalacao->veiculo->nr_placa." Chassi ".$instalacao->veiculo->nr_chassi }}</b>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Data Instalação:</label><br>
                        <b>{{ dataDbForm($instalacao->dt_instalacao) }}</b>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Data Desinstalação:</label><br>
                        <b>{{ $instalacao->dt_desinstalacao ? dataDbForm($instalacao->dt_desinstalacao) : "" }}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="">Rastreador:</label><br>
                        <b>{{ "Cod: ".$instalacao->rastreador->cod_rastreador.", ".$instalacao->rastreador->marca->nm_marca." ".$instalacao->rastreador->tipo->nm_tipo_rastreador." ".$instalacao->rastreador->modelo->nm_modelo }}</b>
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="">Simcard:</label><br>
                        <b>{{ "Id: ".$instalacao->simcard->id." - Operadora: ".$instalacao->simcard->operadora->nm_operadora." Tel: ".$instalacao->simcard->nr_tel." ICC: ".$instalacao->simcard->nr_icc }}</b>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Situação:</label><br>
                        <b>{{ $instalacao->st_instalacao }}</b>
                    </div>
                </div>
                @if($instalacao->ds_obs)
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Observação:</label><br>
                            <b>{{ $instalacao->ds_obs }}</b>
                        </div>
                    </div>
                @endif
                @if($instalacao->ds_obs_desinstalacao)
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Observação Desinstalação:</label><br>
                            <b>{{ $instalacao->ds_obs_desinstalacao }}</b>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Patrimônio/Ferramentas Utilizados na Instalação</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ferramentas as $ferramenta)
                            <tr>
                                <td>{{ $ferramenta->ferramenta->nm_ferramenta }}</td>
                                <td>{{ $ferramenta->estoque->nm_estoque }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Produtos Utilizados na Instalação</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Estoque</th>
                            <th>Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td>{{ $produto->produto->nm_produto }}</td>
                                <td>{{ $produto->qt_produto }}</td>
                                <td>{{ $produto->estoque->nm_estoque }}</td>
                                <td>{{ $produto->st_produto }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
