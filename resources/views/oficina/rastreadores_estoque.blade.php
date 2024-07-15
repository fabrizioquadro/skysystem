@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Alterar Estoque Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('oficina.rastreadores.estoque.set') }}" method="post">
            @csrf
            <input type="hidden" name="rastreador_id" value="{{ $rastreador->id }}">
            <div class="row">
                <div class="col-md-12 form-group">
                    <h6>{{ "Cod:".$rastreador->cod_rastreador." Marca: ".$rastreador->marca->nm_marca." Tipo: ".$rastreador->tipo->nm_tipo_rastreador." Modelo: ".$rastreador->modelo->nm_modelo }}</h6>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Estoque:</label>
                    <select name="estoque_id" required class="form-control combobox">
                        <option></option>
                        @foreach($estoques as $estoque)
                            <option @if($estoque->id == $rastreador->estoque_id) selected @endif value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
