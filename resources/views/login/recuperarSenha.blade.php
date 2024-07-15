@extends('layoutLogin')

@section('conteudo')
<h1 class="mb-3 text-24 text-center">Recuperar Senha</h1>
@if($mensagem = Session::get('mensagem'))
    <div class="alert alert-danger" role="alert">
        {{ $mensagem }}
    </div>
@endif
<form action="{{ route('gerarNovaSenha') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control form-control-rounded" required name="email" type="email">
    </div>
    <button class="btn btn-rounded btn-primary btn-block mt-2">Entrar</button>
</form>
@endsection
