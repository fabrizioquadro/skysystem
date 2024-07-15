@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Relatórios - Instalações</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('relatorios.instalacoes.gerar') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Data de Instalação</h6>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Início:</label>
                                    <input type="date" name="dt_inc_instalacao" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Final:</label>
                                    <input type="date" name="dt_fn_instalacao" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Data de Desinstalação</h6>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Início:</label>
                                    <input type="date" name="dt_inc_desinstalacao" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Final:</label>
                                    <input type="date" name="dt_fn_desinstalacao" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3 form-group">
                    <label for="">Clientes:</label>
                    <select name="cliente_id" class="form-control combobox">
                        <option></option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nm_cliente." CNPJ/CPF ".$cliente->nr_cnpj_cpf }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Veículo:</label>
                    <select name="veiculo_id" class="form-control combobox">
                        <option></option>
                        @foreach($veiculos as $veiculo)
                            <option value="{{ $veiculo->id }}">{{ $veiculo->cliente->nm_cliente." - ".$veiculo->marca->nm_marca." ".$veiculo->ds_modelo." ".$veiculo->nr_placa." Chassi:".$veiculo->nr_chassi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Rastreador:</label>
                    <select name="rastreador_id" class="form-control combobox">
                        <option></option>
                        @foreach($rastreadores as $rastreador)
                            <option value="{{ $rastreador->id }}">{{ $rastreador->cod_rastreador." ".$rastreador->marca->nm_marca." ".$rastreador->tipo->nm_tipo_rastreador." ".$rastreador->modelo->nm_modelo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Simcard:</label>
                    <select name="simcard_id" class="form-control combobox">
                        <option></option>
                        @foreach($simcards as $simcard)
                            <option value="{{ $simcard->id }}">{{ $simcard->id." ".$simcard->operadora->nm_operadora." ".$simcard->nr_tel." Icc:".$simcard->nr_icc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row align-items-end mt-3">
                <div class="col-md-3 form-group">
                    <label for="">Situação:</label>
                    <select name="st_instalacao" class="form-control">
                        <option></option>
                        <option value="Instalado">Instalado</option>
                        <option value="Desinstalado">Desinstalado</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <input type="submit" value="Gerar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
