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
    <div class="row">
        <div class="col-xl-2 default-table" >
            <table class="table table-sm table-striped tabela-economy">
                <tbody>
                <tr><td>Rodada</td></tr>
                <tr><td>Medida</td></tr>
                <tr><td>Setor privado (Aprovação)</td></tr>
                <tr><td>Trabalhadores (Aprovação)</td></tr>
                <tr><td>Estado (Aprovação)</td></tr>
                <tr><td>Desemprego</td></tr>
                <tr><td>Investimento em títulos</td></tr>
                <tr><td>Taxa de Juros</td></tr>
                <tr><td>EFMK</td></tr>
                <tr><td>Inflação de demanda</td></tr>
                <tr><td>Inflação de custo</td></tr>
                <tr><td>Inflação Total</td></tr>
                <tr><td>PIB</td></tr>
                <tr><td>Renda Disponível</td></tr>
                <tr><td>Consumo</td></tr>
                <tr><td>Investimento (potencial)</td></tr>
                <tr><td>Investimento (realizado)</td></tr>
                <tr><td>Arrecadação em Impostos</td></tr>
                <tr><td>Arrecadação em títulos</td></tr>
                <tr><td>Dívida Interna</td></tr>
                <tr><td>Caixa do Governo</td></tr>
                <tr><td>Gastos Governamentais</td></tr>
                <tr><td>Transferências</td></tr>
                <tr><td>Deficit/Superavit</td></tr>
                <tr><td>Dívida Total</td></tr>
                </tbody>
            </table>
        </div>
        <div class="col-xl-10 default-table" >
            <div class="row horizontal-only">
                @php
                    /** @var \App\Domains\Rodada\Rodada $rodada */
                    /** @var \App\Domains\Jogo\Jogo $jogo */
                @endphp
                @foreach($jogo->rodadas as $rodada)
                    @php
                        $ultima = $jogo->getRodada($rodada->rodada - 1);
                    @endphp
                    <div class="col-xl-3">
                        <table class="table table-sm tabela-economy">
                            <tbody>
                            <tr><td>{{$rodada->rodada}}</td></tr>
                            <tr><td>{{$rodada->medida->nome ?? 'nenhuma'}}</td></tr>
                            <tr><td class="{{retornarAlteracao('popularidade_empresarios', $rodada, $ultima)}}">{{$rodada->popularidade_empresarios * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('popularidade_trabalhadores', $rodada, $ultima)}}">{{$rodada->popularidade_trabalhadores * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('popularidade_estado', $rodada, $ultima)}}">{{$rodada->popularidade_estado * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('desemprego', $rodada, $ultima)}}">{{$rodada->desemprego * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('investimento_em_titulos', $rodada, $ultima)}}">{{$rodada->investimento_em_titulos * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('taxa_de_juros_base', $rodada, $ultima)}}">{{$rodada->taxa_de_juros_base * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('efmk', $rodada, $ultima)}}">{{$rodada->efmk * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('inflacao_de_demanda', $rodada, $ultima)}}">{{$rodada->inflacao_de_demanda * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('inflacao_de_custo', $rodada, $ultima)}}">{{$rodada->inflacao_de_custo * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('inflacao_total', $rodada, $ultima)}}">{{$rodada->inflacao_total * 100}}%</td></tr>
                            <tr><td class="{{retornarAlteracao('pib', $rodada, $ultima)}}">{{formatarDinheiro($rodada->pib)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('yd', $rodada, $ultima)}}">{{formatarDinheiro($rodada->yd)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('pib_consumo', $rodada, $ultima)}}">{{formatarDinheiro($rodada->pib_consumo)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('pib_investimento_potencial', $rodada, $ultima)}}">{{formatarDinheiro($rodada->pib_investimento_potencial)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('pib_investimento_realizado', $rodada, $ultima)}}">{{formatarDinheiro($rodada->pib_investimento_realizado)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('impostos', $rodada, $ultima)}}">{{formatarDinheiro($rodada->impostos)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('titulos', $rodada, $ultima)}}">{{formatarDinheiro($rodada->titulos)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('juros_divida_interna', $rodada, $ultima)}}">{{formatarDinheiro($rodada->juros_divida_interna)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('caixa', $rodada, $ultima)}}">{{formatarDinheiro($rodada->caixa)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('gastos_governamentais', $rodada, $ultima)}}">{{formatarDinheiro($rodada->gastos_governamentais)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('transferencias', $rodada, $ultima)}}">{{formatarDinheiro($rodada->transferencias)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('bs', $rodada, $ultima)}}">{{formatarDinheiro($rodada->bs)}}</td></tr>
                            <tr><td class="{{retornarAlteracao('divida_total', $rodada, $ultima)}}">{{formatarDinheiro($rodada->divida_total)}}</td></tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

