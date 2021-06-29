@extends('layouts.app')
@section('title') Game @endsection
@section('css_adicionais')
    <script src="{{asset('js/chartjs.js')}}"></script>
    <script src="{{asset('js/grafico.js')}}"></script>
    <style>
        .carousel-control-prev-icon {
            background-color: #29abe2;
            border-radius: 50%;
        }

        .carousel-control-next-icon {
            background-color: #29abe2;
            border-radius: 50%;
        }
    </style>
@endsection
@section('conteudo')
    <div class="modal-header justify-content-center">
        <h2 class="text-center"><br>Configurar Jogo</h2>
    </div>
    <div class="modal-body">
        <form class="form col-md-12 center-block" method="post" action="{{route('novo-jogo')}}" >
            @csrf
            @include('game.personagens')
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
                    <label for="dificuldade">
                        <p class="text-form01 mb-0">
                            DIFICULDADE
                            <span>
                                <a onclick="infoDificuldade()" style="cursor: pointer">
                                    <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                                </a>
                            </span>
                        </p>
                    </label>
                    <select class="form-control text-form02" name="dificuldade" id="dificuldade">
                        <option value="{{\App\Domains\Jogo\Jogo::DIFICULDADE_FACIL}}">Fácil</option>
                        <option value="{{\App\Domains\Jogo\Jogo::DIFICULDADE_NORMAL}}" selected>Normal</option>
                        <option value="{{\App\Domains\Jogo\Jogo::DIFICULDADE_DIFICIL}}">Difícil</option>
                    </select>
                </div>
            </div>
            <div class="form-row mb-4 justify-content-center">
                <button class="btn btn-primary btn-lg btn-block text-menu text-center col-6" type="submit">PRONTO!</button>
            </div>
        </form>
    </div>
    <script>
        function infoDificuldade() {
            var html =
`<p style="text-align: justify">
<p>A dificuldade escolhida seleciona um dos seguintes cenários:</p><br/>
<p><strong>Fácil: </strong>Cenário ideal para testes. Você começa com total aprovação dos três setores (privado, público e população), além de um caixa alto para gastar com o que quiser!</p>
<p><strong>Normal: </strong>Cenário nem fácil nem difícil. Você começa com 50% de aprovação nos três setores (privado, público e população) e um caixa que "dá para sobreviver", depende de você tornar o governo próspero ou pobre.</p>
<p><strong>Difícil: </strong>Cenário desafiador, o governo está em clima de falência. Aqui a lei de austeridade predomina e os três setores (privado, público e população) já estão por um fio de explodir. Tem certeza que você quer pegar esse pepino? Tem que ser muito <s>troux</s> patriota! </p>
</p>`;
            Swal.fire({
                title: 'Dificuldade',
                html: html,
                showCloseButton: false,
                showCancelButton: false,
                focusConfirm: false,
            })
        }
    </script>
@endsection