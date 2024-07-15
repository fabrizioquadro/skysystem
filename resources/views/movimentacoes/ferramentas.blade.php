@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Movimentação de Ferramenta</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('movimentacoes.ferramentas.pesquisa') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Ferramenta:</label>
                    <select name="ferramenta_id" required class="form-control">
                        <option></option>
                        @foreach($ferramentas as $ferramenta)
                            <option value="{{ $ferramenta->id }}">{{ "ID: ".$ferramenta->id." ".$ferramenta->nm_ferramenta." - ".$ferramenta->marca->nm_marca }}</option>
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
                    <input type="submit" value="Pesquisar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
