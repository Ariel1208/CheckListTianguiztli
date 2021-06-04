function agregarActividad() {
    var actividad = $("#actividad").val();

    if (actividad == "") {
        alert("Favor de llenar el campo");
        return false;
    } else {
        tabla = "<tr><td>" + actividad + "</td><td><span class='btn btn-danger btn-sm' id='btn-del'><i class='fas fa-trash-alt'></i></span></td></tr>";

        $("#ActividadesBody").append(tabla);

        $("#actividad").val("")
    }
}

function agregarRegistro() {

    var fechaInicial = $('#fecha-inicio').val();
    var fechaFinal = $('#fecha-final').val();
    var arrayDias = obtenerDiasTabla();
    var arrayActividades = obtenerActividadesTabla();

    //Vlidaciones-----------_________------_--_--__--_-----_--_--_---_------__--_-__---_--___----__-

    var inicial = new Date(fechaInicial);
    var final = new Date(fechaFinal);
    var fecha1 = moment(fechaInicial);
    var fecha2 = moment(fechaFinal);

    if (fechaInicial == '' || fechaFinal == '') {
        alert("Falta un campo de fecha por llenar");
        return false;
    }
    if (arrayDias.length == 0) {
        alert("Tiene que seleccionar almenos un dia de la semana");
        return false;
    }
    if (arrayActividades.length == 0) {
        alert("Tiene que agregar almenos una actividad");
        return false;
    }
    if (inicial > final) {
        alert("La fecha inicial debe de ser menor a la fecha final");
        return false;
    }

    var diasDiferencia = fecha2.diff(fecha1, 'days') + 1;
    if (diasDiferencia < arrayDias.length) {
        alert("Los cantidad de dias no coincide con la fecha, agregue mas dias a la fecha final del registro");
        return false;
    }

    $.ajax({
        type: "POST",
        data: {
            tipoOperacion: 'agregarRegistro',
            fechaInicial: fechaInicial,
            fechaFinal: fechaFinal,
            listaDias: JSON.stringify(arrayDias),
            listaActividades: JSON.stringify(arrayActividades)
        },
        url: "../controladores/ControlMantenimiento.php",
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("Registro creado exitosamente", ":D", "success");
                $('#tabla').load("vistasMantenimiento/tablaMantenimiento.php");
                $("#frmAddMantenimiento")[0].reset();
                $("#ActividadesBody").empty();
            } else {
                swal("Algo salio mal, contacte al administrador", ":C", "error");
            }

        }
    });


}

function obtenerDiasTabla() {

    arrayDias = [];

    if ($('#ch-l').prop('checked')) {
        arrayDias.push('L')
    }
    if ($('#ch-m').prop('checked')) {
        arrayDias.push('M')
    }
    if ($('#ch-mi').prop('checked')) {
        arrayDias.push('MI')
    }
    if ($('#ch-j').prop('checked')) {
        arrayDias.push('J')
    }
    if ($('#ch-v').prop('checked')) {
        arrayDias.push('V')
    }

    return arrayDias;

}

function obtenerActividadesTabla() {

    var listaActividades = [];

    $('#tablaActividades tbody tr').each(function (result) {
        $(this).children("td").each(function (res2) {
            switch (res2) {
                case 0:
                    listaActividades.push($(this).text());
                    break;
            }
        })
    });

    return listaActividades;
}

/*Edicion y seguimiento---------------------------------------------------------------------*/

