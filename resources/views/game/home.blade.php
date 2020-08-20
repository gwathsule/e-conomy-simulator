@extends('layouts.app')

@section('title', 'E-Conomy Simulator')

@section('content')
    @php
        if(! isset($jogo)){
            $jogo = \Illuminate\Support\Facades\Auth::user()->getJogoAtivo();
        }
        if(! is_null($jogo)) {
            $timeline = $jogo->momentos->last();
        }
    @endphp
    @if(is_null($jogo))
        <div class="row">
            @include('game.novoJogo')
        </div>
    @else
        <div class="row">
            @include('game.medidas')
        </div>
        <div class="row">
            @include('game.eventos')
            @include('game.indicadores')
        </div>
    @endif
@endsection

@section('scripts')
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('js/medidasPage.js')}}"></script>
    <script src="{{asset('js/indicadoresPage.js')}}"></script>
@endsection
