@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir SimCard</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('simcards.delete') }}" method="post">
            @csrf
            <input type="hidden" name="simcard_id" value="{{ $sim->id }}">
            <div class="row align-items-end">
                <div class="col-md-12 form-group">
                    <p>Tem certeza que deseja excluir o simcard de telefone {{ $sim->nr_tel }}, ICC {{ $sim->nr_icc }} da operadora {{ $sim->nm_operadora }}?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Excluir" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
