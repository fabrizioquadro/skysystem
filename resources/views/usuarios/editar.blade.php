@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar Usuário</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('usuarios.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value='{{ $user->id }}'>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Nome:</label>
                    <input required type="text" name="nome" value='{{ $user->nome }}' class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Email:</label>
                    <input required type="email" name="email" value='{{ $user->email }}' class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Tipo:</label>
                    <select required name="tipo" class="form-control">
                        <option></option>
                        <option @if($user->tipo == 'Administrador') selected  @endif value="Administrador">Administrador</option>
                        <option @if($user->tipo == 'Usuário') selected  @endif value="Usuário">Usuário</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Imagem do Usuário:</label>
                    <input type="file" name="imagem" class="form-control" accept="image/png, image/gif, image/jpeg">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
