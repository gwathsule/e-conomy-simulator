<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>E-Conomy Simulator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/estilo.css')}}">
    <script src="{{asset('js/chartjs.js')}}"></script>
    <script src="{{asset('js/grafico.js')}}"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="container">
    <div class="page-inner no-page-title">
        <!-- start page main wrapper -->
        <div id="main-wrapper">
            <div class="row">
                <div class="col-lg-5 col-xl-3">
                    <div class="card card-white grid-margin">
                        <div class="card-heading clearfix">
                            <h4 class="card-title">Gabinete</h4>
                        </div>
                        <div class="card-body user-profile-card mb-3">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="user-profile-image rounded-circle" alt="" />
                            <h4 class="text-center h6 mt-2">Rafael dos Santos</h4>
                            <button class="btn btn-theme btn-sm">Logout</button>
                            <button class="btn btn-theme btn-sm">Configs</button>
                        </div>
                        <hr />
                        <div class="card-heading clearfix mt-3">
                            <h4 class="card-title">Finanças:</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <p><strong>PIB</strong>: <small>R$ 1.000.000,00</small></p>
                                <p><strong>INV.</strong>: <small>R$ 1.000.000,00</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-6">
                    <div class="card card-white grid-margin">
                        <div class="card-body">
                            <canvas id="canvas"></canvas>
                        </div>
                    </div>
                    <div class="profile-timeline">
                        <ul class="list-unstyled">
                            <li class="timeline-item">
                                <div class="card card-white grid-margin">
                                    <div class="card-body">
                                        <div class="timeline-item-header">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" />
                                            <p>Veema Walkeror</p>
                                            <small>7 hours ago</small>
                                        </div>
                                        <div class="timeline-item-post">
                                            <p>totam rem aperiam, eaque ipsa quae ab illo inventore</p>
                                            <img src="{{asset('img/noticias/previsao_pib.jpg')}}" alt="" />
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline-item-header">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" />
                                            <p>Veema Walkeror</p>
                                            <small>7 hours ago</small>
                                        </div>
                                        <div class="timeline-item-post">
                                            <p>totam rem aperiam, eaque ipsa quae ab illo inventore</p>
                                            <img src="{{asset('img/noticias/previsao_pib.jpg')}}" alt="" />
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline-item-header">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" />
                                            <p>Veema Walkeror</p>
                                            <small>7 hours ago</small>
                                        </div>
                                        <div class="timeline-item-post">
                                            <p>totam rem aperiam, eaque ipsa quae ab illo inventore</p>
                                            <img src="{{asset('img/noticias/previsao_pib.jpg')}}" alt="" />
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline-item-header">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" />
                                            <p>Veema Walkeror</p>
                                            <small>7 hours ago</small>
                                        </div>
                                        <div class="timeline-item-post">
                                            <p>totam rem aperiam, eaque ipsa quae ab illo inventore</p>
                                            <img src="{{asset('img/noticias/previsao_pib.jpg')}}" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-3">
                    <div class="card card-white grid-margin">
                        <div class="card-heading clearfix">
                            <h4 class="card-title">Popularidade</h4>
                        </div>
                        <div class="card-body">
                            <div class="team">
                                <li style="font-size: 15px; list-style: none">Empresarios: 16%</li>
                                <li style="font-size: 15px; list-style: none">Trabalhadores: 16%</li>
                                <li style="font-size: 15px; list-style: none">Estado: 16%</li>
                            </div>
                        </div>
                    </div>
                    <div class="card card-white grid-margin">
                        <div class="card-heading clearfix">
                            <h4 class="card-title">Instruções</h4>
                        </div>
                        <div class="card-body">
                            <li style="list-style: none">Medida A</li>
                            <li style="list-style: none">Medida B</li>
                            <li style="list-style: none">Medida D</li>
                            <li style="list-style: none">Medida E</li>
                            <li style="list-style: none">Medida F</li>
                            <li style="list-style: none">Medida G</li>
                            <li style="list-style: none">Medida H</li>
                            <li style="list-style: none">Medida I</li>
                            <li style="list-style: none">Medida J</li>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
        </div>
        <!-- end page main wrapper -->
        <div class="page-footer">
            <p>E-conomy Simulator © 2020.</p>
        </div>
    </div>
</div>
<script>
    var config = {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'PIB',
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
                fill: false,
                borderDash: [5, 5],
                pointRadius: 15,
                pointHoverRadius: 10,
            }, {
                label: 'Gasto Governamentais',
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                fill: false,
                borderDash: [5, 5],
                pointRadius: [2, 4, 6, 18, 0, 12, 20],
            }, {
                label: 'Investimentos',
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                backgroundColor: window.chartColors.green,
                borderColor: window.chartColors.green,
                fill: false,
                pointHoverRadius: 30,
            }, {
                label: 'Transferências',
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                backgroundColor: window.chartColors.yellow,
                borderColor: window.chartColors.yellow,
                fill: false,
                pointHitRadius: 20,
            }]
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
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }]
            },
            title: {
                display: true,
                text: 'Chart.js Line Chart - Different point sizes'
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };
</script>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>