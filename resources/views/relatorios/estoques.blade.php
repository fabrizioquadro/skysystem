@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Relatórios - Estoques</h1>
</div>
@if($mensagem = Session::get('mensagem'))
    <div class="alert alert-success" role="alert">
        {{ $mensagem }}
    </div>
@endif
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('relatorios.estoques.gerar') }}" method="post">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Estoque:</label>
                    <select name="estoque_id" class="form-control combobox" required>
                        <option></option>
                        @foreach($estoques as $estoque)
                            <option value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <input type="submit" value="Gerar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
