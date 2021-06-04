 function llenarLocalData(){
   
    
    $.ajax({
        type: "POST",
        data: { action: 'traerDatosPlatillos' },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            
            if(respuesta != ""){
                localStorage.setItem('infoPlatillos', JSON.stringify(respuesta))
                console.log("Items Actualozados");
               
                var DATA = localStorage.getItem('infoPlatillos');
                datosPlatillos = JSON.parse(DATA);
            
                console.log(datosPlatillos.length);
                
                var table = $('#myTable').DataTable({
                    paging: true,
                    searching: true,
                    info: false,
                    data: datosPlatillos,
                    
                    columns: [
                      { title: "Nombre", data: "nombre_platillo"},
                        {title: "tipo", data: "tipo" },
                    ]
                  });
            }
        }
    });
}

function crearEncuesta(){
    var table = $('#myTable').DataTable();
    var datos = table.rows('.selected').data();

    var array = [];

    $.map(datos,(e)=>{
        array.push(e.nombre_platillo);
        array.push(e.tipo); 
    });

    if(array.length == 0)
        return alert("No se han seleccionado platillos")
    var fecha = $('#fechaLimiteEncuesta').val();

    $.ajax({
        type: "POST",
        data: { tipoOperacion: 'crearEncuesta', fecha: fecha, array: JSON.stringify(array)},
        url: "../controladores/ControlEncuestas.php",
        success: function(respuesta) {
            console.log(respuesta);

            switch (respuesta) {
                case '1':
                    alert("Encuesta creada exitosamente");
                    $('#numPlatillos').val(0);
                    $('#contenido').load("vistasEncuestas/tablaEncuestas.php");
                    break;
                case '2':
                    alert("La fecha de creación no puede ser menos a la actual");
                    break;
                case '3':
                    alert("No se pueden crear encuestas ya que no hay platillos registrados");
                    break;
                default:
                    break;
            }
        }
    });
    
}


function agregarPlatillo() {
    var formData = new FormData(document.getElementById('formPlatillo'));
    formData.append("tipoOperacion", "agregarPlatillo");

    $.ajax({
        url: "../controladores/ControlPlatillos.php",
        type: "POST",
        datatype: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            console.log(respuesta);
            switch (respuesta) {
                case '1':

                    swal({
                        title: 'Platillo agregado exitosamente',
                        icon: 'success',
                        timer: 800,
                        buttons: false,
                    })

                    let preview = document.getElementById('card'),
                        image = document.getElementById('preview');

                    image.src = "";

                    preview.innerHTML = '';
                    preview.append(image);

                    document.getElementById("formPlatillo").reset();
                    $('#contenido').load("vistasPlatillos/cartasPlatillos.php");
                    break;
                case '2':
                    swal({
                        title: 'Este nombre ya se ha dado de alta',
                        icon: 'error',
                        timer: 800,
                        buttons: false,
                    })
                    $('#contenido').load("vistasPlatillos/cartasPlatillos.php");
                    break;
                case '0':
                    swal({
                        title: 'Error al crear el platillo',
                        icon: 'error',
                        timer: 800,
                        buttons: false,
                    })
                    $('#contenido').load("vistasPlatillos/cartasPlatillos.php");
                    break;
                default:
                    console.log("Hubo un error: " + respuesta);
                    break;
            }
        }
    });
}

function obtenerDatosPlatillo(id) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosPlatilloEdit', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            let preview = document.getElementById('card-edit'),
                image = document.getElementById('preview-edit');

            if (respuesta.imagen == 'sin') {
                image.src = "../imagenesPlatillos/sinImagen.jpg";
            } else {
                image.src = respuesta.imagen;
            }

            preview.innerHTML = '';
            preview.append(image);
            console.log(respuesta);
            $('#nombrePlatillo-edit').val(respuesta.nombre_platillo);
            $('#descripcionPlatillo-edit').val(respuesta.descripcion);
            $('#tipoPlatillo-edit').val(respuesta.tipo_platillo);
            $('#id-edit').val(respuesta.id_platillo);
        }
    });
}

