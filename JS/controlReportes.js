function agregarReporte() {
    var nomReporte = $('#nombreReporte').val();
    var fechaInicio = $('#fecha-inicio').val();
    var fechaFinal = $('#fecha-final').val();
    var fechaLimite = $('#fecha-limite').val();
    var nomResponsable = $('#nombreResponsable').val();
    var plantilla = $('#slc-plantillas').val();

    if (nomResponsable == "" || fechaInicio == "" || fechaFinal == "" || nomResponsable == "" || plantilla == "" || fechaLimite == "") {
        alert("Es necesario llenar todos los campos");
        return false;
    }

    $.ajax({
        url: "../controladores/ControlReportes.php",
        type: "POST",
        data: {
            nombreReporte: nomReporte,
            fechaInicio: fechaInicio,
            fechaFinal: fechaFinal,
            fechaLimite: fechaLimite,
            responsable: nomResponsable,
            id_plantilla: plantilla,
            tipoOperacion: "agregarReporte"
        },
        success: function (respuesta) {
            if (respuesta == 1) {
                console.log(respuesta);
                alert("Reporte creado exitosamente");

                document.getElementById("formAddReportes").reset();
                $('#tablaReportes').load("vistasReportes/tablaReportes.php");
            } else {
                console.log(respuesta);
            }
        }

    })
}



function seguimientoReporte(id) {
    $.ajax({
        type: "POST",
        data: { action: 'cosultarActividadesReporte', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            tabla = "";
            $.map(respuesta, function (res) {
                tabla += "<tr id=" + res.id_detalle_reporte + "><td>" + res.actividad + "</td>";

                if (res.lunes == 1) {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "LU' name='" + res.id_detalle_reporte + "LU' value='LU." + res.id_detalle_reporte + "' checked></td>";
                } else {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "LU' name='" + res.id_detalle_reporte + "LU' value='LU." + res.id_detalle_reporte + "'></td>";
                }

                if (res.martes == 1) {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "MA' name='" + res.id_detalle_reporte + "MA' value='MA." + res.id_detalle_reporte + "' checked></td>";
                } else {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "MA' name='" + res.id_detalle_reporte + "MA' value='MA." + res.id_detalle_reporte + "'></td>";
                }

                if (res.miercoles == 1) {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "MI' name='" + res.id_detalle_reporte + "MI' value='MI." + res.id_detalle_reporte + "' checked></td>";
                } else {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "MI' name='" + res.id_detalle_reporte + "MI' value='MI." + res.id_detalle_reporte + "'></td>";
                }

                if (res.jueves == 1) {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "JU' name='" + res.id_detalle_reporte + "JU' value='JU." + res.id_detalle_reporte + "' checked></td>";
                } else {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "JU' name='" + res.id_detalle_reporte + "JU' value='JU." + res.id_detalle_reporte + "'></td>";
                }

                if (res.viernes == 1) {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "VI' name='" + res.id_detalle_reporte + "VI' value='VI." + res.id_detalle_reporte + "' checked></td>";
                } else {
                    tabla += "<td><input type='checkbox' id='" + res.id_detalle_reporte + "VI' name='" + res.id_detalle_reporte + "VI' value='VI." + res.id_detalle_reporte + "'></td>";
                }

                tabla += "</tr>";

            });

            $("#actividadesPlantilla").empty().append(tabla);

        }
    });

    $.ajax({
        url: "../controladores/control.php",
        type: "POST",
        data: {
            action: 'obtenerEvidenciasReporte',
            id: id
        },
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var table = "";
            $.map(respuesta, function (res) {
                if (res.extencion == 'jpg' || res.extencion == 'jpeg' || res.extencion == 'png') {
                    table += "<tr><td><img src=" + res.ruta + " width='100' height=100' style='border-radius:2px;'></td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_archivo + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.nombre + "><span class='fas fa-download'></span></a></td></tr>";
                } else {
                    table += "<tr><td>" + res.nombre + "</td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_archivo + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.nombre + "><span class='fas fa-download'></span></a></td></tr>";
                }
            });

            $("#evidenciasReporte").empty().append(table);

        }

    })

    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosReporte', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            $('#nomEncargado').val(respuesta['nombre_responsable']);
            $('#id-reporte').val(respuesta['id_reporte']);
            $('#observaciones').val(respuesta['observaciones']);
        }
    });
};

