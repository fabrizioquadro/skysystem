@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Desbloquear SimCard</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('oficina.simcards.desbloquear.set') }}" method="post">
            @csrf
            <input type="hidden" name="simcard_id" value="{{ $simcard->id }}">
            <div class="row align-items-end">
                <div class="col-md-12 form-group">
                    <p>Você tem certeza que deseja desbloquear o simcard {{ $simcard->operadora->nm_operadora." - Tel:".$simcard->nr_tel." - ICC:".$simcard->nr_icc }}?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="submit" value="Desbloquear" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
