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

@section('js_adicionais')
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
@endsection