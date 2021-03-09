<div class="card card-white grid-margin grafico">
    <div class="card-body">
        <canvas id="canvas"></canvas>
    </div>
</div>

<script>
    var config = {
        type: 'line',
        data: {
            labels: [
                @for($i=0; $i< $jogo->rodadas->count(); $i++)
                {{$i}},
                @endfor
            ],
            datasets: [
                {
                    label: 'PIB',
                    data: [
                        @foreach($jogo->rodadas as $rodada)
                        {{round($rodada->toInformation()['pib'])}},
                        @endforeach
                    ],
                    backgroundColor: window.chartColors.purple,
                    borderColor: window.chartColors.purple,
                    fill: false,
                    borderDash: [5, 5],
                },
                {
                    label: 'Consumo',
                    data: [
                        @foreach($jogo->rodadas as $rodada)
                        {{round($rodada->toInformation()['pib'])}},
                        @endforeach
                    ],
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    fill: false,
                    borderDash: [5, 5],
                },
                {
                    label: 'Transferencias',
                    data: [
                        @foreach($jogo->rodadas as $rodada)
                        {{round($rodada->toInformation()['pib'])}},
                        @endforeach
                    ],
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    fill: false,
                    borderDash: [5, 5],
                },
                {
                    label: 'Impostos',
                    data: [
                        @foreach($jogo->rodadas as $rodada)
                        {{round($rodada->toInformation()['pib'])}},
                        @endforeach
                    ],
                    backgroundColor: window.chartColors.yellow,
                    borderColor: window.chartColors.yellow,
                    fill: false,
                    borderDash: [5, 5],
                },
                {
                    label: 'Investimentos',
                    data: [
                        @foreach($jogo->rodadas as $rodada)
                        {{round($rodada->toInformation()['pib'])}},
                        @endforeach
                    ],
                    backgroundColor: window.chartColors.orange,
                    borderColor: window.chartColors.orange,
                    fill: false,
                    borderDash: [5, 5],
                },
                {
                    label: 'Gst. Gov.',
                    data: [
                        @foreach($jogo->rodadas as $rodada)
                        {{round($rodada->toInformation()['pib'])}},
                        @endforeach
                    ],
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    fill: false,
                    borderDash: [5, 5],
                },

            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            hover: {
                mode: 'index'
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Rodadas'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: '{{$jogo->moeda}}'
                    }
                }]
            },
            title: {
                display: true,
                text: 'Gráfico Econômico'
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };
</script>