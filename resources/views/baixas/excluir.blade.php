@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Baixa</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('baixas.delete') }}" method="post">
            @csrf
            <input type="hidden" name="baixa_id" value="{{ $baixa->id }}">
            <div class="row">
                <div class="col-md-12 form-group">
                    <p>Tem certeza que deseja excluir a baixa do dia {{ dataDbForm($baixa->dt_baixa) }} ?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="submit" value="Excluir" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