function editarPlatillo() {
    var formData = new FormData(document.getElementById('formPlatillo-edit'));
    formData.append("tipoOperacion", "editarPlatillo");

    $.ajax({
        url: "../controladores/ControlPlatillos.php",
        type: "POST",
        datatype: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {

            switch (respuesta) {
                case '1':

                    swal({
                        title: 'Platillo agregado exitosamente',
                        icon: 'success',
                        timer: 800,
                        buttons: false,
                    })

                    let preview = document.getElementById('card'),
                        image = document.getElementById('preview');

                    image.src = "";

                    preview.innerHTML = '';
                    preview.append(image);

                    document.getElementById("formPlatillo").reset();
                    $('#contenido').load("vistasPlatillos/cartasPlatillos.php");
                    break;
                case '2':
                    swal({
                        title: 'Este nombre ya se ha dado de alta',
                        icon: 'error',
                        timer: 800,
                        buttons: false,
                    })
                    $('#contenido').load("vistasPlatillos/cartasPlatillos.php");
                    break;
                case '0':
                    swal({
                        title: 'Error al crear el platillo',
                        icon: 'error',
                        timer: 800,
                        buttons: false,
                    })
                    $('#contenido').load("vistasPlatillos/cartasPlatillos.php");
                    break;
                default:
                    console.log("Hubo un error: " + respuesta);
                    break;
            }
        }
    });
}

function eliminarPlatillo(id) {
    swal({
            title: "¿Estas seguro de eliminar este platillo?",
            text: "Una vez eliminado no podra recuperarse",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { tipoOperacion: 'eliminarPlatillo', id: id },
                    url: "../controladores/ControlPlatillos.php",
                    success: function(respuesta) {
                        console.log(respuesta);

                        if (respuesta == 1) {
                            swal({
                                title: 'Platillo eliminado exitosamente',
                                icon: 'success',
                                timer: 10000,
                                buttons: false,
                            })
                            $('#contenido').load("vistasPlatillos/cartasPlatillos.php");
                        } else if (respuesta == 4) {
                            swal({
                                title: 'No es posible eliminar este platillo debido a que esta registrado en menus publicados',
                                icon: 'warning',
                                timer: 10000,
                                buttons: false,
                            })
                        }

                    }
                });
            }
        });
}
/*----------_--_---__------_--_-_--_-_----_--Encuestas______----_-_-_---------_-_-_-_-_-_-_-_-_---- */

//localStorage.setItem('myArray', JSON.stringify(array)



function abrirModalEncuesta() {
  
    
    $("#myTable").dataTable().fnDestroy();

    $.ajax({
        type: "POST",
        data: { action: 'validarFechaEncuesta' },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
         
          
          $('#numPlatillos').val(0);
            
            if (respuesta.cantidad > 0) {
                alert("Ya hay una encuesta en proceso, podra crear otra una vez que esta concluya");
            } else {
                llenarLocalData(); 
                $('#modalAgregarEncuesta').modal('show');
 
            }
        }
    });
}



function mosatrarTablaEncuestas() {
    $('#contenido').load("vistasEncuestas/tablaEncuestas.php");
}

function mosatrarPlatillos() {
    $('#contenido').load("vistasPlatillos/cartasPlatillos.php");
}

function obtenerDatosEncuesta(id) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosEncuesta', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta);
            $('#encuestaid').val(respuesta.id_encuesta);
            $('#fechaLimiteEncuesta-edit').val(respuesta.fecha_limite);
        }
    });
}

function editarEncuesta() {
    var fecha = $('#fechaLimiteEncuesta-edit').val();
    var id = $('#encuestaid').val();
    $.ajax({
        type: "POST",
        data: { action: 'editarEncuesta', id: id, fecha: fecha },
        url: "../controladores/control.php",
        success: function(respuesta) {

            switch (respuesta) {
                case '1':
                    alert("Encuesta creada exitosamente");
                    $('#contenido').load("vistasEncuestas/tablaEncuestas.php");
                    break;
                default:
                    console.log(respuesta);
                    $('#contenido').load("vistasEncuestas/tablaEncuestas.php");
                    break;
            }
        }
    });
}

