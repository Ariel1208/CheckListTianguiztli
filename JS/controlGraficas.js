function graficasGenerales() {

    $.ajax({
        type: "POST",
        data: {
            action: 'GraficaReportesAreas'
        },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var labels = [];
            var numReportes = [];

            $.map(respuesta, function (e) {
                labels.push(e.sector);
                numReportes.push(e.cantidad);
            })

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '# of Votes',
                        data: numReportes,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });


        }

    });

    $.ajax({
        type: "POST",
        data: {
            action: 'GraficaRendimientoGeneral'
        },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var labels = [];
            var promedio = [];

            $.map(respuesta, function (e) {
                labels.push(e.FECHA.toUpperCase());
                promedio.push(e.promedio * 2);
            })

            var ctx = document.getElementById('myChart2').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Rango de desempeño",
                        data: promedio,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });


        }

    });

    $.ajax({
        type: "POST",
        data: {
            action: 'GraficaMantenimiento'
        },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var labels = [];
            var promedio = [];

            $.map(respuesta, function (e) {
                labels.push(e.encargado.toUpperCase());
                promedio.push(e.cantidad);
            })

            var ctx = document.getElementById('myChart3').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Rango de desempeño",
                        data: promedio,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });


        }

    });
}

function graficaInsumos() {

    $.ajax({
        type: "POST",
        data: {
            action: 'graficaGeneralInsumos'
        },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var productos = [];
            var valores = [];
            $.map(respuesta, function (res) {
                productos.push(res.producto);
                valores.push(res.cantidad);
            })

            let myCanva = document.getElementById("graficaBarras").getContext("2d");

            var chartOptions = {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 80,
                        fontColor: 'black'
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: "black"
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Productos",
                            fontColor: "green"
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "black",
                            borderDash: [2, 5],
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Cantidad",
                            fontColor: "red"
                        }
                    }]
                }
            };

            var chart = new Chart(myCanva, {
                type: "bar",
                boxWidth: 4,
                data: {
                    labels: productos,
                    datasets: [{
                        label: "Cantidad",
                        backgroundColor: "rgb(209, 189, 20)",
                        data: valores
                    }

                    ]
                },
                options: chartOptions
            });



        }

    });
}


function graficaInsumos() {

    $.ajax({
        type: "POST",
        data: {
            action: 'graficaGeneralIns'
        },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var productos = [];
            var valores = [];
            $.map(respuesta, function (res) {
                productos.push(res.fecha_creacion);
                valores.push(res.cantidad);
            })

            let myCanva = document.getElementById("graficaBarras").getContext("2d");

            var chartOptions = {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 80,
                        fontColor: 'black'
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: "black"
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Productos",
                            fontColor: "green"
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "black",
                            borderDash: [2, 5],
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Cantidad",
                            fontColor: "red"
                        }
                    }]
                }
            };

            var chart = new Chart(myCanva, {
                type: "line",
                boxWidth: 4,
                data: {
                    labels: productos,
                    datasets: [{
                        label: "Cantidad",
                        backgroundColor: "rgb(209, 189, 20)",
                        data: valores
                    }

                    ]
                },
                options: chartOptions
            });



        }

    });
}

function graficaPlatillos(){
    /* globals Chart:false, feather:false */


    $.ajax({
        type: "POST",
        data: {
            action: 'GraficaRendimientoGeneral'
        },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var labels = [];
            var promedio = [];

            $.map(respuesta, function (e) {
                labels.push(e.FECHA.toUpperCase());
                promedio.push(e.promedio * 2);
            })

            var ctx = document.getElementById('myCanvas2').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Rango de desempeño",
                        data: promedio,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });


        }

    });

}