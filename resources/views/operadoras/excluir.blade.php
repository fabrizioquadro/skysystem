@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Operadora</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('operadoras.delete') }}" method="post">
            @csrf
            <input type="hidden" name="operadora_id" value="{{ $operadora->id }}">
            <div class="row">
                <div class="col-md-12">
                    <p>Tem certeza que deseja excluir a operadora {{ $operadora->nm_operadora }}</p>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Excluir" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
