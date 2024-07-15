@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Editar SimCard</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('simcards.update') }}" method="post">
            @csrf
            <input type="hidden" name="simcard_id" value="{{ $sim->id }}">
            <div class="row align-items-end">
                <div class="col-md-4 form-group">
                    <label for="">Operadora:</label>
                    <select required name="operadora_id" class="form-control combobox">
                        <option></option>
                        @foreach($operadoras as $operadora)
                            <option @if($operadora->id == $sim->operadora_id) selected @endif value="{{ $operadora->id }}">{{ $operadora->nm_operadora }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Telefone:</label>
                    <input required type="text" name="nr_tel" class="form-control" value="{{ $sim->nr_tel }}" maxlength="15" onkeypress="mascara( this, mtel )">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">ICC:</label>
                    <input required type="text" name="nr_icc" class="form-control" value="{{ $sim->nr_icc }}">
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
