<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/estilo.css')}}">
    @yield('css_adicionais')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
</head>
<body>
<div class="btn_up"><a href="#"><img src="{{asset('img/resources/up-chevron.svg')}}"></a></div>
<div class="container-economy">
    <div class="page-inner no-page-title main-page">
        <!-- start page main wrapper -->
        @yield('conteudo')
        <!-- end page main wrapper -->
        <div class="page-footer">
            <p>E-conomy Simulator © 2020.</p>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@yield('js_adicionais')
@include('alerts.errors')
</body>
</html>