function guardarSeguiminetoReporte() {
    var idReporte = $('#id-reporte').val();
    var observaciones = $('#observaciones').val();

    var listLu = listaActividadesLu();
    var listMa = listaActividadesMa();
    var listMi = listaActividadesMi();
    var listJu = listaActividadesJu();
    var listVi = listaActividadesVi();


    $.ajax({
        url: "../controladores/ControlReportes.php",
        type: "POST",
        data: {
            idReporte: idReporte,
            observaciones: observaciones,
            lunes: JSON.stringify(listLu),
            martes: JSON.stringify(listMa),
            miercoles: JSON.stringify(listMi),
            jueves: JSON.stringify(listJu),
            viernes: JSON.stringify(listVi),
            tipoOperacion: "editarSeguimiento"
        },
        success: function (respuesta) {
            if (respuesta == 1) {
                alert("Reporte guardado exitosamente");
                $('#tablaReportes').load("vistasReportes/tablaReportes.php");

            } else {
                console.log(respuesta);
            }
        }


    })


}

function listaActividadesLu() {
    var listaSeguimiento = [];


    $('#tablaPlantilla tbody tr input[type=checkbox]').each(function () {
        var cadena = $(this).val();
        var res = cadena.split(".");
        if (this.checked) {
            if (res[0] == "LU") {
                listaSeguimiento.push(res[1]);
            }
        }
    })

    return listaSeguimiento;
}

function listaActividadesMa() {
    var listaSeguimiento = [];


    $('#tablaPlantilla tbody tr input[type=checkbox]').each(function () {
        var cadena = $(this).val();
        var res = cadena.split(".");
        if (this.checked) {
            if (res[0] == "MA") {
                listaSeguimiento.push(res[1]);
            }
        }
    })

    return listaSeguimiento;
}

function listaActividadesMi() {
    var listaSeguimiento = [];


    $('#tablaPlantilla tbody tr input[type=checkbox]').each(function () {
        var cadena = $(this).val();
        var res = cadena.split(".");
        if (this.checked) {
            if (res[0] == "MI") {
                listaSeguimiento.push(res[1]);
            }
        }
    })

    return listaSeguimiento;
}

function listaActividadesJu() {
    var listaSeguimiento = [];


    $('#tablaPlantilla tbody tr input[type=checkbox]').each(function () {
        var cadena = $(this).val();
        var res = cadena.split(".");
        if (this.checked) {
            if (res[0] == "JU") {
                listaSeguimiento.push(res[1]);
            }
        }
    })

    return listaSeguimiento;
}

function listaActividadesVi() {
    var listaSeguimiento = [];


    $('#tablaPlantilla tbody tr input[type=checkbox]').each(function () {
        var cadena = $(this).val();
        var res = cadena.split(".");
        if (this.checked) {
            if (res[0] == "VI") {
                listaSeguimiento.push(res[1]);
            }
        }
    })

    return listaSeguimiento;
}

function obtenerDatosReporte(id) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosReporte', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            $('#edit-id').val(respuesta['id_reporte']);
            $('#edit-nombreReporte').val(respuesta['nombre_reporte']);
            $('#edit-fecha-inicio').val(respuesta['fecha_inicial']);
            $('#edit-fecha-final').val(respuesta['fecha_final']);
            $('#edit-fecha-limite').val(respuesta['fecha_limite']);
            $('#edit-nombreResponsable').val(respuesta['nombre_responsable']);
            $('#edit-slc-plantillas').val(respuesta['id_plantilla']);
        }
    });
}

function actualizarDatosReporte() {
    var id = $('#edit-id').val();
    var nombreReporte = $('#edit-nombreReporte').val();
    var fecha_inicio = $('#edit-fecha-inicio').val();
    var fecha_final = $('#edit-fecha-final').val();
    var fecha_limite = $('#edit-fecha-limite').val();
    var responsable = $('#edit-nombreResponsable').val();

    if (id == "") {
        alert("Error de sistema");
        console.log("Error en id");
    } else if (nombreReporte == "" || fecha_inicio == "" || fecha_final == "" || fecha_limite == "" || responsable == "") {
        alert("Es necesario llenar todos los campos");
        return false;
    }
    $.ajax({
        url: "../controladores/control.php",
        type: "POST",
        data: {
            action: 'actualizarReporte',
            nomRep: nombreReporte,
            fechInicio: fecha_inicio,
            fecha_final: fecha_final,
            fecha_limite: fecha_limite,
            responsable: responsable,
            id: id
        },
        success: function (respuesta) {
            if (respuesta == 1) {
                alert("Reporte actualizado exitosamente");
                $('#tablaReportes').load("vistasReportes/tablaReportes.php");
            } else {
                alert("Error de sistema");
                console.log(respuesta);
            }

        }

    })


}