function eliminarEncuesta(id) {
    if (id == "") {
        alert("Error de sistema");
        return false;
    }

    swal({
            title: "¿Estas seguro de eliminar este platillo?",
            text: "Una vez eliminado no podra recuperarse",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { action: 'eliminarEncuesta', id: id },
                    url: "../controladores/control.php",
                    success: function(respuesta) {
                        switch (respuesta) {
                            case '1':
                                alert("Encuesta eliminada exitosamente");
                                $('#contenido').load("vistasEncuestas/tablaEncuestas.php");
                                break;
                            default:
                                console.log(respuesta);
                                break;
                        }
                    }
                });
            }
        });
}

function crearGraficaVotacion(id) {

    $.ajax({
        type: "POST",
        data: {
            action: 'obtenerDetallesReporte',
            id: id
        },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            var act = [];
            var valores = [];
            for (i = 0; i < respuesta.length; i++) {
                contador = 0;
                act.push(respuesta[i].platillo);

                valores.push(respuesta[i].votos);
            }


            let myCanva = document.getElementById("graficaVotos").getContext("2d");

            var chartOptions = {
                scales: {
                    yAxes: [{
                        barPercentage: 0.5,
                        gridLines: {
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "black",
                            zeroLineWidth: 2
                        },
                        ticks: {
                            min: 0,
                            stepSize: 1
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Cantidad de reportes"
                        }
                    }]
                },
                elements: {
                    rectangle: {
                        borderSkipped: 'left',
                    }
                }
            };

            var chart = new Chart(myCanva, {
                type: "horizontalBar",
                boxWidth: 4,
                data: {
                    labels: act,
                    datasets: [{
                            label: "Calificacion semanal de actividad",
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

function platillosMejorVotados(id) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerTop10-Desayunos', id: id },
        url: "../controladores/control.php",
        dataType: 'json',
        success: function(respuesta) {
            tabla = "";
            $i = 0;
            tabla += "<tr><td></td><td>DESAYUNOS</td><td></td></tr>";

            $.map(respuesta, function(res) {
                if (res.tipo == "DESAYUNO" && res.votos > 0) {
                    $i++;
                    tabla += "<tr><td>" + $i + "º</td><td>" + res.platillo + "</td><td>" + res.votos + "</td><td><span class='btn btn-sm' onclick='verDetallesPaticipacion(" + res.id_detalle + ")' data-bs-toggle='modal' data-bs-target='#modalVerParticipacion'><i class='fas fa-eye' style='color:#007bff'></i><span></td></tr>";
                }
            })


            $("#tabla-platillosMasVotados").empty().append(tabla);

            $.ajax({
                type: "POST",
                data: { action: 'obtenerTop10-COMIDAS', id: id },
                url: "../controladores/control.php",
                dataType: 'json',
                success: function(respuesta) {
                    console.log(respuesta);
                    tabla = "";
                    console.log(respuesta);
                    $i = 0;
                    tabla += "<tr><td></td><td>COMIDAS</td><td></td></tr>";

                    $.map(respuesta, function(res) {
                        if (res.tipo == "COMIDA" && res.votos > 0) {
                            $i++;
                            tabla += "<tr><td>" + $i + "º</td><td>" + res.platillo + "</td><td>" + res.votos + "</td><td><span class='btn btn-warning btn-sm' onclick='verDetallesPaticipacion(" + res.id_detalle + ")' data-bs-toggle='modal' data-bs-target='#modalVerParticipacion'><i class='fas fa-eye' style='color:#007bff'></i><span></td></tr>";
                        }
                    })

                    $("#tabla-platillosMasVotados").append(tabla);
                }
            });
        }
    });


}

function verDetallesPaticipacion(id) {
    $('#modalTopEncuesta').modal('hide');
    $.ajax({
        type: "POST",
        data: { action: 'verDetallesParticipacion', id: id },
        url: "../controladores/control.php",
        dataType: 'json',
        success: function(respuesta) {
            tabla = "";
            $i = 0;
            $.map(respuesta, function(res) {
                $i++;
                tabla += "<tr><td>" + res.nombre + "</td></tr>";

            })

            $("#tabla-usuarios").empty().append(tabla);
        }
    });
}