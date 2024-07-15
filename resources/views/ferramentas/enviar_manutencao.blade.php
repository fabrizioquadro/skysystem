@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Enviar Patrimônio / Ferramenta Manutenção</h1><br>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ "Ferramenta: ".$ferramenta->nm_ferramenta }}</h5>
        <form action="{{ route('ferramentas.enviar_manutencao.set') }}" method="post">
            @csrf
            <input type="hidden" name="ferramenta_id" value="{{ $ferramenta->id }}">
            <div class="row align-items-end">
                <div class="col-md-3 form-group">
                    <label for="">Estoque:</label>
                    <select name="estoque_id" class="form-control combobox">
                        <option></option>
                        @foreach($estoques as $estoque)
                            <option @if($estoque->id == $ferramenta->estoque_id) selected @endif value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-9 form-group">
                    <label for="">Motivo:</label>
                    <input type="text" name="ds_motivo" required class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
