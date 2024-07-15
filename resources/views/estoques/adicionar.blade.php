@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Estoque</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('estoques.insert') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="">Nome:</label>
                    <input required type="text" name="nm_estoque" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Local:</label>
                    <input type="text" name="ds_local" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">CNPJ/CPF:</label>
                    <input type="text" name="nr_cnpj_cpf" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="">Email:</label>
                    <input type="text" name="ds_email" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Telefone:</label>
                    <input type="text" name="nr_tel" class="form-control" maxlength="15" onkeypress="mascara( this, mtel )">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Celular:</label>
                    <input type="text" name="nr_cel" class="form-control" maxlength="15" onkeypress="mascara( this, mtel )">
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
