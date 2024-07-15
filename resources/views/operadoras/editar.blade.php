@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Operadora</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('operadoras.update') }}" method="post">
            @csrf
            <input type="hidden" name="operadora_id" value="{{ $operadora->id }}">
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Operadora:</label>
                    <input required type="text" name="nm_operadora" class="form-control" value="{{ $operadora->nm_operadora }}">
                </div>
                <div class="col-md-6 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
