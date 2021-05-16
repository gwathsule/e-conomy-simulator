@php
    $ultimaRodada = $jogo->rodadas->last();
    $rodadaAnterior = $jogo->rodadas->get($jogo->rodadas->count() - 2);

    function corPorcentagem(float $cor)
    {
        if($cor < 0.1) return 'red';
        if($cor < 0.3) return 'yellow';
        if($cor > 0.7) return 'green';
        if($cor > 0.9) return 'blue';
        return 'black';
    }

    function formatarDinheiro(float $valor)
    {
        return '$' . number_format($valor, 2, ',', '.');
    }

    function retornarAlteracao(string $valor, \App\Domains\Rodada\Rodada $atual, \App\Domains\Rodada\Rodada $anterior)
    {
        if($atual->$valor > $anterior->$valor) {
            return '<td><img src="' . asset('img/resources/up-arrow.svg') . '" width="20" height="20"></td>';
        }

        if($atual->$valor < $anterior->$valor) {
            return '<td><img src="' . asset('img/resources/down-arrow.svg') . '" width="20" height="20"></td>';
        }

        return '<td><img src="' . asset('img/resources/not-arrow.svg') . '" width="20" height="20"></td>';
    }
@endphp
@extends('layouts.app')
@section('title') E-Conomy Simulator @endsection
@section('css_adicionais')
    <script src="{{asset('js/chartjs.js')}}"></script>
    <script src="{{asset('js/grafico.js')}}"></script>
    <link href="{{asset('css/game.css')}}" rel="stylesheet">
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-xl-3" >
            @include('game.popularidade')
        </div>
        <div class="col-xl-6" >
            @include('game.grafico')
        </div>
        <div class="col-xl-3" >
            @include('game.gabinete')
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3">
            @include('game.ultimoMes')
        </div>
        <div class="col-xl-6">
            @include('game.timeline')
        </div>
        <div class="col-xl-3">
            @include('game.medidas')
        </div>
    </div>
@endsection