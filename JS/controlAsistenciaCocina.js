function iniciarRegistroAsistencia() {
    var fecha = new Date();
    $.ajax({
        type: "POST",
        data: { action: 'crearRegistrosAsistencia' },
        url: "../controladores/control.php",
        success: function(respuesta) {
            console.log(respuesta);
            if (respuesta == 1) {
                //alert("Comenzo el registro de asistencia");
                swal({
                    title: 'Comenzo el registro de asistencia',
                    icon: 'success',
                    timer: 800,
                    buttons: false,
                })
                $('#cartasAsistencia').load("vistasReportes/cartasAsistencia.php");

            } else if (respuesta == 2) {
                //alert("El registro ya se ha iniciado");
                swal({
                    title: 'El registro ya se ha iniciado',
                    icon: 'success',
                    timer: 800,
                    buttons: false,
                })
                $('#cartasAsistencia').load("vistasReportes/cartasAsistencia.php");

            } else if (respuesta == 3) {
                //alert("Error de fechas");
                swal({
                    title: 'Error de fechas',
                    icon: 'error',
                    timer: 800,
                    buttons: false,
                })
            } else if (respuesta == 4) {
                //alert("No hay usuarios para la asistencia de comida");
                swal({
                    title: 'No hay usuarios para la asistencia de comida',
                    icon: 'warning',
                    timer: 800,
                    buttons: false,
                })
            } else {
                //alert("Error de sistema");
                swal({
                    title: 'Error de sistema',
                    icon: 'error',
                    timer: 800,
                    buttons: false,
                })
            }
        }
    });
}

function marcarAsistencia(id) {

    swal({
            title: "Confirmacion de validacion",
            text: "Una vez validado no podra cambiarse",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { action: 'marcarAsistenciaUsuario', id: id },
                    url: "../controladores/control.php",
                    success: function(respuesta) {
                        console.log(respuesta);
                        if (respuesta == 1) {
                            //alert("Se ha confirmado la asistencia del usuario");
                            swal({
                                title: 'Se ha confirmado la asistencia del usuario',
                                icon: 'success',
                                timer: 800,
                                buttons: false,
                            })
                            $('#cartasAsistencia').load("vistasReportes/cartasAsistencia.php");
                        } else {
                            //alert("Eror de sistema");
                            swal({
                                title: 'Error de sistema',
                                icon: 'error',
                                timer: 800,
                                buttons: false,
                            })
                        }
                    }
                });
            }
        });
}