function seguimientoMantenimineto(id) {
    $.ajax({
        type: "POST",
        data: {
            action: "obtenerDatosMantenimiento",
            id: id
        },
        dataType: "json",
        url: "../controladores/control.php",
        success: function (respuesta) {
            console.log(respuesta);

            $("#observaciones").val(respuesta.observaciones);

        }
    });

    $('#id-seguimiento').val(id);
    $.ajax({
        type: "POST",
        data: {
            action: 'obtenerConfiguracionMantenimiento',
            id: id
        },
        dataType: "json",
        url: "../controladores/control.php",
        success: function (respuesta) {
            console.log(respuesta);
            var head = "<th>Actividades</th>";
            if (respuesta.Lunes == 1) {
                head += "<th>Lunes</th>";
            }
            if (respuesta.Martes == 1) {
                head += "<th>Martes</th>";
            }
            if (respuesta.Miercoles == 1) {
                head += "<th>Miercoles</th>";
            }
            if (respuesta.Jueves == 1) {
                head += "<th>Jueves</th>";
            }
            if (respuesta.Viernes == 1) {
                head += "<th>Viernes</th>";
            }

            $("#headReporte").empty().append(head);
            /*Control de actividades________________---_-_-_-_----__-_---_-_-_-_-_-_-_--__-_-----_-- */
            $.ajax({
                type: "POST",
                data: {
                    action: 'obtenerActividadesMantenimiento',
                    id: id
                },
                dataType: "json",
                url: "../controladores/control.php",
                success: function (respuesta1) {
                    var tabla = "";
                    $.map(respuesta1, function (res) {
                        tabla += "<tr id=" + res.id_detalle + "><td>" + res.Actividad + "</td>";

                        if (respuesta.Lunes == 1) {
                            if (res.Lunes == 1) {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "LU' name='" + res.id_detalle + "LU' value='LU." + res.id_detalle + "' checked></td>";
                            } else {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "LU' name='" + res.id_detalle + "LU' value='LU." + res.id_detalle + "'></td>";
                            }
                        }

                        if (respuesta.Martes == 1) {
                            if (res.Martes == 1) {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "MA' name='" + res.id_detalle + "MA' value='MA." + res.id_detalle + "' checked></td>";
                            } else {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "MA' name='" + res.id_detalle + "MA' value='MA." + res.id_detalle + "'></td>";
                            }
                        }

                        if (respuesta.Miercoles == 1) {
                            if (res.Miercoles == 1) {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "MI' name='" + res.id_detalle + "MI' value='MI." + res.id_detalle + "' checked></td>";
                            } else {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "MI' name='" + res.id_detalle + "MI' value='MI." + res.id_detalle + "'></td>";
                            }
                        }

                        if (respuesta.Jueves == 1) {
                            if (res.Jueves == 1) {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "JU' name='" + res.id_detalle + "JU' value='JU." + res.id_detalle + "' checked></td>";
                            } else {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "JU' name='" + res.id_detalle + "JU' value='JU." + res.id_detalle + "'></td>";
                            }
                        }

                        if (respuesta.Viernes == 1) {
                            if (res.Viernes == 1) {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "VI' name='" + res.id_detalle + "VI' value='VI." + res.id_detalle + "' checked></td>";
                            } else {
                                tabla += "<td><input type='checkbox' id='" + res.id_detalle + "VI' name='" + res.id_detalle + "VI' value='VI." + res.id_detalle + "'></td>";
                            }
                        }
                        tabla += "</tr>";

                    });

                    $("#actividadesMantenimiento").empty().append(tabla);

                }
            });

        }
    });

    $.ajax({
        url: "../controladores/control.php",
        type: "POST",
        data: {
            action: 'obtenerEvidenciasMantenimiento',
            id: id
        },
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var table = "";
            $.map(respuesta, function (res) {
                if (res.extencion == 'jpg' || res.extencion == 'png') {
                    table += "<tr><td><img src=" + res.ruta + " width='100' height=100'></td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_evidencia + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.evidencia + "><span class='fas fa-download'></span></a></td></tr>";
                } else {
                    table += "<tr><td>" + res.evidencia + "</td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_evidencia + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.evidencia + "><span class='fas fa-download'></span></a></td></tr>";
                }
            });

            $("#evidenciasReporte").empty().append(table);

        }
    });


}

