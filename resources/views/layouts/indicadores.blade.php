<script>
    window.onload = function () {
        /* chart.js chart examples */

        // chart colors
        var colors = ['#007bff','#28a745','#ff0000'];

        /* large line chart */
        var chLine = document.getElementById("chLine");
        var chartData = {
            labels: ["S", "M", "T", "W", "T", "F", "S"],
            datasets: [{
                data: [589, 445, 483, 503, 689, 692, 634],
                backgroundColor: 'transparent',
                borderColor: colors[0],
                borderWidth: 4,
                pointBackgroundColor: colors[0]
            },
            {
                data: [222, 125, 365, 954, 589, 520, 423],
                backgroundColor: 'transparent',
                borderColor: colors[1],
                borderWidth: 4,
                pointBackgroundColor: colors[1]
            },
            {
                data: [739, 865, 293, 178, 389, 232, 974],
                backgroundColor: 'transparent',
                borderColor: colors[2],
                borderWidth: 4,
                pointBackgroundColor: colors[2]
            }
            ]
        };

        if (chLine) {
            new Chart(chLine, {
                type: 'line',
                data: chartData,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }
    }
</script>

<div class="col-xl-6 col-lg-5">
    <div class="card">
        <div class="card-header">
            Indicadores
        </div>
        <div class="card-body" style="height: 400px">
            <div class="row">
                <canvas id="chLine" class="col-md-9 mr-3" style="height: 370px;"></canvas>
                <div id="legenda" class="col-md-2">
                    <!-- Default unchecked -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="pib">
                        <label class="custom-control-label" style="color: green; font-weight: bold" for="pib">PIB</label>
                    </div>
                    <!-- Default unchecked -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="desemprego">
                        <label class="custom-control-label" style="color: blue; font-weight: bold" for="desemprego">Desemprego</label>
                    </div>
                    <!-- Default unchecked -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="inflacao">
                        <label class="custom-control-label" style="color: red; font-weight: bold" for="inflacao">Inflação</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
