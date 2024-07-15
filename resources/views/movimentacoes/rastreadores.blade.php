@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Movimentação de Rastreadores</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('movimentacoes.rastreadores.pesquisa') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Rastreador:</label>
                    <select name="rastreador_id" required class="form-control">
                        <option></option>
                        @foreach($rastreadores as $rastreador)
                            <option value="{{ $rastreador->id }}">{{ "Cod: ".$rastreador->cod_rastreador." ".$rastreador->marca->nm_marca." ".$rastreador->tipo->nm_tipo_rastreador." ".$rastreador->modelo->nm_modelo }}</option>
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
