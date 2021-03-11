<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class="card card-white grid-margin">
    <div id="container"></div>
</div>

<script>
    Highcharts.chart('container', {
        chart: {
            type: 'area',
            height: 250,
        },
        title: {
            text: 'Rodadas'
        },
        subtitle: {
            text: 'Clique numa variável para ocultá-la das demais.'
        },
        xAxis: {
            categories: [
                @for($i=0; $i< $jogo->rodadas->count(); $i++)
                {{$i}},
                @endfor
            ],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Billions'
            },
            labels: {
                formatter: function () {
                    return this.value / 1000;
                }
            }
        },
        tooltip: {
            split: true,
            valueSuffix: ' millions'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [
            {
                name: 'PIB',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{round($rodada->toInformation()['pib'])}},
                    @endforeach
                ]
            },
            {
                name: 'Investimento',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{round($rodada->toInformation()['pib_investimento_realizado'])}},
                    @endforeach
                ]
            },
            {
                name: 'Gast. Gov.',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{round($rodada->toInformation()['gastos_governamentais'])}},
                    @endforeach
                ]
            },
            {
                name: 'Transferências',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{round($rodada->toInformation()['transferencias'])}},
                    @endforeach
                ]
            },
            {
                name: 'Títulos Comprados',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{round($rodada->toInformation()['titulos'])}},
                    @endforeach
                ]
            },
            {
                name: 'Dívida Governo',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{round($rodada->toInformation()['divida_total'])}},
                    @endforeach
                ]
            },
            {
                name: 'Títulos Comprados',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{round($rodada->toInformation()['investimento_em_titulos'])}},
                    @endforeach
                ]
            },
        ]
    });
</script>

<style>
    #container {
        height: 250px;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
        height: 300px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>