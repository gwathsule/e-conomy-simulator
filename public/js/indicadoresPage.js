window.onload = function () {
    /* chart.js chart examples */

    // chart colors
    var colors = ['#007bff','#28a745','#ff0000'];

    /* large line chart */
    var chLine = document.getElementById("chLine");
    var tableLines = document.querySelectorAll('#eventos tr').length - 1;
    var lineInfo = [];
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
