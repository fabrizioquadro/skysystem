@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Relatórios - Simcars</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">

        <div class="row align-items-end">
            <div class="col-md-6 form-group">
                <label for="">Situação:</label>
                <form action="{{ route('relatorios.simcards.gerar') }}" method="post">
                    @csrf
                    <select name="st_simcard" class="form-control">
                        <option></option>
                        <option value="Bloqueado">Bloqueado</option>
                        <option value="Desbloqueado">Desbloqueado</option>
                        <option value="Vinculado">Vinculado</option>
                        <option value="Baixado">Baixado</option>
                    </select>
                    <input type="submit" value="Gerar" class="btn btn-primary mt-2">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
