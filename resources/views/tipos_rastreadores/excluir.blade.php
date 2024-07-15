@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Tipo Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('tipos_rastreadores.delete') }}" method="post">
            @csrf
            <input type="hidden" name="tipo_id" value="{{ $tipo->id }}">
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <p>Tem certeza que deseja excluir o tipo de rastreador {{ $tipo->nm_tipo_rastreador }}</p>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Excluir" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
