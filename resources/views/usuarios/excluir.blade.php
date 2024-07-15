@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Excluir Usuário</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('usuarios.delete') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value='{{ $user->id }}'>
            <div class="row">
                <div class="col-md-12 form-group">
                    <p>Tem certeza que deseja excluir o usuário(a) {{ $user->nome }}</p>
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
