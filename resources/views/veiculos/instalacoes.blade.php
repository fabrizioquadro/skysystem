@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Instalações Veículo</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Dados Veiculo</h5>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Cliente:</label><br>
                        <b>{{ $veiculo->cliente->nm_cliente }}</b>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Marca:</label><br>
                        <b>{{ $veiculo->marca->nm_marca }}</b>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Modelo:</label><br>
                        <b>{{ $veiculo->ds_modelo }}</b>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Placa:</label><br>
                        <b>{{ $veiculo->nr_placa }}</b>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Chassi:</label><br>
                        <b>{{ $veiculo->nr_chassi }}</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Instalações</h5>
                <table class="table">
                    <thead>
                        <thead>
                            <tr>
                                <th>Data Instalação</th>
                                <th>Data Desinstalação</th>
                                <th>Rastreador</th>
                                <th>Simcard</th>
                                <th>Situação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($veiculo->instalacoes as $instalacao)
                                <tr>
                                    <td>{{ dataDbForm($instalacao->dt_instalacao) }}</td>
                                    <td>{{ $instalacao->dt_desinstalacao ? dataDbForm($instalacao->dt_desinstalacao) : '' }}</td>
                                    <td>{{ "Cod: ".$instalacao->rastreador->cod_rastreador." Marca: ".$instalacao->rastreador->marca->nm_marca." Tipo: ".$instalacao->rastreador->tipo->nm_tipo_rastreador.' Modelo: '.$instalacao->rastreador->modelo->nm_modelo }}</td>
                                    <td>{{ "Id: ".$instalacao->simcard->id." - Operadora: ".$instalacao->simcard->operadora->nm_operadora." Tel: ".$instalacao->simcard->nr_tel." ICC: ".$instalacao->simcard->nr_icc }}</td>
                                    <td>{{ $instalacao->st_instalacao }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('oficina.instalacoes.visualizar', $instalacao->id) }}"> Visualizar </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
