<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>E-Conomy</title>
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column bg-gray-200">
        <div id="content">
            @php
            if(! isset($game)){
                $game = \Illuminate\Support\Facades\Auth::user()->getActiveGame();
            }
            if(! is_null($game)) {
                $timeline = $game->timelines->last();
            }
            @endphp
            @include('layouts.menu')
            <div class="container-fluid">
                @if(is_null($game))
                    <div class="row">
                        @include('layouts.novoJogo')
                    </div>
                @else
                    <div class="row">
                        @include('layouts.medidas')
                    </div>
                    <div class="row">
                        @include('layouts.eventos')
                        @include('layouts.indicadores')
                    </div>
                @endif
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>E-Conomy Simulator 2020</span>
                </div>
            </div>
        </footer>
    </div>

</div>
<!-- scripts auxiliares do bootstrap (após finalizar o projeto, remover os que não estão sendo utilizado) -->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<!-- scripts externos -->
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<!-- scripts do sistema -->
<script src="{{asset('js/medidasPage.js')}}"></script>
@include('alerts.errors')
</body>
</html>
