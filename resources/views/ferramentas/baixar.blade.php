@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Baixar Patrimônio / Ferramenta</h1><br>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ "Ferramenta: ".$ferramenta->nm_ferramenta }}</h5>
        <form action="{{ route('ferramentas.baixar.set') }}" method="post">
            @csrf
            <input type="hidden" name="ferramenta_id" value="{{ $ferramenta->id }}">
            <div class="row align-items-end">
                <div class="col-md-9 form-group">
                    <label for="">Motivo:</label>
                    <input type="text" name="ds_motivo" required class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