function eliminarReporte(id) {

    swal({
        title: "¿Estas seguro de eliminar este reporte?",
        text: "Una vez eliminado no podra recuperarse la información ni el reporte",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "../controladores/control.php",
                    data: {
                        action: 'eliminarReporte',
                        id: id
                    },
                    success: function (respuesta) {
                        if (respuesta == 1) {
                            alert("Reporte eliminado exitosamente");
                            $('#tablaReportes').load("vistasReportes/tablaReportes.php");
                        } else {
                            console.log(respuesta);
                        }

                    }
                });
            }
        });


}

function subirEvidenciasReportes() {
    var formData = new FormData(document.getElementById('frmArchivosReporte'));
    $.ajax({
        url: "../controladores/ControlEvidencias.php",
        type: "POST",
        datatype: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta == 1) {
                alert('El archivo se a subido exitosamente');
                $('#tablaReportes').load("vistasReportes/tablaReportes.php");
                $('.archivos').val("");
            } else if (respuesta == 2) {
                alert('Ya hay un archivo subido con este nombre');
            }
        }
    });
}

function eliminarEvidencia(id) {

    swal({
        title: "¿Estas seguro de eliminar este archivo?",
        text: "Una vez eliminado no podra recuperarse el archivo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "../controladores/ControlEvidencias.php",
                    data: {
                        tipoOperacion: 'eliminarEvidencia',
                        id: id
                    },
                    success: function (respuesta) {
                        if (respuesta == 1) {
                            $('#tablaReportes').load("vistasReportes/tablaReportes.php");

                            var idReporte = $("#id-reporte").val();
                            $.ajax({
                                url: "../controladores/control.php",
                                type: "POST",
                                data: {
                                    action: 'obtenerEvidenciasReporte',
                                    id: idReporte
                                },
                                dataType: "json",
                                success: function (respuesta) {
                                    console.log(respuesta);
                                    var table = "";
                                    $.map(respuesta, function (res) {
                                        //table += "<tr><td><img src=" + res.ruta + " width='100' height=100'></td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_archivo + ")'><span class='fas fa-trash'></span></span></td><td><a href=" + res.ruta + " download=" + res.nom + ">asda<span class='fas fa-download'></span></a></td></tr>";
                                        if (res.extencion == 'jpg' || res.extencion == 'jpeg' || res.extencion == 'png') {
                                            table += "<tr><td><img src=" + res.ruta + " width='100' height=100'></td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_archivo + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.nombre + "><span class='fas fa-download'></span></a></td></tr>";
                                        } else {
                                            table += "<tr><td>" + res.nombre + "</td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_archivo + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.nombre + "><span class='fas fa-download'></span></a></td></tr>";
                                        }
                                    });

                                    $("#evidenciasReporte").empty().append(table);

                                }

                            })
                            alert("Archivo eliminado exitosamente");
                        } else {
                            console.log(respuesta);
                        }

                    }
                });
            }
        });
}

function verEvidencia(id) {
    $.ajax({
        url: "../controladores/ControlEvidencias.php",
        type: "POST",
        data: {
            tipoOperacion: 'verEvidencia',
            id: id
        },
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

            var elemento = "";

            switch (respuesta.extencion) {
                case 'png':
                    elemento += "<img src=" + respuesta.ruta + " width='50%'>";
                    break;
                case 'jpeg':
                    elemento += "<img src=" + respuesta.ruta + " width='50%'>";
                    break;
                case 'jpg':
                    elemento += "<img src=" + respuesta.ruta + " width='50%'>";
                    break;
                case 'pdf':
                    elemento += "<embed src=" + respuesta.ruta + " type='application/pdf' width='100%' height='600px'>";
                    break;
                case 'mp3':
                    elemento += "<audio controls src=" + respuesta.ruta + " width='100%' height='600px'></audio>";
                    break;
                case 'mpeg':
                    elemento += "<audio controls src=" + respuesta.ruta + " width='100%' height='600px'></audio>";
                    break;
                case 'mp4':
                    elemento += "<video src=" + respuesta.ruta + " controls width='100%' height='600px'></video>";
                    break;
                default:
                    break;
            }

            $("#previsualizacion").empty().append(elemento);

        }
    });
}

function valorRadio(myRadio) {

    var idString = myRadio.name;

    var id = idString.split("-");

    $.ajax({
        type: "POST",
        url: "../controladores/control.php",
        data: {
            action: 'cambiarCalificacionReporte',
            id: id[1],
            cal: myRadio.value
        },
        success: function (respuesta) {

            //alert(respuesta);

        }
    });

}


/*-------------------------------------------------------------------------*/