@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Instalação</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('oficina.instalacoes.insert') }}" method="post">
            @csrf
            <input type="hidden" name="contador_produtos" id="contador_produtos" value="1">
            <input type="hidden" name="contador_ferramentas" id="contador_ferramentas" value="1">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dados Instalação</h5>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Cliente:</label>
                            <select name="cliente_id" onchange="busca_veiculos_cliente(this.value)" required class="form-control combobox">
                                <option></option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nm_cliente }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group" id='div_veiculos'>
                            <label for="">Veículo:</label>
                            <select name="veiculo_id" id="veiculo_id" required class="form-control combobox">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Rastreador:</label>
                            <select name="rastreador_id" required class="form-control combobox">
                                <option></option>
                                @foreach($rastreadores as $rastreador)
                                    <option value="{{ $rastreador->id }}">{{ "Cod:".$rastreador->cod_rastreador." - Marca:".$rastreador->marca->nm_marca.", Tipo:".$rastreador->tipo->nm_tipo_rastreador.", Modelo:".$rastreador->modelo->nm_modelo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Data da Instalação:</label>
                            <input type="date" name="dt_instalacao" required class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Observação:</label>
                            <textarea name="ds_obs" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Patrimônio/Ferramenta Utilizados na Instalação</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="btnAdicionarFerramenta" class="btn btn-primary btn-sm">Adicionar</button>
                        </div>
                    </div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody id="tabela_ferramenta">
                            <tr>
                                <td>
                                    <select class="form-control combobox" name="ferramenta_id1" id="ferramenta_id1">
                                        <option></option>
                                        @foreach($ferramentas as $ferramenta)
                                            <option value="{{ $ferramenta->id }}">{{ "ID: ".$ferramenta->id." - ".$ferramenta->nm_ferramenta." - Estoque: ".$ferramenta->estoque->nm_estoque }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Produtos Utilizados na Instalação</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="btnAdicionarProd" class="btn btn-primary btn-sm">Adicionar Produto</button>
                        </div>
                    </div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Estoque</th>
                            </tr>
                        </thead>
                        <tbody id="tabela_produtos">
                            <tr>
                                <td>
                                    <select class="form-control combobox" onchange="testeEstoqueProd(1)" name="produto_id1" id="produto_id1">
                                        <option></option>
                                        @foreach($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->nm_produto }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" onblur="testeEstoqueProd(1)" name="qt_produto1" id="qt_produto1" class="form-control">
                                </td>
                                <td>
                                    <select class="form-control combobox" onchange="testeEstoqueProd(1)" name="estoque_id1" id="estoque_id1">
                                        <option></option>
                                        @foreach($estoques as $estoque)
                                            <option value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                                        @endforeach
                                    </select>
                                </td>
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
function testeEstoqueProd(linha){
    produto_id = document.getElementById('produto_id' + linha).value;
    qt_produto = document.getElementById('qt_produto' + linha).value;
    estoque_id = document.getElementById('estoque_id' + linha).value;

    if(produto_id && qt_produto && estoque_id){
        $.getJSON(
            '/estoques/confere_quant_disponivel',
            {
                produto_id : produto_id,
                qt_produto : qt_produto,
                estoque_id : estoque_id
            },
            function(json){
                if(json.controle == 'false'){
                    alert('Não há quantidade disponível neste estoque do produto');
                    document.getElementById('qt_produto' + linha).value = '';
                }
            }
        );
    }
}


function busca_veiculos_cliente(id){
    $.getJSON(
        '/veiculos/busca_veiculos_cliente',
        {
            cliente_id : id
        },
        function(json){
            document.getElementById('div_veiculos').innerHTML = json.html;
            $('.combobox_veiculo').combobox();
        }
    );
}

document.getElementById('btnAdicionarFerramenta').addEventListener('click', ()=>{
    contador = parseInt(document.getElementById('contador_ferramentas').value);
    contador++;
    document.getElementById('contador_ferramentas').value = contador;

    tr = document.createElement('tr');

    td1 = document.createElement('td');
    select1 = document.createElement('select');
    select1.setAttribute('class', 'form-control combobox_ferramenta' + contador);
    select1.setAttribute('name', 'ferramenta_id' + contador);
    select1.innerHTML = document.getElementById('ferramenta_id1').innerHTML;
    td1.appendChild(select1);

    tr.appendChild(td1);
    document.getElementById('tabela_ferramenta').appendChild(tr);
    $('.combobox_ferramenta' + contador).combobox();
});

document.getElementById('btnAdicionarProd').addEventListener('click', ()=>{
    contador = parseInt(document.getElementById('contador_produtos').value);
    contador++;
    document.getElementById('contador_produtos').value = contador;

    tr = document.createElement('tr');

    td1 = document.createElement('td');
    select1 = document.createElement('select');
    select1.setAttribute('class', 'form-control combobox' + contador);
    select1.setAttribute('name', 'produto_id' + contador);
    select1.setAttribute('id', 'produto_id' + contador);
    select1.setAttribute('onchange', 'testeEstoqueProd(' + contador + ')');
    select1.innerHTML = document.getElementById('produto_id1').innerHTML;
    td1.appendChild(select1);

    td2 = document.createElement('td');
    input2 = document.createElement('input');
    input2.setAttribute('class', 'form-control');
    input2.setAttribute('name', 'qt_produto' + contador);
    input2.setAttribute('id', 'qt_produto' + contador);
    input2.setAttribute('onblur', 'testeEstoqueProd(' + contador + ')');
    input2.setAttribute('type', 'number');
    td2.appendChild(input2);

    td3 = document.createElement('td');
    select3 = document.createElement('select');
    select3.setAttribute('class', 'form-control combobox' + contador);
    select3.setAttribute('name', 'estoque_id' + contador);
    select3.setAttribute('id', 'estoque_id' + contador);
    select3.setAttribute('onchange', 'testeEstoqueProd(' + contador + ')');
    select3.innerHTML = document.getElementById('estoque_id1').innerHTML;
    td3.appendChild(select3);

    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);

    document.getElementById('tabela_produtos').appendChild(tr);
    $('.combobox' + contador).combobox();
});

</script>
@endsection
