@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <button type="button" id="btnAddRastreador" class="btn btn-warning btn-sm">Adicionar Rastreador</button>
        <form id='formulario' action="{{ route('rastreadores.insert') }}" method="post">
            @csrf
            <input type="hidden" id="contador_rastreadores" name="contador_rastreadores" value="1">
            <input type="hidden" id="marca_id_salvar1">
            <select id="marca_id_exemplo" style='display:none'>
                <option></option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->nm_marca }}</option>
                @endforeach
            </select>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Cod:</th>
                        <th>Marca:</th>
                        <th>Tipo:</th>
                        <th>Modelo:</th>
                    </tr>
                </thead>
                <tbody id='tabela_rastreadores'>
                    <tr>
                        <td><input type="text" name="cod_rastreador1" class="form-control"></td>
                        <td>
                            <select name="marca_id1" onchange="getTiposRastreadores(this.value, 1)" id="marca_id" required class="form-control combobox">
                                <option></option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nm_marca }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td id='td_tipo1'>
                            <select name="tiporastreador_id1" id="tiporastreador_id" required class="form-control combobox">
                                <option></option>
                            </select>
                        </td>
                        <td id='td_modelo1'>
                            <select name="modelorastreador_id1" id="modelorastreador_id" required class="form-control combobox">
                                <option></option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
<script>

document.getElementById('btnAddRastreador').addEventListener('click', ()=>{
    contador = parseInt(document.getElementById('contador_rastreadores').value);
    contador++;
    document.getElementById('contador_rastreadores').value = contador;

    //vamos criar a marca_salvar
    inputS = document.createElement('input');
    inputS.setAttribute('type','hidden');
    inputS.setAttribute('id','marca_id_salvar' + contador);

    document.getElementById('formulario').appendChild(inputS);

    tr = document.createElement('tr');

    td1 = document.createElement('td');
    input1 = document.createElement('input');
    input1.setAttribute('type','text');
    input1.setAttribute('class','form-control');
    input1.setAttribute('name','cod_rastreador' + contador);
    td1.appendChild(input1);

    td2 = document.createElement('td');
    select2 = document.createElement('select');
    select2.setAttribute('class','form-control combobox' + contador);
    select2.setAttribute('name','marca_id' + contador);
    select2.setAttribute('onchange',"getTiposRastreadores(this.value," + contador + ")");
    select2.innerHTML = document.getElementById('marca_id_exemplo').innerHTML;
    td2.appendChild(select2);

    td3 = document.createElement('td');
    td3.setAttribute('id', 'td_tipo' + contador);
    select3 = document.createElement('select');
    select3.setAttribute('class','form-control combobox' + contador);
    select3.setAttribute('name','tiporastreador_id' + contador);
    td3.appendChild(select3);

    td4 = document.createElement('td');
    td4.setAttribute('id', 'td_modelo' + contador);
    select4 = document.createElement('select');
    select4.setAttribute('class','form-control combobox' + contador);
    select4.setAttribute('name','modelorastreador_id' + contador);
    td4.appendChild(select4);

    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);

    document.getElementById('tabela_rastreadores').appendChild(tr);
    $('.combobox' + contador).combobox();

})

function getTiposRastreadores(id, linha){
    document.getElementById('marca_id_salvar' + linha).value = id;
    $.getJSON(
        '/rastreadores/busca/tipo',
        {
            marca_id : id,
            linha : linha
        },
        function(json){
            document.getElementById('td_tipo' + linha).innerHTML = json.html;
            document.getElementById('td_modelo' + linha).innerHTML = json.html_modelos;
            $('.combobox_tipo' + linha).combobox();
        }
    );
}

function getModelosRastreadores(id, linha){
    $.getJSON(
        '/rastreadores/busca/modelo',
        {
            marca_id : document.getElementById('marca_id_salvar' + linha).value,
            tiporastreador_id : id,
            linha : linha
        },
        function(json){
            document.getElementById('td_modelo' + linha).innerHTML = json.html;
            $('.combobox_modelo' + linha).combobox();
        }
    );
}

</script>
@endsection
