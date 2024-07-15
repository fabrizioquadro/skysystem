@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('rastreadores.update') }}" method="post">
            <input type="hidden" name="rastreador_id" value="{{ $rastreador->id }}">
            <input type="hidden" id="marca_id_salvar">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-3 form-group">
                    <label for="">Cod:</label>
                    <input type="text" name="cod_rastreador" class="form-control" value="{{ $rastreador->cod_rastreador }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Marca:</label>
                    <select name="marca_id" onchange="getTiposRastreadores(this.value)" id="marca_id" required class="form-control combobox">
                        <option></option>
                        @foreach($marcas as $marca)
                            <option @if($marca->id == $rastreador->marca_id) selected @endif value="{{ $marca->id }}">{{ $marca->nm_marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group" id='div_tipos'>
                    <label for="">Tipo:</label>
                    <select name="tiporastreador_id" required class="form-control combobox">
                        <option></option>
                        @foreach($tipos as $tipo)
                            <option @if($tipo->id == $rastreador->tiporastreador_id) selected @endif value="{{ $tipo->id }}">{{ $tipo->nm_tipo_rastreador }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group" id="div_modelos">
                    <label for="">Modelo:</label>
                    <select name="modelorastreador_id" id="modelorastreador_id" required class="form-control combobox">
                        <option></option>
                        @foreach($modelos as $modelo)
                            <option @if($modelo->id == $rastreador->modelorastreador_id) selected @endif value="{{ $modelo->id }}">{{ $modelo->nm_modelo }}</option>
                        @endforeach
                    </select>
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
<script>
function getTiposRastreadores(id){
    document.getElementById('marca_id_salvar').value = id;
    $.getJSON(
        '/rastreadores/busca/tipo',
        {
            marca_id : id
        },
        function(json){
            document.getElementById('div_tipos').innerHTML = json.html;
            document.getElementById('div_modelos').innerHTML = json.html_modelos;
            $('.combobox_tipo').combobox();
        }
    );
}

function getModelosRastreadores(id){
    $.getJSON(
        '/rastreadores/busca/modelo',
        {
            marca_id : document.getElementById('marca_id_salvar').value,
            tiporastreador_id : id
        },
        function(json){
            document.getElementById('div_modelos').innerHTML = json.html;
            $('.combobox_modelo').combobox();
        }
    );
}

</script>
@endsection
