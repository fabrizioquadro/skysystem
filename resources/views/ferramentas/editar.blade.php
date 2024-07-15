@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Patrimônio / Ferramaneta</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('ferramentas.update') }}" method="post">
            @csrf
            <input type="hidden" name="ferramenta_id" value="{{ $ferramenta->id }}">
            <div class="row align-items-end">
                <div class="col-md-3 form-group">
                    <label for="">Marca:</label>
                    <select name="marca_id" required class="form-control combobox">
                        <option></option>
                        @foreach($marcas as $marca)
                            <option @if($marca->id == $ferramenta->marca_id) selected @endif value="{{ $marca->id }}">{{ $marca->nm_marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Nome:</label>
                    <input required type="text" name="nm_ferramenta" class="form-control" value="{{ $ferramenta->nm_ferramenta }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Valor:</label>
                    <input type="text" name="vl_ferramenta" class="form-control" value="{{ valorDbForm($ferramenta->vl_ferramenta) }}" onkeypress="return(MascaraMoeda(this,'.',',',event))">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Estoque:</label>
                    <select name="estoque_id" class="form-control combobox">
                        <option></option>
                        @foreach($estoques as $estoque)
                            <option @if($estoque->id == $ferramenta->estoque_id) selected @endif value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Descrição:</label>
                    <textarea name="ds_ferramenta" class="form-control">{{ $ferramenta->ds_ferramenta }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
