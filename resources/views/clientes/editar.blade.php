@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Clinte</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('clientes.update') }}" method="post">
            @csrf
            <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Nome:</label>
                    <input required type="text" name="nm_cliente" class="form-control" value="{{ $cliente->nm_cliente }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="">Pessoa:</label>
                    <select class="form-control" name="tp_pessoa" id='tp_pessoa'>
                        <option></option>
                        <option @if($cliente->tp_pessoa == "Pessoa Física") selected @endif value="Pessoa Física">Pessoa Física</option>
                        <option @if($cliente->tp_pessoa == "Pessoa Jurídica") selected @endif value="Pessoa Jurídica">Pessoa Jurídica</option>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <label for="">CNPJ/CPF:</label>
                    <input type="text" name="nr_cnpjcpf" class="form-control" value="{{ $cliente->nr_cnpjcpf }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="">IE/RG:</label>
                    <input type="text" name="nr_rgie" class="form-control" value="{{ $cliente->nr_rgie }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="">Telefone:</label>
                    <input type="text" name="nr_tel" class="form-control" value="{{ $cliente->nr_tel }}" maxlength="15" onkeypress="mascara( this, mtel )">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Celular:</label>
                    <input type="text" name="nr_cel" class="form-control" value="{{ $cliente->nr_cel }}" maxlength="15" onkeypress="mascara( this, mtel )">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Email:</label>
                    <input type="email" name="ds_email" class="form-control" value="{{ $cliente->ds_email }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">CEP:</label>
                    <input type="text" name="nr_cep" class="form-control" value="{{ $cliente->nr_cep }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Endereço:</label>
                    <input type="text" name="ds_endereco" class="form-control" value="{{ $cliente->ds_endereco }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Numero:</label>
                    <input type="text" name="nr_endereco" class="form-control" value="{{ $cliente->nr_endereco }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Complemento:</label>
                    <input type="text" name="ds_complemento" class="form-control" value="{{ $cliente->ds_complemento }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="">Bairro:</label>
                    <input type="text" name="ds_bairro" class="form-control" value="{{ $cliente->ds_bairro }}">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Cidade:</label>
                    <input type="text" name="nm_cidade" class="form-control" value="{{ $cliente->nm_cidade }}">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">UF:</label>
                    <input type="text" name="ds_uf" class="form-control" value="{{ $cliente->ds_uf }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Observação:</label>
                    <textarea name="ds_obs" class="form-control">{{ $cliente->ds_obs }}</textarea>
                </div>
            </div>
            @php
            if($cliente->tp_pessoa == "Pessoa Jurídica"){
                $display = "block";
            }
            else{
                $display = "none";
            }
            @endphp
            <div class="card mt-3 mb-3" id='divContato' style='display: {{ $display }}'>
                <div class="card-body">
                    <h4 class="card-title">Contato</h4>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="">Contato:</label>
                            <input type="text" name="nm_contato" id="nm_contato" class="form-control" value="{{ $cliente->nm_contato }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Email:</label>
                            <input type="email" name="ds_emailcontato" id="ds_emailcontato" class="form-control" value="{{ $cliente->ds_emailcontato }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Telefone:</label>
                            <input type="text" name="nr_telcontato" id="nr_telcontato" class="form-control" value="{{ $cliente->nr_telcontato }}" maxlength="15" onkeypress="mascara( this, mtel )">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Celular:</label>
                            <input type="text" name="nr_celcontato" id="nr_celcontato" class="form-control" value="{{ $cliente->nr_celcontato }}" maxlength="15" onkeypress="mascara( this, mtel )">
                        </div>
                    </div>
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
document.getElementById('tp_pessoa').addEventListener('change', ()=>{
    if(document.getElementById('tp_pessoa').value == "Pessoa Jurídica"){
        document.getElementById('divContato').style.display = 'block';
    }
    else{
        document.getElementById('divContato').style.display = 'none';
        document.getElementById('nm_contato').value = "";
        document.getElementById('ds_emailcontato').value = "";
        document.getElementById('nr_telcontato').value = "";
        document.getElementById('nr_celcontato').value = "";
    }
})
</script>

@endsection
