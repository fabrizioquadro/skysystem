@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Relatórios - Baixas</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('relatorios.baixas.gerar') }}" method="post">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Produto:</label>
                    <select name="produto_id" class="form-control combobox">
                        <option></option>
                        @foreach($produtos as $linha)
                            <option value="{{ $linha->id }}">{{ $linha->nm_produto." - ".$linha->marca->nm_marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Data Início:</label>
                    <input type="date" name="dt_inc" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Data Final:</label>
                    <input type="date" name="dt_fn" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Gerar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
