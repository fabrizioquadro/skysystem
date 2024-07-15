@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Marca</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('marcas.delete') }}" method="post">
            @csrf
            <input type="hidden" name="marca_id" value="{{ $marca->id }}">
            <div class="row">
                <div class="col-md-12 form-group">
                    <p>Tem certeza que deseja excluir a marca {{ $marca->nm_marca }}</p>
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
