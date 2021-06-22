@php
    function formatarDinheiro(float $valor)
    {
        return '$' . number_format($valor, 2, ',', '.');
    }

    function retornarAlteracao(string $valor, \App\Domains\Rodada\Rodada $atual, $anterior)
    {
        if($anterior == null) {
            return '';
        }

        if($atual->$valor > $anterior->$valor) {
            return 'valor-descrescimo';
        }

        if($atual->$valor < $anterior->$valor) {
            return 'valor-aumento';
        }

        return '';
    }
@endphp

@extends('layouts.app')
@section('title') E-Conomy Simulator @endsection
@section('css_adicionais')
    <link href="{{asset('css/game.css')}}" rel="stylesheet">
    <style>
        .default-table {
            background-color: white;
            padding: 5px;
        }

        .horizontal-only{
            overflow-x: scroll;
            flex-wrap: nowrap;
            margin-right: 0;
        }

        .valor-aumento {
            background-color: #ffa0a0;
        }

        .valor-descrescimo{
            background-color: #a1e57a;
        }
    </style>
@endsection

@section('conteudo')
<div class="row" >
    <div class="card card-white grid-margin" style="width: 100%">
        @php
        /** @var \App\Domains\ResultadoAnual\ResultadoAnual $resultado */
        @endphp
        @foreach($jogo->resultados_anuais as $resultado)
        <div class="card-heading clearfix">
            <h4 class="card-title">Ano {{$resultado->ano}}</h4>
        </div>
        <div class="card-body" >
            <div class="col-xl-12 default-table">
                <table class="table table-sm table-striped tabela-economy">
                    <tbody>
                    <tr>
                    <tr>
                        <td>PIB</td>
                        <td>{{formatarDinheiro($resultado->pib)}}</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>PIB Investimento (realizado)</td>
                        <td>{{formatarDinheiro($resultado->pib_investimento_realizado)}}</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>Gastos Governamentais</td>
                        <td>{{formatarDinheiro($resultado->gastos_governamentais)}}</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>Transferências</td>
                        <td>{{formatarDinheiro($resultado->transferencias)}}</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>Impostos</td>
                        <td>{{formatarDinheiro($resultado->impostos)}}</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>BS (Deficit/Superavit)</td>
                        <td>{{formatarDinheiro($resultado->bs)}}</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>Caixa</td>
                        <td>{{formatarDinheiro($resultado->caixa)}}</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>Dívida Total</td>
                        <td>{{formatarDinheiro($resultado->divida_total)}}</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>Inflação Total</td>
                        <td>{{$resultado->inflacao_total * 100}}%</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>Desemprego</td>
                        <td>{{$resultado->desemprego * 100}}%</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>Empresários</td>
                        <td>{{$resultado->popularidade_empresarios * 100}}%</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>População</td>
                        <td>{{$resultado->popularidade_trabalhadores * 100}}%</td>
                        <td>{{' '}}</td>
                    </tr>
                    <tr>
                        <td>Estado</td>
                        <td>{{$resultado->popularidade_estado * 100}}%</td>
                        <td>{{' '}}</td>
                    </tr>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

