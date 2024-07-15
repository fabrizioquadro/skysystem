@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Adicionar Usuário</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('usuarios.insert') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Nome:</label>
                    <input required type="text" name="nome" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Email:</label>
                    <input required type="email" name="email" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Tipo:</label>
                    <select required name="tipo" class="form-control">
                        <option></option>
                        <option value="Administrador">Administrador</option>
                        <option value="Usuário">Usuário</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Senha:</label>
                    <input required type="password" name="password" class="form-control">
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Imagem do Usuário:</label>
                    <input type="file" name="imagem" class="form-control" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="col-md-6 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
