@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Retornar Patrimônio / Ferramenta Manutenção</h1><br>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ "Ferramenta: ".$ferramenta->nm_ferramenta }}</h5>
        <form action="{{ route('ferramentas.retorno_manutencao.set') }}" method="post">
            @csrf
            <input type="hidden" name="ferramenta_id" value="{{ $ferramenta->id }}">
            <div class="row align-items-end">
                <div class="col-md-4 form-group">
                    <label for="">Estoque:</label>
                    <select required name="estoque_id" class="form-control">
                        <option></option>
                        @foreach($estoques as $estoque)
                            <option @if($estoque->st_estoque_adm == "Sim") selected @endif value="{{ $estoque->id }}">{{ $estoque->nm_estoque }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Valor do reparo:</label>
                    <input type="text" name="vl_reparo" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
