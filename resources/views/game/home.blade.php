@php
    $ultimaRodada = $jogo->rodadas->last()->toArray();
@endphp
@extends('layouts.app')
@section('title') E-Conomy Simulator @endsection
@section('css_adicionais')
    <script src="{{asset('js/chartjs.js')}}"></script>
    <script src="{{asset('js/grafico.js')}}"></script>
@endsection

@section('conteudo')
    <div class="row">
        @include('game.gabinete')
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