@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar SimCard</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('simcards.insert') }}" method="post">
            @csrf
            <input type="hidden" name="contador_simcard" id='contador_simcard' value="1">
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class='btn btn-warning btn-sm' id="btnAdicionarSimcard">Adicionar SimCard</button>
                </div>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Operadora</th>
                        <th>Telefone</th>
                        <th>Icc</th>
                    </tr>
                </thead>
                <tbody id='tabela_simcards'>
                    <tr>
                        <td>
                            <select required name="operadora_id1" id='operadora_id1' class="form-control combobox">
                                <option></option>
                                @foreach($operadoras as $operadora)
                                    <option value="{{ $operadora->id }}">{{ $operadora->nm_operadora }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input required type="text" name="nr_tel1" class="form-control" maxlength="15" onkeypress="mascara( this, mtel )"></td>
                        <td><input required type="text" name="nr_icc1" class="form-control"></td>
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
document.getElementById('btnAdicionarSimcard').addEventListener('click', ()=>{
    contador = parseInt(document.getElementById('contador_simcard').value);
    contador++;
    document.getElementById('contador_simcard').value = contador;

    tr = document.createElement('tr');

    td1 = document.createElement('td');
    select1 = document.createElement('select');
    select1.setAttribute('class', 'form-control combobox' + contador);
    select1.setAttribute('name', 'operadora_id' + contador);
    select1.innerHTML = document.getElementById('operadora_id1').innerHTML;
    td1.appendChild(select1);

    td2 = document.createElement('td');
    input2 = document.createElement('input');
    input2.setAttribute('class', 'form-control');
    input2.setAttribute('name', 'nr_tel' + contador);
    input2.setAttribute('type', 'text');
    input2.setAttribute('maxlength', '15');
    input2.setAttribute('onkeypress', 'mascara( this, mtel )');
    td2.appendChild(input2);

    td3 = document.createElement('td');
    input3 = document.createElement('input');
    input3.setAttribute('class', 'form-control');
    input3.setAttribute('name', 'nr_icc' + contador);
    input3.setAttribute('type', 'text');
    td3.appendChild(input3);

    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);

    document.getElementById('tabela_simcards').appendChild(tr);
    $('.combobox' + contador).combobox();

})
</script>

@endsection
