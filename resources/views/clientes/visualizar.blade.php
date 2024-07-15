@extends('layoutAdmin')

@section('conteudo')
<style media="screen">
    .form-group{
        border: 1px solid #dcdcdc;
    }
</style>
<div class="breadcrumb">
    <h1 class="mr-2">Visualizar Clinte</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <div class="row align-items-end">
            <div class="col-md-6 form-group">
                <label for="">Nome:</label><br>
                <b>{{ $cliente->nm_cliente }}</b>
            </div>
            <div class="col-md-2 form-group">
                <label for="">Pessoa:</label><br>
                <b>{{ $cliente->tp_pessoa }}</b>
            </div>
            <div class="col-md-2 form-group">
                <label for="">CNPJ/CPF:</label><br>
                <b>{{ $cliente->nr_cnpjcpf }}</b>
            </div>
            <div class="col-md-2 form-group">
                <label for="">IE/RG:</label><br>
                <b>{{ $cliente->nr_rgie }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <label for="">Telefone:</label><br>
                <b>{{ $cliente->nr_tel }}</b>
            </div>
            <div class="col-md-3 form-group">
                <label for="">Celular:</label><br>
                <b>{{ $cliente->nr_cel }}</b>
            </div>
            <div class="col-md-3 form-group">
                <label for="">Email:</label><br>
                <b>{{ $cliente->ds_email }}</b>
            </div>
            <div class="col-md-3 form-group">
                <label for="">CEP:</label><br>
                <b>{{ $cliente->nr_cep }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="">Endereço:</label><br>
                <b>{{ $cliente->ds_endereco }}</b>
            </div>
            <div class="col-md-3 form-group">
                <label for="">Numero:</label><br>
                <b>{{ $cliente->nr_endereco }}</b>
            </div>
            <div class="col-md-3 form-group">
                <label for="">Complemento:</label><br>
                <b>{{ $cliente->ds_complemento }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">Bairro:</label><br>
                <b>{{ $cliente->ds_bairro }}</b>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Cidade:</label><br>
                <b>{{ $cliente->nm_cidade }}</b>
            </div>
            <div class="col-md-4 form-group">
                <label for="">UF:</label><br>
                <b>{{ $cliente->ds_uf }}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="">Observação:</label><br>
                <b>{{ $cliente->ds_obs }}</b>
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
                        <label for="">Contato:</label><br>
                        <b>{{ $cliente->nm_contato }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Email:</label><br>
                        <b>{{ $cliente->ds_emailcontato }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Telefone:</label><br>
                        <b>{{ $cliente->nr_telcontato }}</b>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Celular:</label><br>
                        <b>{{ $cliente->nr_celcontato }}</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
