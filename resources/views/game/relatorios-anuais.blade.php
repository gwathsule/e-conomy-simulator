@php
    function formatarDinheiro(float $valor)
    {
        return '$' . number_format($valor, 2, ',', '.');
    }

    function porcentagem(float $valor)
    {
        return number_format($valor, 2, ',', '.') . '%';
    }

    function aumentoBom($valor)
    {
        if($valor > 0) {
            return 'valor-descrescimo';
        }

        if($valor < 0) {
            return 'valor-aumento';
        }

        return 'valor-aumento';
    }

    function aumentoRuim($valor)
    {
        if($valor < 0) {
            return 'valor-descrescimo';
        }

        if($valor > 0) {
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
        @php
            $analise = null;
            if($resultado->ano >= 1) {
                $analise = $resultado->criarAnaliseAnual($resultado->ano);
            }
        @endphp
        <div class="card-heading clearfix">
            <h4 class="card-title">Ano {{$resultado->ano}}</h4>
        </div>
        <div class="card-body" >
            <div class="col-xl-12 default-table">
                <table class="table table-sm tabela-economy">
                    <tr>
                        <th width="16%">Nome</th>
                        <th width="2%">Valor</th>
                        <th width="2%">Diferença</th>
                        <th width="80%">Analise</th>
                    </tr>
                    <tbody>
                    <tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['pib']['diferenca'])}}">
                        <td>PIB</td>
                        <td>{{formatarDinheiro($resultado->pib)}}</td>
                        <td>{{is_null($analise) ? '' : $analise['pib']['diferenca']}}</td>
                        <td>{{is_null($analise) ? '' : $analise['pib']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['pib_investimento_realizado']['diferenca'])}}">
                        <td>PIB Investimento</td>
                        <td>{{formatarDinheiro($resultado->pib_investimento_realizado)}}</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['pib_investimento_realizado']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['pib_investimento_realizado']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['gastos_governamentais']['diferenca'])}}">
                        <td>Gastos Governamentais</td>
                        <td>{{formatarDinheiro($resultado->gastos_governamentais)}}</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['gastos_governamentais']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['gastos_governamentais']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['transferencias']['diferenca'])}}">
                        <td>Transferências</td>
                        <td>{{formatarDinheiro($resultado->transferencias)}}</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['transferencias']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['transferencias']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['impostos']['diferenca'])}}">
                        <td>Impostos</td>
                        <td>{{formatarDinheiro($resultado->impostos)}}</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['impostos']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['impostos']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['bs']['diferenca'])}}">
                        <td>Deficit/Superavit</td>
                        <td>{{formatarDinheiro($resultado->bs)}}</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['bs']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['bs']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['caixa']['diferenca'])}}">
                        <td>Caixa</td>
                        <td>{{formatarDinheiro($resultado->caixa)}}</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['caixa']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['caixa']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['divida_total']['diferenca'])}}">
                        <td>Dívida Total</td>
                        <td>{{formatarDinheiro($resultado->divida_total)}}</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['divida_total']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['divida_total']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['inflacao_total']['diferenca'])}}">
                        <td>Inflação Total</td>
                        <td>{{$resultado->inflacao_total * 100}}%</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['inflacao_total']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['inflacao_total']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['desemprego']['diferenca'])}}">
                        <td>Desemprego</td>
                        <td>{{$resultado->desemprego * 100}}%</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['desemprego']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['desemprego']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['popularidade_empresarios']['diferenca'])}}">
                        <td>Aprovação empresários</td>
                        <td>{{$resultado->popularidade_empresarios * 100}}%</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['popularidade_empresarios']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['popularidade_empresarios']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['popularidade_trabalhadores']['diferenca'])}}">
                        <td>Aprovação população</td>
                        <td>{{$resultado->popularidade_trabalhadores * 100}}%</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['popularidade_trabalhadores']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['popularidade_trabalhadores']['analise']}}</td>
                    </tr>
                    <tr class="{{is_null($analise) ? '' : aumentoBom($analise['popularidade_estado']['diferenca'])}}">
                        <td>Aprovação estado</td>
                        <td>{{$resultado->popularidade_estado * 100}}%</td>
                        <td>{{is_null($analise) ? '' : porcentagem($analise['popularidade_estado']['diferenca'])}}</td>
                        <td>{{is_null($analise) ? '' : $analise['popularidade_estado']['analise']}}</td>
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