function obtenerDatosMantenimiento(id) {
    $.ajax({
        type: "POST",
        data: {
            action: "obtenerDatosMantenimiento",
            id: id
        },
        dataType: "json",
        url: "../controladores/control.php",
        success: function (respuesta) {
            console.log(respuesta);
            $("#fecha-inicio-edit").val(respuesta.fecha_inicial);
            $("#fecha-final-edit").val(respuesta.fecha_final);
            $("#id-edit").val(respuesta.id_mantenimiento);

            if (respuesta.Lunes == 1) {
                $("#ch-l-edit").prop("checked", true);
            }
            if (respuesta.Martes == 1) {
                $("#ch-m-edit").prop("checked", true);
            }
            if (respuesta.Miercoles == 1) {
                $("#ch-mi-edit").prop("checked", true);
            }
            if (respuesta.Jueves == 1) {
                $("#ch-j-edit").prop("checked", true);
            }
            if (respuesta.Viernes == 1) {
                $("#ch-v-edit").prop("checked", true);
            }

        }
    });

    $.ajax({
        type: "POST",
        data: {
            action: "obtenerActividadesMantenimiento",
            id: id
        },
        dataType: "json",
        url: "../controladores/control.php",
        success: function (respuesta) {
            console.log(respuesta);
            tabla = "";
            $.map(respuesta, function (res) {
                tabla += "<tr><td style='display:none;'>" + res.id_detalle + "</td><td contenteditable>" + res.Actividad + "</td><td><span class='btn btn-danger btn-sm' onclick='eliminarDetalleMantenimiento(" + res.id_detalle + ")' id='btn-del'><i class='fas fa-trash-alt'></i></span></td></tr>";


            })

            $("#ActividadesBody-edit").empty().append(tabla);
            $("#actividad-edit").val("")
        }
    });
}

function agregarActividadEdit() {
    var actividad = $("#actividad-edit").val();

    if (actividad == "") {
        alert("Favor de llenar el campo");
        return false;
    } else {
        tabla = "<tr style='background-color: rgb(215, 234, 217);'><td style='display:none;'>" + 0 + "</td><td>" + actividad + "</td><td><span class='btn btn-danger btn-sm' id='btn-del-sin'><i class='fas fa-trash-alt'></i></span></td></tr>";

        $("#ActividadesBody-edit").append(tabla);

        $("#actividad-edit").val("")
    }
}

function obtenerDiasTablaEdit() {

    arrayDias = [];

    if ($('#ch-l-edit').prop('checked')) {
        arrayDias.push('L')
    }
    if ($('#ch-m-edit').prop('checked')) {
        arrayDias.push('M')
    }
    if ($('#ch-mi-edit').prop('checked')) {
        arrayDias.push('MI')
    }
    if ($('#ch-j-edit').prop('checked')) {
        arrayDias.push('J')
    }
    if ($('#ch-v-edit').prop('checked')) {
        arrayDias.push('V')
    }

    return arrayDias;

}

function obtenerActividadesTablaEdit() {

    var listaActividades = [];

    $('#tablaActividades-edit tbody tr').each(function (result) {
        $(this).children("td").each(function (res2) {
            switch (res2) {
                case 0:
                    listaActividades.push($(this).text());
                    break;
                case 1:
                    listaActividades.push($(this).text());
                    break;
            }
        })
    });

    return listaActividades;
}

