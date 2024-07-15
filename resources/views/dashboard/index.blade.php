@extends('layoutAdmin')

@section('conteudo')
<div class="breadcrumb">
    <h1 class="mr-2">Dashboard</h1>
</div>
@if($mensagem = Session::get('mensagem'))
    <div class="alert alert-success" role="alert">
        {{ $mensagem }}
    </div>
@endif
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <!-- ICON BG-->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Myspace"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Clientes</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $nr_clientes }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Car"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Veículos</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $nr_veiculos }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Router"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Rastreadores</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $nr_rastreadores }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Wifi"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Simcards</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $nr_simcards }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Produtos em Quantidade Mínima</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Marca</th>
                            <th class="text-center">Unidade</th>
                            <th class="text-center">Qt. Mínima</th>
                            <th class="text-center">Qt. Atual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($array_produtos as $produto)
                            <tr>
                                <td>{{ $produto['nm_produto'] }}</td>
                                <td>{{ $produto['nm_marca'] }}</td>
                                <td class="text-center">{{ $produto['ds_unidade'] }}</td>
                                <td class="text-center">{{ $produto['qt_minima'] }}</td>
                                <td class="text-center">{{ $produto['qt_produto'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Double-Tap"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Instalações</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $nr_instalacoes }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Device-Sync-with-Cloud"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Ativas</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $nr_instalacoes_ativas }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
