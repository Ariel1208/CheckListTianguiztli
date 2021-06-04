function agregarRegistrosTablaMenu() {
    var idPlatillo_desayuno = $('#selectPlatillos-desayunos').val();
    var idPlatillo_comida = $('#selectPlatillos-comidas').val();
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosPlatillo', idDesayuno: idPlatillo_desayuno, idComida: idPlatillo_comida },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            var registro = "";
            $.map(respuesta, function(res) {
                if (res.tipo_platillo == 1) {
                    registro += "<tr><td style='display:none;'>" + res.id_platillo + "</td><td style='display:none;'>1</td><td>" + res.nombre_platillo + "</td><td>DESAYUNO</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";
                } else if (res.tipo_platillo == 2) {
                    registro += "<tr><td style='display:none;'>" + res.id_platillo + "</td><td style='display:none;'>2</td><td>" + res.nombre_platillo + "</td><td>COMIDA</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";
                }
            })


            $('#registrosMenu').append(registro);
        }
    });
}

function agregarRegistrosTablaMenuEdit() {
    var idPlatillo = $('#selectPlatillos-edit').val();
    var idTipo = $('#selectTipo-edit').val();
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosPlatilloEdit', id: idPlatillo },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            if (idTipo == 1) {
                var registro = "<tr><td style='display:none;'>" + respuesta.id_platillo + "</td><td style='display:none;'>1</td><td>" + respuesta.nombre_platillo + "</td><td>DESAYUNO</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";
            } else if (idTipo == 2) {
                var registro = "<tr><td style='display:none;'>" + respuesta.id_platillo + "</td><td style='display:none;'>2</td><td>" + respuesta.nombre_platillo + "</td><td>COMIDA</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";
            }

            $('#registrosMenu-edit').append(registro);
        }
    });
}

function publicarMenu() {
    var array = listaPlatillos();
    var listaDesayuno = [];
    var listaComida = [];

    for (let index = 0; index < array.length; index += 2) {
        if (array[index + 1] == 1) {
            listaDesayuno.push(array[index]);
        } else if (array[index + 1] == 2) {
            listaComida.push(array[index]);
        }
    }

    if (listaDesayuno.length == 0) {
        listaDesayuno.push('sin');
    }

    if (listaComida.length == 0) {
        listaComida.push('sin');
    }

    if (listaDesayuno[0] == "sin" && listaComida[0] == "sin") {
        alert("No se puede crear un menu vacio");
        return false;
    }
    var fecha = $('#fechaSeguimiento').val();

    if (fecha == "") {
        alert("Es necesario llenar todos los campos");
        return false;
    }

    $.ajax({
        type: "POST",
        data: {
            tipoOperacion: 'publicarMenu',
            listaComida: JSON.stringify(listaComida),
            listaDesayuno: JSON.stringify(listaDesayuno),
            fecha: fecha
        },
        url: "../controladores/ControlMenus.php",
        success: function(respuesta) {
            switch (respuesta) {
                case '1':
                    alert("Menu publicado exitosamente");
                    $('#tabla').load("vistasMenu/tablaMenus.php");
                    $('#registrosMenu').empty();
                    $('#fechaSeguimiento').val("YYYY-MM-DD");
                    break;
                case '2':
                    alert("La fecha no es valida, intente con la fecha actual o mayor");
                    break;
                case '3':
                    alert("Ya hay una publicación con esta fecha");
                    break;
                default:
                    console.log(respuesta);
                    break;
            }
        }
    });
}

function listaPlatillos() {

    var listaMenu = [];
    $('#tablaMenu tbody tr').each(function(result) {
        $(this).children("td").each(function(res2) {
            switch (res2) {
                case 1:
                    listaMenu.push($(this).text());
                    break;
                case 0:
                    listaMenu.push($(this).text());
                    break;
            }
        })
    })

    return listaMenu;

}
/*----------------EDICION DE MENUS------------------------------- */

function obtenerDatosMenu(id) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosMenu', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            $('#id-edit').val(respuesta.id_menu);
            $('#fechaSeguimiento-edit').val(respuesta.fecha_seguimiento);
        }
    });

    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosDetalleMenu', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            var tabla = "";
            $.map(respuesta, (res) => {
                if (res.tipo == 1) {
                    tabla += "<tr><td style='display:none;'>" + res.id_platillo + "</td><td style='display:none;'>" + res.tipo + "</td><td>" + res.nombre_platillo + "</td><td>DESAYUNO</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";
                } else if (res.tipo == 2) {
                    tabla += "<tr><td style='display:none;'>" + res.id_platillo + "</td><td style='display:none;'>" + res.tipo + "</td><td>" + res.nombre_platillo + "</td><td>COMIDA</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";
                }
            });

            $('#registrosMenu-edit').empty().append(tabla);
        }
    });
}

function editarMenu() {
    var array = listaPlatillosEdit();
    var listaDesayuno = [];
    var listaComida = [];
    var id = $('#id-edit').val();

    for (let index = 0; index < array.length; index += 2) {
        if (array[index + 1] == 1) {
            listaDesayuno.push(array[index]);
        } else if (array[index + 1] == 2) {
            listaComida.push(array[index]);
        }
    }

    if (listaDesayuno.length == 0) {
        listaDesayuno.push('sin');
    }

    if (listaComida.length == 0) {
        listaComida.push('sin');
    }

    if (listaDesayuno[0] == "sin" && listaComida[0] == "sin") {
        alert("No se puede crear un menu vacio");
        return false;
    }
    var fecha = $('#fechaSeguimiento-edit').val();

    if (fecha == "") {
        alert("Es necesario llenar todos los campos");
        return false;
    }
    if (id == "") {
        alert("Error de sistema");
        return false;
    }

    $.ajax({
        type: "POST",
        data: {
            tipoOperacion: 'editarMenu',
            listaComida: JSON.stringify(listaComida),
            listaDesayuno: JSON.stringify(listaDesayuno),
            fecha: fecha,
            id: id
        },
        url: "../controladores/ControlMenus.php",
        success: function(respuesta) {
            switch (respuesta) {
                case '1':
                    alert("Menu publicado exitosamente");
                    break;
                case '2':
                    alert("La fecha no es valida, intente con la fecha actual o mayor");
                    break;
                case '3':
                    alert("Ya hay una publicación con esta fecha");
                    break;
                default:
                    console.log(respuesta);
                    break;
            }
        }
    });
}

function listaPlatillosEdit() {

    var listaMenu = [];
    $('#tablaMenu-edit tbody tr').each(function(result) {
        $(this).children("td").each(function(res2) {
            switch (res2) {
                case 1:
                    listaMenu.push($(this).text());
                    break;
                case 0:
                    listaMenu.push($(this).text());
                    break;
            }
        })
    })

    return listaMenu;
}

/*---------______-------____-----__--_--_--_--_-__--_-__--_-__------___--_-_---_---_-Eliminar menus */

function eliminarMenu(id) {
    swal({
            title: "¿Estas seguro de eliminar este menu?",
            text: "Una vez eliminado no podra recuperarse",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { action: 'eliminarMenu', id: id },
                    url: "../controladores/control.php",
                    success: function(respuesta) {
                        if (respuesta == 0) {
                            alert("No es posible eliminar este sector debido a que hay reportes del mismo");
                            $('#tablaPlantillas').load("vistasPlantillas/tablaPlantillas.php");
                        } else if (respuesta == 1) {
                            alert("Menu eliminado correctamente");
                            $('#tabla').load("vistasMenu/tablaMenus.php");
                        } else {
                            console.log(respuesta);
                        }
                    }
                });
            }
        });
}