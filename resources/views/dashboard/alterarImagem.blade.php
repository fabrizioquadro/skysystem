@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Alterar Imagem</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form class="" action="{{ route('setNovaImagem') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Nova Senha:</label>
                    <input required type="file" class="form-control" name="imagem" accept="image/png, image/gif, image/jpeg">
                </div>
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