function editarMantenimiento() {

    var fechaInicial = $('#fecha-inicio-edit').val();
    var id = $('#id-edit').val();
    var fechaFinal = $('#fecha-final-edit').val();
    var arrayDias = obtenerDiasTablaEdit();
    var arrayActividades = obtenerActividadesTablaEdit();

    //Vlidaciones-----------_________------_--_--__--_-----_--_--_---_------__--_-__---_--___----__-

    var inicial = new Date(fechaInicial);
    var final = new Date(fechaFinal);
    var fecha1 = moment(fechaInicial);
    var fecha2 = moment(fechaFinal);

    if (fechaInicial == '' || fechaFinal == '') {
        alert("Falta un campo de fecha por llenar");
        return false;
    }
    if (arrayDias.length == 0) {
        alert("Tiene que seleccionar almenos un dia de la semana");
        return false;
    }
    if (arrayActividades.length == 0) {
        alert("Tiene que agregar almenos una actividad");
        return false;
    }
    if (inicial > final) {
        alert("La fecha inicial debe de ser menor a la fecha final");
        return false;
    }

    var diasDiferencia = fecha2.diff(fecha1, 'days') + 1;
    if (diasDiferencia < arrayDias.length) {
        alert("Los cantidad de dias no coincide con la fecha, agregue mas dias a la fecha final del registro");
        return false;
    }

    $.ajax({
        type: "POST",
        data: {
            tipoOperacion: 'editarRegistro',
            id: id,
            fechaInicial: fechaInicial,
            fechaFinal: fechaFinal,
            listaDias: JSON.stringify(arrayDias),
            listaActividades: JSON.stringify(arrayActividades)
        },
        url: "../controladores/ControlMantenimiento.php",
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("El registro se ha editado exitosamente", ":D", "success");
            }
        }
    });

}
/*

*/
function eliminarDetalleMantenimiento(id) {
    $("#tablaActividades-edit").on('click', '#btn-del', function () {

        swal({
            title: "¿Estas seguro de eliminar esta actividad?",
            text: "Esta actividad ya estaba registrada, si la elimina perdera el registro y su información",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parent().parent().remove();
                    $.ajax({
                        type: "POST",
                        data: { action: 'eliminarDetalleMantenimiento', id: id },
                        url: "../controladores/control.php",
                        success: function (respuesta) {
                            if (respuesta == 1) { } else {
                                console.log(respuesta);
                            }
                        }
                    });
                }
            });
    });
}

/*Seguimiento de reportes________________________________________________________________________________ */

function guardarSeguiminetoReporte() {
    var id = $('#id-seguimiento').val();
    var observaciones = $('#observaciones').val();

    var listLu = listaActividadesLu();
    var listMa = listaActividadesMa();
    var listMi = listaActividadesMi();
    var listJu = listaActividadesJu();
    var listVi = listaActividadesVi();

    $.ajax({
        url: "../controladores/ControlMantenimiento.php",
        type: "POST",
        data: {
            id: id,
            observaciones: observaciones,
            lunes: JSON.stringify(listLu),
            martes: JSON.stringify(listMa),
            miercoles: JSON.stringify(listMi),
            jueves: JSON.stringify(listJu),
            viernes: JSON.stringify(listVi),
            tipoOperacion: "editarSeguimiento"
        },
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta == 1) {
                swal("El reporte se ha guardado exitosamente", ":D", "success");
                $('#tablaReportes').load("vistasReportes/tablaReportes.php");
            } else {
                console.log(respuesta);
            }
        }


    })


}


