<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sky System - Sistema Online</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('/public/dist-assets/css/themes/lite-blue.min.css') }}" rel="stylesheet">
</head>
<div class="auth-layout-wrap" style="background-image: url({{ asset('/public/img/imgLogin.jpg') }})">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4">
                        <div class="text-center mb-4"><img src="{{ asset('/public/img/logo.png') }}" alt=""></div>
                        @yield('conteudo')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
