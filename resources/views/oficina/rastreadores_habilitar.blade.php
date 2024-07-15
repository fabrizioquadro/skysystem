@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Habilitar Rastreador</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('oficina.rastreadores.habilitar.set') }}" method="post">
            @csrf
            <input type="hidden" name="rastreador_id" value="{{ $rastreador->id }}">
            <div class="row">
                <div class="col-md-12 form-group">
                    <p>Escolha um simcard para habilitar este rastreador.</p>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-md-6 form-group">
                    <label for="">Simcard:</label>
                    <select name="simcard_id" required class="form-control combobox">
                        <option></option>
                        @foreach($simcards as $sim)
                            <option value="{{ $sim->id }}">{{ $sim->operadora->nm_operadora." - Tel: ".$sim->nr_tel." ICC: ".$sim->nr_icc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <input type="submit" value="Habilitar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
