@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Patrimônio / Ferramenta</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('ferramentas.delete') }}" method="post">
            @csrf
            <input type="hidden" name="ferramenta_id" value="{{ $ferramenta->id }}">
            <div class="row align-items-end">
                <div class="col-md-12 form-group">
                    <p>Tem certeza que deseja excluir o patrimônio/ferramenta {{ $ferramenta->nm_ferramenta }}</p>
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
