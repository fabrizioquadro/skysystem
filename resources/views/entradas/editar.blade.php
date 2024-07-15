@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Entrada</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('entradas.update') }}" method="post">
            @csrf
            <input type="hidden" name="entrada_id" value="{{ $entrada->id }}">
            <input type="hidden" name="contador_produtos" id="contador_produtos" value="1">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dados Entrada</h5>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Fornecedor:</label>
                            <input type="text" name="nm_fornecedor" class="form-control" value="{{ $entrada->nm_fornecedor }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Nota Fiscal:</label>
                            <input type="text" name="nr_notafiscal" class="form-control" value="{{ $entrada->nr_notafiscal }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Data Entrada:</label>
                            <input type="date" required name="dt_entrada" class="form-control" value="{{ $entrada->dt_entrada }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <button type="button" class="btn btn-primary btn-sm" id="btnAddProd">Adicionar Produto</button>
                    <table class='table mt-3'>
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th>Estoque</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id='tabela_produtos'>
                            @foreach($produtos_cad as $prod)
                                <tr id='prodCad{{ $prod->id }}'>
                                    <td>{{ $prod->produto->nm_produto." - ".$prod->produto->marca->nm_marca }}</td>
                                    <td>{{ $prod->qt_produto }}</td>
                                    <td>{{ "R$ ".$prod->vl_produto }}</td>
                                    <td>{{ $prod->estoque->nm_estoque }}</td>
                                    <td><button type="button" onclick='deletaProduto({{ $prod->id }})' class="btn btn-danger btn-sm">Excluir</button></td>
                                </tr>
                            @endforeach
                            <tr id='linha1'>
                                <td>
                                    <select name="produto_id1" id="produto_id1" class="form-control combobox">
                                        <option value=""></option>
                                        @foreach($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->nm_produto." - ".$produto->marca->nm_marca }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="qt_produto1" class="form-control"></td>
                                <td><input type="text" name="vl_produto1" class="form-control" onkeypress="return(MascaraMoeda(this,'.',',',event))"></td>
                                <td>
                                    <select name="estoque_id1" id="estoque_id1" class="form-control">
                                        <option value=""></option>
                                        @foreach($estoques as $estoque)
                                            <option @if($estoque->st_estoque_adm == "Sim") selected @endif value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
<script>

function deletaProduto(id){
    if(confirm('Tem certeza que deseja excluir este produto da entrada? Esta ação não poderá ser desfeita.')){
        $.getJSON(
            '/entradas/delete_prod',
            {
                id : id
            },
            function(json){
                if(json.controle == 'true'){
                    alert('Produto excluído!');
                    document.getElementById('prodCad' + id).remove();
                }
            }
        );
    }
}

document.getElementById('btnAddProd').addEventListener('click', ()=>{
    contador = document.getElementById('contador_produtos').value;
    contador = parseInt(contador);
    contador++;
    document.getElementById('contador_produtos').value = contador;

    tr = document.createElement('tr');
    tr.setAttribute('id', 'linha' + contador);

    td1 = document.createElement('td');
    select = document.createElement('select');
    select.setAttribute('class', 'form-control combobox' + contador);
    select.setAttribute('name', 'produto_id' + contador);
    select.innerHTML = document.getElementById('produto_id1').innerHTML;
    td1.appendChild(select);

    td2 = document.createElement('td');
    input2 = document.createElement('input');
    input2.setAttribute('class', 'form-control');
    input2.setAttribute('name', 'qt_produto' + contador);
    input2.setAttribute('type', 'number');
    td2.appendChild(input2);

    td3 = document.createElement('td');
    input3 = document.createElement('input');
    input3.setAttribute('class', 'form-control');
    input3.setAttribute('name', 'vl_produto' + contador);
    input3.setAttribute('onkeypress', "return(MascaraMoeda(this,'.',',',event))");
    input3.setAttribute('type', 'text');
    td3.appendChild(input3);

    td4 = document.createElement('td');
    select4 = document.createElement('select');
    select4.setAttribute('class', 'form-control');
    select4.setAttribute('name', 'estoque_id' + contador);
    select4.innerHTML = document.getElementById('estoque_id1').innerHTML;
    td4.appendChild(select4);

    td5 = document.createElement('td');

    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);

    document.getElementById('tabela_produtos').appendChild(tr);
    $('.combobox' + contador).combobox();
})
</script>
@endsection
