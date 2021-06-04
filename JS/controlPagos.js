function crearTotal() {
    var fechaInicial = $('#fechaInicial').val();
    var fechaFinal = $('#fechaFinal').val();

    $.ajax({
        type: "POST",
        data: {
            action: 'crearTotalPagos',
            fechaInicial: fechaInicial,
            fechaFinal: fechaFinal,
        },
        dataType: "json",
        url: "../controladores/control.php",
        success: function (respuesta) {
            var tabla = "";
            var total = 0;
            $.map(respuesta, function (res) {
                tabla += "<tr><td>" + res.nombre + "</td><td>" + res.fecha_pago + "</td><td>$" + res.total + "</td></tr>";
                total += parseInt(res.total);
            })

            tabla += "<tr><td></td><td></td><td></td></tr>";
            tabla += "<tr><td></td><td>Total: </td><td>$" + total + "</td></tr>";

            console.log(total);

            $("#bodyTablaPagos").empty().append(tabla);

        }
    });
}

function crearPDF() {
    var fechaInicial = $('#fechaInicial').val();
    var fechaFinal = $('#fechaFinal').val();

    $.ajax({
        type: "POST",
        data: {
            fechaInicial: fechaInicial,
            fechaFinal: fechaFinal,
        },
        dataType: "html",
        url: "../controladores/reportePagosPHP.php",
    }).done(function (resultado) {
        console.log(resultado);

        window.open("../controladores/reporte.pdf", "_blank");
    });
}

function obtenerTotalAdeudos(id) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerTotalAdeudos', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (res) {

            console.log(res);
            $("#idUsuario").val(id);
            tabla = "<tr><td>" + res.dias + "</td><td>$" + res.total + "</td></tr>";


            $("#registroPagosTotal").empty().append(tabla);

        }
    });
}

function pagoPendientes() {
    var id = $("#idUsuario").val();
    var dias = $("#DiasPago").val();

    swal({
        title: "Se cobrara el adeudo de: " + dias,
        text: "Total de cobro: " + (dias * 50),
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { action: 'pagarAdeudos', dias: dias, id: id },
                    url: "../controladores/control.php",
                    success: function (respuesta) {
                        console.log(respuesta);
                        //obtenerTotalAdeudos(id);
                    }
                });


            }
        });
}

function obtenerDatosPagosPendientes(id) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosPagosPendientes', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

            tabla = "";

            $.map(respuesta, function (res) {
                tabla += "<tr><td>" + res.fecha_servicio + "</td><td>$" + res.monto + "</td><td>" + res.estatus + "</td></tr>";
            })

            $("#pagosPendientesCocina").empty().append(tabla);

        }
    });
}
