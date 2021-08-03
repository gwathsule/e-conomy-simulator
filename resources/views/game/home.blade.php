@php
    $ultimaRodada = $jogo->rodadas->last();
    $rodadaAnterior = $jogo->rodadas->get($jogo->rodadas->count() - 2);

    function corPorcentagem(float $cor)
    {
        if($cor < 0.1) return 'red';
        if($cor < 0.3) return 'orange';
        if($cor > 0.7) return 'green';
        if($cor > 0.9) return 'blue';
        return 'black';
    }

    function formatarDinheiro(float $valor)
    {
        return '$' . number_format($valor, 2, ',', '.');
    }

    function retornarAlteracao(string $valor, \App\Domains\Rodada\Rodada $atual, $anterior)
    {
        if($anterior == null) {
            return '<td><img src="' . asset('img/resources/not-arrow.svg') . '" width="20" height="20"></td>';
        }
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
            <div class="card card-white grid-margin" style="height: 485px">
                @include('game.indices')
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card card-white grid-margin" style="height: 485px">
                @include('game.grafico')
            </div>
        </div>
        <div class="col-xl-3" >
            <div class="card card-white grid-margin" style="height: 485px">
                @include('game.gabinete')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3">
            <div class="card card-white grid-margin" style="height: 660px">
                @include('game.financas')
            </div>
        </div>
        <div class="col-xl-6">
            <div class="profile-timeline">
                <ul class="list-unstyled">
                    <li class="timeline-item">
                        <div class="card card-white grid-margin timeline" style="height: 660px !important;">
                            @include('game.timeline')
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-3" style="height: 660px">
            <div class="card card-white grid-margin">
                @include('game.medidas')
            </div>
        </div>
    </div>
    <script>
        function displayInfo(variavel) {
            $.getJSON( "{{asset('js/descricao_variaveis.json')}}", function( data ) {
                Swal.fire({
                    title: data[variavel]['nome'],
                    html: `<p style="text-align: justify">${data[variavel]['descricao']}</p>`,
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,
                })
            });
        }
    </script>
@endsection
