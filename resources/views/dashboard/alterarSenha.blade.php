@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Alterar Senha de Acesso</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form class="" action="{{ route('setNovaSenha') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Nova Senha:</label>
                    <input required type="password" class="form-control" id='password' name="password">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Confirmar Senha:</label>
                    <input required type="password" class="form-control" id='confirmar' name="confirmar">
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
<script>
document.getElementById('confirmar').addEventListener('blur', ()=>{
    if(document.getElementById('password').value != document.getElementById('confirmar').value){
        alert("É necessário que a 'Nova Senha' e  a 'Confirmar Senha' sejam a mesma.");
        document.getElementById('password').value = "";
        document.getElementById('confirmar').value = "";
    }
})
</script>
@endsection
