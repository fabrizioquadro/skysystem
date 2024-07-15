@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Relatórios - Rastreadores</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">

        <div class="row align-items-end">
            <div class="col-md-6 form-group">
                <label for="">Situação:</label>
                <form action="{{ route('relatorios.rastreadores.gerar') }}" method="post">
                    @csrf
                    <select name="st_rastreador" class="form-control">
                        <option></option>
                        <option value="Bloqueado">Bloqueado</option>
                        <option value="Configurado">Configurado</option>
                        <option value="Habilitado">Habilitado</option>
                        <option value="Instalado">Instalado</option>
                        <option value="Baixado">Baixado</option>
                    </select>
                    <input type="submit" value="Gerar" class="btn btn-primary mt-2">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