function listaActividadesLu() {
    var listaSeguimiento = [];


    $('#tablaMantenimiento tbody tr input[type=checkbox]').each(function () {
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


    $('#tablaMantenimiento tbody tr input[type=checkbox]').each(function () {
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


    $('#tablaMantenimiento tbody tr input[type=checkbox]').each(function () {
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


    $('#tablaMantenimiento tbody tr input[type=checkbox]').each(function () {
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


    $('#tablaMantenimiento tbody tr input[type=checkbox]').each(function () {
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

/*Subida de evidencias________________________________________________________________________________ */
function crearEvidencias(id) {
    $('#idMantenimiento-evidencias').val(id);
}

function agregarEvidencia() {
    var formData = new FormData(document.getElementById('frmArchivosMantenimiento'));
    $.ajax({
        url: "../controladores/ControlEvidenciasMantenimiento.php",
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
                $('#frmArchivosMantenimiento')[0].reset();

                let preview = document.getElementById('card'),
                    image = document.getElementById('preview');

                image.src = "";

                preview.innerHTML = '';
                preview.append(image);

                $('#tablaReportes').load("vistasReportes/tablaReportes.php");
                $('.archivos').val("");
            } else if (respuesta == 2) {
                alert('Ya hay un archivo subido con este nombre');
            } else if (respuesta == 3) {
                alert('Tiene que seleccionar un archivo');
            } else if (respuesta == 4) {
                alert('Error al mover archivos, contacte al administrador');
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
                    url: "../controladores/ControlEvidenciasMantenimiento.php",
                    data: {
                        tipoOperacion: 'eliminarEvidencia',
                        id: id
                    },
                    success: function (respuesta) {
                        var id_mantenimiento = $('#id-seguimiento').val();
                        if (respuesta == 1) {
                            swal("Evidencia eliminada exitosamente", ":D", "success");

                            $.ajax({
                                url: "../controladores/control.php",
                                type: "POST",
                                data: {
                                    action: 'obtenerEvidenciasMantenimiento',
                                    id: id_mantenimiento
                                },
                                dataType: "json",
                                success: function (respuesta) {
                                    console.log(respuesta);
                                    var table = "";
                                    $.map(respuesta, function (res) {
                                        if (res.extencion == 'jpg' || res.extencion == 'png') {
                                            table += "<tr><td><img src=" + res.ruta + " width='100' height=100'></td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_evidencia + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.evidencia + "><span class='fas fa-download'></span></a></td></tr>";
                                        } else {
                                            table += "<tr><td>" + res.evidencia + "</td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_evidencia + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.evidencia + "><span class='fas fa-download'></span></a></td></tr>";
                                        }
                                    });

                                    $("#evidenciasReporte").empty().append(table);

                                }
                            });
                        } else {
                            swal("Error, contacte al administrador", ":C", "error");

                        }

                    }
                });
            }
        });
}

/*Eliminar mantenimiento__________________________________________________________________ */

function eliminarRegistroMantenimiento(id) {
    swal({
        title: "¿Estas seguro de eliminar este registro?",
        text: "Una vez eliminado no podra recuperarse",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "../controladores/ControlMantenimiento.php",
                    data: {
                        tipoOperacion: 'eliminarRegistro',
                        id: id
                    },
                    success: function (respuesta) {
                        alert("El registro ha sido eliminado exitosamente");
                        $('#tabla').load("vistasMantenimiento/tablaMantenimiento.php");
                    }
                });
            }
        });
}

function agregarActividadBitacora() {
    var actividad = $('#actividadBitacora').val();



    $.ajax({
        type: "POST",
        url: "../controladores/ControlMantenimiento.php",
        data: {
            tipoOperacion: 'agregarActividadBitacora',
            actividad: actividad
        },
        success: function (respuesta) {
            swal(respuesta, ":)", "success");
            $('#tablaActividades').load("vistasMantenimiento/tablaActividadesMantenimiento.php");
            $('.slcActividades').load("vistasMantenimiento/selectActividades.php");
            var actividad = $('#actividadBitacora').val("");
        }
    });
}

function eliminarActividadBitacora(id) {
    $.ajax({
        type: "POST",
        url: "../controladores/ControlMantenimiento.php",
        data: {
            tipoOperacion: 'eliminarActividadBitacora',
            id: id
        },
        success: function (respuesta) {
            swal(respuesta, ":)", "success");
            $('#tablaActividades').load("vistasMantenimiento/tablaActividadesMantenimiento.php");
            $('.slcActividades').load("vistasMantenimiento/selectActividades.php");
        }
    });
}

function agregarRegistroBitacra() {

    var encargado = $('#select-encargados').val();
    var fecha = $('#fecha').val();
    var hora = $('#hora').val();
    var actividad = $('#select-Actividad').val();
    var observaciones = $('#observaciones').val();

    $.ajax({
        type: "POST",
        url: "../controladores/ControlMantenimiento.php",
        data: {
            tipoOperacion: 'agregarRegistroBitacora',
            encargado: encargado,
            fecha: fecha,
            hora: hora,
            actividad: actividad,
            observaciones: observaciones
        },
        success: function (respuesta) {
            swal(respuesta, ":)", "success");
            $('#tabla').load("vistasMantenimiento/tablaBitacora.php");

            $('#select-encargados').val("");
            $('#fecha').val("");
            $('#hora').val("");
            $('#select-Actividad').val("");
            $('#observaciones').val("");
        }
    });

}


function obtenerDatosRegistroBitacora(id) {
    obtenerEvidenciasRegistroMantenimineto(id);

    $.ajax({
        type: "POST",
        url: "../controladores/control.php",
        data: {
            action: 'obtenerDatosRegistroBitacora',
            id: id
        },
        dataType: 'json',
        success: function (respuesta) {
            $('#select-encargados-edit').val(respuesta.id_encargado);
            $('#fecha-edit').val(respuesta.fecha);
            $('#hora-edit').val(respuesta.hora);
            $('#select-Actividad-edit').val(respuesta.id_actividad);
            $('#observaciones-edit').val(respuesta.observaciones);
            $('#id_edit').val(respuesta.id_registro);
        }
    });
}

function editarRegistrosBitacora() {
    var encargado = $('#select-encargados-edit').val();
    var id = $('#id_edit').val();
    var fecha = $('#fecha-edit').val();
    var hora = $('#hora-edit').val();
    var actividad = $('#select-Actividad-edit').val();
    var observaciones = $('#observaciones-edit').val();

    $.ajax({
        type: "POST",
        url: "../controladores/control.php",
        data: {
            action: 'editarRegistroBitacora',
            id: id,
            encargado: encargado,
            fecha: fecha,
            hora: hora,
            actividad: actividad,
            observaciones: observaciones
        },
        success: function (respuesta) {
            swal(respuesta, ":)", "success");
            $('#tabla').load("vistasMantenimiento/tablaBitacora.php");

        }
    });


}

function eliminarRergistroBitacora(id) {
    swal({
        title: "¿Esta seguro de eliminar este registro?",
        text: "Una vez eliminado no podra recuperarse",
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
                        action: 'eliminarRegistrosBitacora',
                        id: id,
                    },
                    success: function (respuesta) {
                        swal(respuesta, ":)", "success");
                        $('#tabla').load("vistasMantenimiento/tablaBitacora.php");

                    }
                });
            }
        });
}



function subirEvidenciasReportes() {
    var formData = new FormData(document.getElementById('frmArchivosReporte'));
    $.ajax({
        url: "../controladores/controlEvidenciasBitacora.php",
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

function verInfoRegistroBitacora(id) {
    $.ajax({
        type: "POST",
        url: "../controladores/control.php",
        data: {
            action: 'verRegistroBitacora',
            id: id,
        },
        dataType: 'json',
        success: function (respuesta) {
            $("#select-encargados-view").val(respuesta.id_encargado)
            $('#fecha-view').val(respuesta.fecha);
            $('#hora-view').val(respuesta.hora);
            $('#select-Actividad-view').val(respuesta.id_actividad);
            $('#observaciones-view').val(respuesta.observaciones);



        }
    });

    $.ajax({
        type: "POST",
        url: "../controladores/control.php",
        data: {
            action: 'verEvidenciasBitacora',
            id: id,
        },
        dataType: 'json',
        success: function (respuesta) {
            console.log(respuesta);
            var elementos = "";
            $.map(respuesta, (res) => {
                if (elementos == "") {
                    elementos += " <div class='carousel-item active'><img class='d-block w-100' style='border-radius:20px !important;' src='" + res.ruta + "' alt='First slide'></div>";
                } else {
                    elementos += " <div class='carousel-item '><img class='d-block w-100' src='" + res.ruta + "' style='border-radius:20px !important;' alt='First slide'></div>";
                }

            });

            $('.ContenedorImagenes').empty().append(elementos);


        }
    });
}

function obtenerEvidenciasRegistroMantenimineto(id) {
    $.ajax({
        url: "../controladores/control.php",
        type: "POST",
        data: {
            action: 'verEvidenciasBitacora',
            id: id
        },
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var table = "";
            $.map(respuesta, function (res) {
                if (res.extencion == 'jpg' || res.extencion == 'jpeg' || res.extencion == 'png') {
                    table += "<tr><td><img src=" + res.ruta + " width='100' height=100'></td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_evidencia + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.evidencia + "><span class='fas fa-download'></span></a></td></tr>";
                } else {
                    table += "<tr><td>" + res.nombre + "</td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_evidencia + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.evidencia + "><span class='fas fa-download'></span></a></td></tr>";
                }
            });

            $("#evidenciasReporte").empty().append(table);

        }

    })
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
                    url: "../controladores/controlEvidenciasBitacora.php",
                    data: {
                        tipoOperacion: 'eliminarEvidencia',
                        id: id
                    },
                    success: function (respuesta) {
                        if (respuesta == 1) {

                            var idReporte = $("#id_edit").val();
                            $.ajax({
                                url: "../controladores/control.php",
                                type: "POST",
                                data: {
                                    action: 'verEvidenciasBitacora',
                                    id: idReporte
                                },
                                dataType: "json",
                                success: function (respuesta) {
                                    console.log(respuesta);
                                    var table = "";
                                    $.map(respuesta, function (res) {
                                        //table += "<tr><td><img src=" + res.ruta + " width='100' height=100'></td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_archivo + ")'><span class='fas fa-trash'></span></span></td><td><a href=" + res.ruta + " download=" + res.nom + ">asda<span class='fas fa-download'></span></a></td></tr>";
                                        if (res.extencion == 'jpg' || res.extencion == 'jpeg' || res.extencion == 'png') {
                                            table += "<tr><td><img src=" + res.ruta + " width='100' height=100'></td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_evidencia + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.evidencia + "><span class='fas fa-download'></span></a></td></tr>";
                                        } else {
                                            table += "<tr><td>" + res.evidencia + "</td><td><span class='btn btn-danger' onclick='eliminarEvidencia(" + res.id_evidencia + ")'><span class='fas fa-trash'></span></span></td><td><a class='btn btn-success' href=" + res.ruta + " download=" + res.evidencia + "><span class='fas fa-download'></span></a></td></tr>";
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

function agregarEncargadoMantenimiento() {
    var nom = $('#nomEncargadoMantenimiento').val();

    $.ajax({
        type: "POST",
        url: "../controladores/control.php",
        data: {
            action: 'agregarEncargadoMantenimiento',
            nom: nom,
        },
        success: function (respuesta) {
            swal(respuesta, ":)", "success");
            $('#tablaEncargados').load("vistasMantenimiento/tablaEncargadosmantenimiento.php");
            $('.slcEncargados').load("vistasMantenimiento/selectEncargados.php");
            $('#nomEncargadoMantenimiento').val("");
        }
    });
}


function eliminarEncargadoMantenimiento(id) {
    console.log(id);
    swal({
        title: "¿Estas seguro de eliminar este registro?",
        text: "Una vez eliminado no podras recuperarlo",
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
                        action: 'eliminarEncargadoMantenimiento',
                        id: id,
                    },
                    success: function (respuesta) {
                        swal(respuesta, ":)", "success");
                        $('#tablaEncargados').load("vistasMantenimiento/tablaEncargadosmantenimiento.php");
                    }
                });

            } else {

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
            action: 'cambiarCalificacionRegistro',
            id: id[1],
            cal: myRadio.value
        },
        success: function (respuesta) {


        }
    });
}