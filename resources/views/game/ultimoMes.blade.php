<div class="card card-white grid-margin grafico">
    <div class="card-heading clearfix">
        <h4 class="card-title">Último Mês</h4>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <tbody>
            <tr>
                <th class="nomeValor">PIB</th>
                <th class="valorMonetario">{{$ultimaRodada['pib']}}</th>
            </tr>
            <tr>
                <th class="nomeValor textoLongo">YD (renda disponível)</th>
                <th class="valorMonetario">{{$ultimaRodada['yd']}}</th>
            </tr>
            <tr>
                <th class="nomeValor textoLongo">Consumo (PIB)</th>
                <th class="valorMonetario">{{$ultimaRodada['pib_consumo']}}</th>
            </tr>
            <tr>
                <th class="nomeValor textoLongo">Investimento realizado</th>
                <th class="valorMonetario">{{$ultimaRodada['pib_investimento_realizado']}}</th>
            </tr>
            <tr>
                <th class="nomeValor textoLongo">Gastos governamentais</th>
                <th class="valorMonetario">{{$ultimaRodada['gastos_governamentais']}}</th>
            </tr>
            <tr>
                <th class="nomeValor textoLongo">Transferências</th>
                <th class="valorMonetario">{{$ultimaRodada['transferencias']}}</th>
            </tr>
            <tr>
                <th class="nomeValor">Impostos</th>
                <th class="valorMonetario">{{$ultimaRodada['impostos']}}</th>
            </tr>
            <tr>
                <th class="nomeValor textoLongo">BS (déficit ou superavit)</th>
                <th class="valorMonetario">{{$ultimaRodada['bs']}}</th>
            </tr>
            <tr>
                <th class="nomeValor">Títulos</th>
                <th class="valorMonetario">{{$ultimaRodada['titulos']}}</th>
            </tr>
            <tr>
                <th class="nomeValor textoLongo">Juros da dívida interna</th>
                <th class="valorMonetario">{{$ultimaRodada['juros_divida_interna']}}</th>
            </tr>
            <tr>
                <th class="nomeValor">Caixa</th>
                <th class="valorMonetario">{{$ultimaRodada['caixa']}}</th>
            </tr>
            <tr>
                <th class="nomeValor">Dívida Total</th>
                <th class="valorMonetario">{{$ultimaRodada['divida_total']}}</th>
            </tr>
            <tr>
                <th class="nomeValor textoLongo">Taxa de juros base</th>
                <th class="valorPorcentagem">{{$ultimaRodada['taxa_de_juros_base'] * 100}}%</th>
            </tr>
            <tr>
                <th class="nomeValor textoLongo">% de invest. em títulos</th>
                <th class="valorPorcentagem">{{$ultimaRodada['investimento_em_titulos'] * 100}}%</th>
            </tr>
            <tr>
                <th class="nomeValor">Inflação</th>
                <th class="valorPorcentagem">{{$ultimaRodada['inflacao_total'] * 100}}%</th>
            </tr>
            <tr>
                <th class="nomeValor">Desemprego</th>
                <th class="valorPorcentagem">{{$ultimaRodada['desemprego'] * 100}}%</th>
            </tr>
            <tr>
                <th class="nomeValor">IR (%)</th>
                <th class="valorPorcentagem">{{$ultimaRodada['imposto_de_renda'] * 100}}</th>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .nomeValor{
        max-width:110px;
    }

    .tabela tr{
        line-height: 14px;
    }

    .textoLongo{
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
    }

    .textoLongo:hover {
        overflow:visible;
        font-size: 10px;
        height: 20px;
    }

    .valorMonetario{
        font-size: 10px;
    }

    .valorPorcentagem{

    }
</style>