<style>

</style>

<div class="card card-white grid-margin" style="padding-bottom: 0">
    <div class="card-heading clearfix">
        <h4 class="card-title">Índices</h4>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-striped tabela-economy">
            <tbody>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('popularidade_empresarios')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>Aprovação de empresarios:</span>
                </td>
                <td><span style="color: {{corPorcentagem($ultimaRodada['popularidade_empresarios'])}}">{{$ultimaRodada->popularidade_empresarios * 100}}%</span></td>
                {!! retornarAlteracao("popularidade_empresarios", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('popularidade_trabalhadores')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>Aprovação de trabalhadores:</span>
                </td>
                <td><span style="color: {{corPorcentagem($ultimaRodada['popularidade_trabalhadores'])}}">{{$ultimaRodada->popularidade_trabalhadores * 100}}%</span></td>
                {!! retornarAlteracao("popularidade_trabalhadores", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('popularidade_estado')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>Aprovação de estado:</span>
                </td>
                <td><span style="color: {{corPorcentagem($ultimaRodada['popularidade_estado'])}}">{{$ultimaRodada->popularidade_estado * 100}}%</span></td>
                {!! retornarAlteracao("popularidade_estado", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('desemprego')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>Desemprego:</span>
                </td>
                <td><span>{{$ultimaRodada->desemprego * 100}}%</span></td>
                {!! retornarAlteracao("desemprego", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('investimento_em_titulos')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>Investimento em títulos:</span>
                </td>
                <td><span>{{$ultimaRodada->investimento_em_titulos * 100}}%</span></td>
                {!! retornarAlteracao("investimento_em_titulos", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('taxa_de_juros_base')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>Taxa de Juros:</span>
                </td>
                <td><span>{{$ultimaRodada->taxa_de_juros_base * 100}}%</span></td>
                {!! retornarAlteracao("taxa_de_juros_base", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('efmk')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>EFMK:</span>
                </td>
                <td><span>{{$ultimaRodada->efmk * 100}}%</span></td>
                {!! retornarAlteracao("efmk", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('inflacao_de_demanda')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>Inflação de demanda:</span>
                </td>
                <td><span>{{$ultimaRodada->inflacao_de_demanda * 100}}%</span></td>
                {!! retornarAlteracao("inflacao_de_demanda", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('inflacao_de_custo')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>Inflação de custo:</span>
                </td>
                <td><span>{{$ultimaRodada->inflacao_de_custo * 100}}%</span></td>
                {!! retornarAlteracao("inflacao_de_custo", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
            <tr>
                <td>
                    <span>
                        <a onclick="displayInfo('inflacao_total')" style="cursor: pointer">
                            <img src="{{asset('img/resources/question.svg')}}" style="vertical-align: center" width="12" height="12"  >
                        </a>
                    </span>
                    <span>Inflação Total:</span>
                </td>
                <td><span>{{$ultimaRodada->inflacao_total * 100}}%</span></td>
                {!! retornarAlteracao("inflacao_total", $ultimaRodada, $rodadaAnterior)!!}
            </tr>
        </table>
    </div>
</div>