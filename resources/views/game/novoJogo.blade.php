@extends('layouts.app')
@section('title') Game @endsection
@section('css_adicionais')
    <script src="{{asset('js/chartjs.js')}}"></script>
    <script src="{{asset('js/grafico.js')}}"></script>
@endsection
@section('conteudo')
    <div class="modal-header">
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
                <div class="col-6">
                    <label for="ministro"><p class="text-form01 mb-0">MINISTRO(A) DA ECONOMIA</p></label>
                    <input type="text" name="ministro" value="{{old('ministro')}}" id="ministro" class="form-control text-form02" placeholder="Esse será você!">
                </div>
            </div>
            <div class="form-row mb-4 justify-content-center">
                <button class="btn btn-primary btn-lg btn-block text-menu text-center" type="submit">PRONTO!</button>
            </div>
        </form>
    </div>
@endsection