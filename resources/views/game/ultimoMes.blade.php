<div class="card card-white grid-margin">
    <div class="card-heading clearfix">
        <h4 class="card-title"><Finanças></Finanças></h4>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-striped tabela-economy">
            <tbody>
                <tr>
                    <td>PIB</td>
                    <td>{{formatarDinheiro($ultimaRodada->pib)}}</td>
                    {!! retornarAlteracao("pib", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>Renda Disponível</td>
                    <td>{{formatarDinheiro($ultimaRodada->yd)}}</td>
                    {!! retornarAlteracao("yd", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>Consumo</td>
                    <td>{{formatarDinheiro($ultimaRodada->pib_consumo)}}</td>
                    {!! retornarAlteracao("pib_consumo", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>Investimento (esperado)</td>
                    <td>{{formatarDinheiro($ultimaRodada->pib_investimento_potencial)}}</td>
                    {!! retornarAlteracao("pib_investimento_potencial", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>Investimento (realizado)</td>
                    <td>{{formatarDinheiro($ultimaRodada->pib_investimento_realizado)}}</td>
                    {!! retornarAlteracao("pib_investimento_realizado", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>Arrecadação em Impostos</td>
                    <td>{{formatarDinheiro($ultimaRodada->impostos)}}</td>
                    {!! retornarAlteracao("impostos", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>Arrecadação em títulos</td>
                    <td>{{formatarDinheiro($ultimaRodada->titulos)}}</td>
                    {!! retornarAlteracao("titulos", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>Dívida Interna</td>
                    <td>{{formatarDinheiro($ultimaRodada->juros_divida_interna)}}</td>
                    {!! retornarAlteracao("juros_divida_interna", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>Caixa do Governo</td>
                    <td>{{formatarDinheiro($ultimaRodada->caixa)}}</td>
                    {!! retornarAlteracao("caixa", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
            </tbody>
        </table>
    </div>
</div>