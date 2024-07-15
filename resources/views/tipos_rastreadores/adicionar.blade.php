@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Tipo Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('tipos_rastreadores.insert') }}" method="post">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Tipo:</label>
                    <input required type="text" name="nm_tipo_rastreador" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
