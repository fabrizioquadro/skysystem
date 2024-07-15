@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Baixa</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('baixas.update') }}" method="post">
            @csrf
            <input type="hidden" name="baixa_id" value="{{ $baixa->id }}">
            <input type="hidden" name="contador_produtos" id='contador_produtos' value="1">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Baixa</h5>
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label for="">Data Baixa:</label>
                            <input type="date" name="dt_baixa" required class="form-control" value="{{ $baixa->dt_baixa }}">
                        </div>
                        <div class="col-md-10 form-group">
                            <label for="">Motivo:</label>
                            <input type="text" name="ds_motivo" required class="form-control" value="{{ $baixa->ds_motivo }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <button type="button" id='btnAdicionarProd' class="btn btn-primary btn-sm">Adicionar Produto</button>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Estoque</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id='tabela_produtos'>
                            @foreach($produtos_cad as $prod)
                                <tr id='linha_cad{{ $prod->id }}'>
                                    <td>{{ $prod->produto->nm_produto." - ".$prod->produto->marca->nm_marca }}</td>
                                    <td>{{ $prod->qt_produto }}</td>
                                    <td>{{ $prod->estoque->nm_estoque }}</td>
                                    <th> <button type="button" class='btn btn-danger btn-sm' onclick="deleta_produto({{ $prod->id }})">Excluir</button> </th>
                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <select name="produto_id1" id="produto_id1" class="form-control combobox">
                                        <option></option>
                                        @foreach($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->nm_produto." - ".$produto->marca->nm_marca }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="qt_produto1" class="form-control"></td>
                                <td>
                                    <select name="estoque_id1" id="estoque_id1" class="form-control combobox">
                                        <option></option>
                                        @foreach($estoques as $estoque)
                                            <option value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
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
document.getElementById('btnAdicionarProd').addEventListener('click', ()=>{
    contador = parseInt(document.getElementById('contador_produtos').value);
    contador++;
    document.getElementById('contador_produtos').value = contador;

    tr = document.createElement('tr');

    td1 = document.createElement('td');
    select1 = document.createElement('select');
    select1.setAttribute('class', 'form-control combobox' + contador);
    select1.setAttribute('name', 'produto_id' + contador);
    select1.innerHTML = document.getElementById('produto_id1').innerHTML;
    td1.appendChild(select1);

    td2 = document.createElement('td');
    input2 = document.createElement('input');
    input2.setAttribute('class', 'form-control');
    input2.setAttribute('name', 'qt_produto' + contador);
    input2.setAttribute('type', 'number');
    td2.appendChild(input2);

    td3 = document.createElement('td');
    select3 = document.createElement('select');
    select3.setAttribute('class', 'form-control combobox' + contador);
    select3.setAttribute('name', 'estoque_id' + contador);
    select3.innerHTML = document.getElementById('estoque_id1').innerHTML;
    td3.appendChild(select3);

    td4 = document.createElement('td');

    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);

    document.getElementById('tabela_produtos').appendChild(tr);
    $('.combobox' + contador).combobox();
});

function deleta_produto(id){
    if(confirm('Tem certeza que deseja excluir o produto da baixa? Esta ação não poderá ser desfeita.')){
        $.getJSON(
            '/baixas/delete_prod',
            {
                id : id
            },
            function(json){
                if(json.controle == 'true'){
                    alert('Produto excluído!');
                    document.getElementById('linha_cad' + id).remove();
                }
            }
        );
    }
}

</script>

@endsection
