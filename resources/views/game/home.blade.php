@php
    $ultimaRodada = $jogo->rodadas->last()->toInformation();
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
        <div class="col-lg-5 col-xl-3">
            @include('game.gabinete')
            @include('game.ultimoMes')
        </div>
        <div class="col-lg-7 col-xl-6">
            @include('game.grafico')
            @include('game.timeline')
        </div>
        <div class="col-lg-12 col-xl-3">
            @include('game.popularidade')
            @include('game.medidas')
        </div>
    </div>
@endsection