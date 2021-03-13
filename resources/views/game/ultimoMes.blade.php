<div class="card card-white grid-margin grafico">
    <div class="card-heading clearfix">
        <h4 class="card-title">Último Mês ({{$ultimaRodada->rodada}})</h4>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-striped tabela-economy">
            <tbody>
            <tr>
                <th >PIB</th>
                <th >{{$ultimaRodada->pib}}</th>
            </tr>
            <tr>
                <th>YD (renda disponível)</th>
                <th >{{$ultimaRodada->yd}}</th>
            </tr>
            <tr>
                <th>Consumo (PIB)</th>
                <th >{{$ultimaRodada->pib_consumo}}</th>
            </tr>
            <tr>
                <th>Investimento realizado</th>
                <th >{{$ultimaRodada->pib_investimento_realizado}}</th>
            </tr>
            <tr>
                <th>Gastos governamentais</th>
                <th >{{$ultimaRodada->gastos_governamentais}}</th>
            </tr>
            <tr>
                <th>Transferências</th>
                <th >{{$ultimaRodada->transferencias}}</th>
            </tr>
            <tr>
                <th >Impostos</th>
                <th >{{$ultimaRodada->impostos}}</th>
            </tr>
            <tr>
                <th>BS (déficit ou superavit)</th>
                <th >{{$ultimaRodada->bs}}</th>
            </tr>
            <tr>
                <th >Títulos</th>
                <th >{{$ultimaRodada->titulos}}</th>
            </tr>
            <tr>
                <th>Juros da dívida interna</th>
                <th >{{$ultimaRodada->juros_divida_interna}}</th>
            </tr>
            <tr>
                <th >Caixa</th>
                <th >{{$ultimaRodada->caixa}}</th>
            </tr>
            <tr>
                <th >Dívida Total</th>
                <th >{{$ultimaRodada->divida_total}}</th>
            </tr>
            <tr>
                <th>Taxa de juros base</th>
                <th >{{$ultimaRodada->taxa_de_juros_base * 100}}%</th>
            </tr>
            <tr>
                <th>% de invest. em títulos</th>
                <th >{{$ultimaRodada->investimento_em_titulos * 100}}%</th>
            </tr>
            <tr>
                <th >Inflação</th>
                <th >{{$ultimaRodada->inflacao_total * 100}}%</th>
            </tr>
            <tr>
                <th >Desemprego</th>
                <th >{{$ultimaRodada->desemprego * 100}}%</th>
            </tr>
            <tr>
                <th >IR (%)</th>
                <th >{{$ultimaRodada->imposto_de_renda * 100}}</th>
            </tr>
            </tbody>
        </table>
    </div>
</div>