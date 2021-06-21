<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div id="container"></div>

<script>
    Highcharts.chart('container', {
        chart: {
            type: 'line',
            height: 450,
        },
        title: {
            text: 'Rodadas'
        },
        subtitle: {
            text: 'Clique em uma variável para ocultá-la'
        },
        xAxis: {
            categories: [
                @for($i=1; $i<= $jogo->rodadas->count(); $i++)
                {{$i}},
                @endfor
            ]
        },
        yAxis: {
            title: {
                text: '{{$jogo->moeda}}'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [
            {
                name: 'Gastos Governamentais',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{$rodada->gastos_governamentais}},
                    @endforeach
                ]
            },
            {
                name: 'Transferências',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{$rodada->transferencias}},
                    @endforeach
                ]
            },
            {
                name: 'Deficit/Superavit',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{$rodada->bs}},
                    @endforeach
                ]
            },
            {
                name: 'Caixa',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{$rodada->caixa}},
                    @endforeach
                ]
            },
            {
                name: 'Dívida Total',
                data: [
                    @foreach($jogo->rodadas as $rodada)
                    {{$rodada->divida_total}},
                    @endforeach
                ]
            },
        ]
    });
</script>

<style>
    .highcharts-data-table table {
        min-width: 360px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
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