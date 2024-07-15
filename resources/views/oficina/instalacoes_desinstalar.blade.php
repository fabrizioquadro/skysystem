@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Desinstalar Instalação</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('oficina.instalacoes.desinstalar.set') }}" method="post">
            @csrf
            <input type="hidden" name="instalacao_id" value="{{ $instalacao->id }}">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dados Instalação</h5>
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label for="">Cliente:</label><br>
                            <b>{{ $instalacao->cliente->nm_cliente }}</b>
                        </div>
                        <div class="col-md-5 form-group">
                            <label for="">Veículo:</label><br>
                            <b>{{ $instalacao->veiculo->marca->nm_marca." ".$instalacao->veiculo->ds_modelo." Placa ".$instalacao->veiculo->nr_placa." Chassi ".$instalacao->veiculo->nr_chassi }}</b>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="">Data Instalação:</label><br>
                            <b>{{ dataDbForm($instalacao->dt_instalacao) }}</b>
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
                                    <td>
                                        <select name="st_produto{{ $produto->id }}" required class="form-control">
                                            <option value="Descartar">Descartar</option>
                                            <option value="Retorno Estoque">Retorno Estoque</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Observação Desinstalação:</label>
                            <textarea name="ds_obs_desinstalacao" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-4 form-group">
                            <label for="">Rastreador estoque retorno:</label>
                            <select name="estoque_id" required class="form-control">
                                <option></option>
                                @foreach($estoques as $estoque)
                                    <option value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Data Desinstalação:</label>
                            <input required type="date" name="dt_desinstalacao" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="submit" value="Desinstalar" class="btn btn-danger">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
