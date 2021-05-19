<div class="card card-white grid-margin">
    <div class="card-heading clearfix">
        <h4 class="card-title">Finanças</h4>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-striped tabela-economy">
            <tbody>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        PIB
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->pib)}}</td>
                    {!! retornarAlteracao("pib", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Renda Disponível
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->yd)}}</td>
                    {!! retornarAlteracao("yd", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Consumo
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->pib_consumo)}}</td>
                    {!! retornarAlteracao("pib_consumo", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Investimento (potencial)
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->pib_investimento_potencial)}}</td>
                    {!! retornarAlteracao("pib_investimento_potencial", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Investimento (realizado)
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->pib_investimento_realizado)}}</td>
                    {!! retornarAlteracao("pib_investimento_realizado", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Arrecadação em Impostos
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->impostos)}}</td>
                    {!! retornarAlteracao("impostos", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Arrecadação em títulos
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->titulos)}}</td>
                    {!! retornarAlteracao("titulos", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Dívida Interna
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->juros_divida_interna)}}</td>
                    {!! retornarAlteracao("juros_divida_interna", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Caixa do Governo
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->caixa)}}</td>
                    {!! retornarAlteracao("caixa", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Gastos Governamentais
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->gastos_governamentais)}}</td>
                    {!! retornarAlteracao("gastos_governamentais", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Transferências
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->transferencias)}}</td>
                    {!! retornarAlteracao("transferencias", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Deficit/Superavit
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->bs)}}</td>
                    {!! retornarAlteracao("bs", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
                <tr>
                    <td>
                        <span>
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </span>
                        Dívida Total
                    </td>
                    <td>{{formatarDinheiro($ultimaRodada->divida_total)}}</td>
                    {!! retornarAlteracao("divida_total", $ultimaRodada, $rodadaAnterior)!!}
                </tr>
            </tbody>
        </table>
    </div>
</div>