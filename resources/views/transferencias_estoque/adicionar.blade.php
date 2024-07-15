@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Transferências</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('transferencias.insert') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="">Estoque Origem:</label>
                            <select onchange="testeEstoqueProd()" name="origem_estoque_id" id="origem_estoque_id" class="form-control combobox" required>
                                <option></option>
                                @foreach($estoques as $estoque)
                                    <option value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Estoque Destino:</label>
                            <select name="destino_estoque_id" id="destino_estoque_id" class="form-control combobox" required>
                                <option></option>
                                @foreach($estoques as $estoque)
                                    <option value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Produto:</label>
                            <select name="produto_id" id="produto_id" onchange="testeEstoqueProd()" class="form-control combobox" required>
                                <option></option>
                                @foreach($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->nm_produto." - ".$produto->marca->nm_marca }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-4 form-group">
                            <label for="">Quantidade:</label>
                            <input type="number" onblur="testeEstoqueProd()" required name="qt_produto" id="qt_produto" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Data:</label>
                            <input type="date" required name="dt_transferencia" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="submit" class="btn btn-primary" value="Salvar">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

function testeEstoqueProd(linha){
    produto_id = document.getElementById('produto_id').value;
    qt_produto = document.getElementById('qt_produto').value;
    estoque_id = document.getElementById('origem_estoque_id').value;

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
                    console.log('linha = ' + linha);
                    alert('Não há quantidade disponível neste estoque do produto');
                    document.getElementById('qt_produto').value = '';
                }
            }
        );
    }
}
</script>

@endsection
