@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Relatórios - Veículos</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('relatorios.veiculos.gerar') }}" method="post">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Clientes:</label>
                    <select name="cliente_id" class="form-control combobox">
                        <option></option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nm_cliente." CNPJ/CPF ".$cliente->nr_cnpj_cpf }}</option>
                        @endforeach
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
