@extends('layoutLogin')

@section('conteudo')
<h1 class="mb-3 text-24 text-center">Login</h1>
@if($mensagem = Session::get('mensagem'))
    <div class="alert alert-danger" role="alert">
        {{ $mensagem }}
    </div>
@endif
<form action="{{ route('autenticar') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control form-control-rounded" required name="email" type="email" value="fabrizio.quadro@gmail.com">
    </div>
    <div class="form-group">
        <label for="password">Senha:</label>
        <input class="form-control form-control-rounded" required name="password" type="password" value="fabrizio">
    </div>
    <button class="btn btn-rounded btn-primary btn-block mt-2">Entrar</button>
</form>
<div class="mt-3 text-center">
    <a class="text-muted" href="{{ route('recuperarSenha') }}">
        <u>Recuperar Senha?</u>
    </a>
</div>
@endsection
