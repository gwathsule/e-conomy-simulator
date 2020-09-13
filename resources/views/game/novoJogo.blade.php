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
    <title>E-Conomy - Novo Jogo</title>

</head>
<body style="background-image: url('{{asset('img/resources/fundo.png')}}');">

<span class="text-center fixot img-responsive"><img src="{{asset('img/resources/fundo-02.png')}}"></span>

<header class="bg-light"> <!-- Inicio cabecalho -->
    <nav class="navbar navbar-expand-sm" style="height: 104px;">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="{{asset('img/resources/logo.png')}}" width="206" style="margin-top: 110px;" >
            </a>
            <button class="btn btn-block bg-botoes col-2 ml-auto p-2 text-menu" type="submit">SAIR</button>
        </div>
    </nav>
</header> <!-- Fim cabecalho -->


<div class="container"> <!-- Inicio CONTEUDO -->

    <div class="row justify-content-center mt-5"><!-- Titulo NOVO JOGO -->
        <div class= "col-8 mt-5">
            <h1 class="bg-titulo col-9 mx-auto mt-5 text-center p-2">NOVO JOGO</h1>
        </div>
    </div>

    <form class="pt-4" method="post" action="{{route('novo-jogo')}}"><!-- Inicio FORM -->
        @csrf
        <div class="row justify-content-center mt-4"><!-- Inicio SELECAO DE PERSONAGEM -->

            <div id="carouselpf" class="carousel slide p-2 col-2" data-ride="carousel" >
                <ol class="carousel-indicators m-0">
                    <li data-target="#carouselpf" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselpf" data-slide-to="1"></li>
                    <li data-target="#carouselpf" data-slide-to="2"></li>
                    <li data-target="#carouselpf" data-slide-to="3"></li>
                    <li data-target="#carouselpf" data-slide-to="4"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRA_0)}}" alt="Personagem F um">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRA_1)}}" alt="Personagem F dois">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100"  src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRA_2)}}" alt="Personagem F tres">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRA_3)}}" alt="Personagem F quatro">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRA_4)}}" alt="Personagem F cinco">
                    </div>
                </div>

                <a class="carousel-control-prev" href="#carouselpf" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselpf" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            </div>
            <input type="hidden" name="index_pf" id="index_pf" value="0">

            <div id="carouselpm" class="carousel slide p-2 col-2" data-ride="carousel" >
                <ol class="carousel-indicators m-0">
                    <li data-target="#carouselpm" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselpm" data-slide-to="1"></li>
                    <li data-target="#carouselpm" data-slide-to="2"></li>
                    <li data-target="#carouselpm" data-slide-to="3"></li>
                    <li data-target="#carouselpm" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRO_0)}}" alt="Personagem M um">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRO_1)}}" alt="Personagem M dois">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRO_2)}}" alt="Personagem M tres">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRO_3)}}" alt="Personagem M quatro">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{\App\Domains\Jogo\Personagem::getPersonagem(\App\Domains\Jogo\Personagem::MINISTRO_4)}}" alt="Personagem M cinco">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselpm" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselpm" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            </div>
            <input type="hidden" name="index_pm" id="index_pm" value="0">
        </div><!-- Fim SELECAO DE PERSONAGEM -->


        <div class="row justify-content-center mb-2"><!-- Inicio SELECAO DE SEXO -->

            <div class="custom-control custom-radio custom-control-inline col-2 justify-content-center m-0" >
                <input type="radio" name="genero" class="custom-control-input" id="selecao-sexo-f" value="F" checked>
                <label class="custom-control-label text-form01" style="cursor: pointer;" for="selecao-sexo-f">MINISTRA</label>
            </div>

            <div class="custom-control custom-radio custom-control-inline col-2 justify-content-center m-0">
                <input type="radio" name="genero" class="custom-control-input" id="selecao-sexo-m"  value="M">
                <label class="custom-control-label text-form01" style="cursor: pointer;"  for="selecao-sexo-m">MINISTRO</label>
            </div>
        </div><!-- Fim SELECAO DE SEXO -->

        <div class="form-row mb-4 justify-content-center">
            <div class="col-3">
                <label for="pais"><p class="text-form01 mb-0">PAÍS</p></label>
                <input type="text" name="pais" value="{{old('pais')}}" id="pais" class="form-control text-form02" placeholder="Ex: Brasil, China...">
            </div>
            <div class="col-3">
                <label for="moeda"><p class="text-form01 mb-0">MOEDA</p></label>
                <input type="text" name="moeda" value="{{old('moeda')}}" id="moeda" class="form-control text-form02" placeholder="Inserir no plural">
            </div>
        </div>

        <div class="form-row mb-4 justify-content-center">
            <div class="col-3">
                <label for="ministro"><p class="text-form01 mb-0">MINISTRO(A) DA ECONOMIA</p></label>
                <input type="text" name="ministro" value="{{old('ministro')}}" id="ministro" class="form-control text-form02" placeholder="Esse será você!">
            </div>
            <div class="col-3">
                <label for="presidente"><p class="text-form01 mb-0">PRESIDENTE</p></label>
                <input type="text" name="presidente" value="{{old('presidente')}}" id="presidente" class="form-control text-form02" placeholder="E esse seu chefe">
            </div>
        </div>

        <div class="form-row mb-4 justify-content-center">
            <div class="col-5">
                <label for="descri-economia"><p class="text-form01 mb-0">DESCRIÇÃO DA ECONOMIA</p></label>
                <input type="text" name="descricao" value="{{old('descricao')}}" id="descri-economia" class="form-control text-form02" placeholder="Breve descrição">
            </div>

            <div class="col-1">
                <label for="quantity"><p class="text-form01 mb-0">TURNOS</p></label><br>
                <input type="number" name="rodadas" value="{{old('rodadas')}}" id="quantity" class="form-control text-form02" min="10" max="500" placeholder="10">
            </div>
        </div>

        <div class="form-row mb-4 justify-content-center">
            <button class="btn btn-block bg-botoes col-4 mx-auto mt-4 mb-4 p-2 text-menu text-center" type="submit">PRONTO!</button>
        </div>
        <div class="num"></div>
    </form><!-- Fim FORM -->


</div><!-- Fim CONTEUDO -->
{{--
<footer class="page-footer font-small bg-white mt-5 fixob"> <!-- Inicio Footer -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href=""> E-Conomy Simulator</a>
    </div>
</footer> <!-- Fim Footer --> --}}

<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('.carousel').carousel({
        interval: 0
    });
    $('#carouselpm').on('slid.bs.carousel', function () {
        document.getElementById("index_pm").value = $('#carouselpm div.active').index();
    })
    $('#carouselpf').on('slid.bs.carousel', function () {
        document.getElementById("index_pf").value = $('#carouselpf div.active').index();
    })
</script>
</body>
</html>
