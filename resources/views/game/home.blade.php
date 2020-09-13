<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Estilo Customizado -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilo.css')}}">
    <link rel="icon" type="imagem/png" href="{{asset('img/resources/icon-principal.png')}}" />
    <title>E-Conomy Simulator</title>

</head>
<body style="background-image: url('{{asset('img/resources/fundo.png')}}');">

<header class="bg-light"> <!-- Inicio cabecalho -->
    <nav class="navbar navbar-expand-sm bg-light" style="height: 77px;">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="{{asset('img/resources/logo.png')}}" width="110" style="margin-top: 77px;" >
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{route('user.home')}}" class="nav-link text-nav">PRINCIPAL
                            <img src="{{asset('img/resources/icon-principal.png')}}" width="20" class="mb-2 ml-2">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-nav mr-3 ml-2">MEU PERFIL
                            <img src="{{asset('img/resources/icon-perfil.png')}}" width="30">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('logout')}}" class="nav-link text-nav mr-3 ml-2">X</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header> <!-- Fim cabecalho -->

<div class="container " style="margin-top: 75px;"><!-- Inicio CONTEUDO -->

    <div class="row"> <!-- Inicio MEDIDAS ECONOMICAS -->

        <nav class=" navbar navbar-expand-sm col-12 conteudo-nav container pb-0 no-gutters">
            <h1 class="navbar-brand">MEDIDAS ECONOMICAS</h1>

            <div class="collapse navbar-collapse" >
                <ul class="nav nav-tabs ml-auto pt-2" id="myTab" role="tablist" >
                    <li class="nav-item">
                        <a class="nav-link active text-menu" id="monetarias-tab" data-toggle="tab" href="#monetarias" role="tab" aria-controls="monetarias" aria-selected="true">MONETÁRIAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-menu" id="fiscais-tab" data-toggle="tab" href="#fiscais" role="tab" aria-controls="fiscais" aria-selected="false">FISCAIS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-menu" id="cambiais-tab" data-toggle="tab" href="#cambiais" role="tab" aria-controls="cambiais" aria-selected="false">CAMBIAIS</a>
                    </li>
                </ul>
            </div>

        </nav>

        <div class="tab-content container conteudo-corpo p-4" id="myTabContent">
            <div class="tab-pane fade show active" id="monetarias" role="tabpanel" aria-labelledby="monetarias-tab"><p>Mussum Ipsum, cacilds vidis litro abertis. Mé faiz elementum girarzis, nisi eros vermeio. Atirei o pau no gatis, per gatis num morreus. Cevadis im ampola pa arma uma pindureta. Casamentiss faiz malandris se pirulitá.</p></div>
            <div class="tab-pane fade" id="fiscais" role="tabpanel" aria-labelledby="fiscais-tab"><p>Mussum Ipsum, cacilds vidis litro abertis. Interagi no mé, cursus quis, vehicula ac nisi. Quem num gosta di mé, boa gentis num é. Nullam volutpat risus nec leo commodo, ut interdum diam laoreet. Sed non consequat odio. Mais vale um bebadis conhecidiss, que um alcoolatra anonimis.</p></div>
            <div class="tab-pane fade" id="cambiais" role="tabpanel" aria-labelledby="cambiais-tab"><p>Mussum Ipsum, cacilds vidis litro abertis. Interagi no mé, cursus quis, vehicula ac nisi. Quem num gosta di mé, boa gentis num é. Nullam volutpat risus nec leo commodo, ut interdum diam laoreet. Sed non consequat odio. Mais vale um bebadis conhecidiss, que um alcoolatra anonimis.</p></div>
        </div>
    </div><!-- Fim MEDIDAS ECONOMICAS -->

    <div class="row mt-4" >

        <div class="col-6 pl-0"><!-- Inicio EVENTOS-->

            <div class="conteudo-nav container p-2">
                <h1 class="pl-2 pt-2">EVENTOS</h1>
            </div>

            <div class="container conteudo-corpo p-4 " id="myTabContent">
                <div><p>Mussum Ipsum, cacilds vidis litro abertis. Mé faiz elementum girarzis, nisi eros vermeio. Atirei o pau no gatis, per gatis num morreus. Cevadis im ampola pa arma uma pindureta. Casamentiss faiz malandris se pirulitá.</p></div>
            </div>
        </div> <!-- Fim EVENTOS -->

        <div class="col-6 pr-0"><!-- Inicio GRÁFICO DE INDICADORES -->

            <div class="conteudo-nav container p-2">
                <h1 class="pl-2 pt-2">GRÁFICO DE INDICADORES</h1>
            </div>

            <div class="container conteudo-corpo p-4" id="myTabContent">
                <div><p>Mussum Ipsum, cacilds vidis litro abertis. Mé faiz elementum girarzis, nisi eros vermeio. Atirei o pau no gatis, per gatis num morreus. Cevadis im ampola pa arma uma pindureta. Casamentiss faiz malandris se pirulitá.</p></div>
            </div>
        </div><!-- Fim GRÁFICO DE INDICADORES -->

    </div>
</div> <!-- Fim CONTEUDO -->



<footer class="page-footer font-small bg-white fixed-bottom">
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href=""> E-Conomy Simulator</a>
    </div>
</footer>


<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
