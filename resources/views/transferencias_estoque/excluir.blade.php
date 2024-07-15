@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Transferência</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('transferencias.delete') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $transferencia->id }}">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            Tem certeza que deseja excluir a transferencia selecionada?
                        </div>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-4 form-group">
                            <input type="submit" class="btn btn-danger" value="Excluir">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
