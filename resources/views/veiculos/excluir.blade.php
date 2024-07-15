@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Veículo</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('veiculos.delete') }}" method="post">
            @csrf
            <input type="hidden" name="veiculo_id" value="{{ $veiculo->id }}">
            <div class="row">
                <div class="col-md-6 form-group">
                    <p>Tem certeza que deseja excluir o veículo {{ $veiculo->ds_marca_modelo }} de placa {{ $veiculo->nr_placa }} do cliente {{ $veiculo->cliente->nm_cliente }}?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Excluir" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
