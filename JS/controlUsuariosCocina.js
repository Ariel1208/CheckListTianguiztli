function llenarLocalData(){
    $.ajax({
        type: "POST",
        data: { action: 'traerDatosUsuarios' },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta);
            if(respuesta != ""){
                localStorage.setItem('infoUsers', JSON.stringify(respuesta))
                console.log("Items Actualozados");
               
                var DATA = localStorage.getItem('infoUsers');
                datosUsuarios = JSON.parse(DATA);
            
                console.log(datosUsuarios.length);
                
                var table = $('#myTable').DataTable({
                    paging: true,
                    searching: true,
                    info: false,
                    data: datosUsuarios,
                    
                    columns: [
                      { title: "Nombre", data: "nombre"},
                        {title: "Correo", data: "correo" },
                        {title: "ID", data: "id_usuario" ,visible: false, searchable: false}

                    ]
                  });
            }
        }
    });
}

function abrirModalPagoGeneral(){
    $("#myTable").dataTable().fnDestroy();
    llenarLocalData();
    $('#modalPagoGeneral').modal('show');
}

function generarRegistroPago(){
    var table = $('#myTable').DataTable();
    var datos = table.rows('.selected').data();

    var fechaIn = Date.parse($("#fechaInG").val());
    var fecha1 = $("#fechaInG").val();
    var fechaF = Date.parse($("#fechaFiG").val());
    var fecha2 = $("#fechaFiG").val();
   // var tipOperacion = $("#tipOperacionG").val();

    let fech = new Date(fechaIn);
    let fech1 = new Date(fechaF);

    var array = [];
    var nombres =[];

    $.map(datos,(e)=>{
        array.push(e.id_usuario);
        nombres.push(e.nombre);
    });

    if(array.length == 0)
        return alert("No se han seleccionado platillos")

    let dias = ["L", "Ma", "Mi", "J", "V", "S", "D"];

    if (fech > fech1) {
        swal({
            title: 'La fecha inicial tiene que ser menor a la fecha final del registro',
            icon: 'error',
            timer: 10000,
            buttons: false,
        })
        return false;
    }

    fech1.setDate(fech1.getDate() + 1);
    var diasHabiles = 0;

    for (var i = fech; i < fech1; i.setDate(i.getDate() + 1)) {
        let dia = dias[i.getDay()];
        if (dia == "S" || dia == "D") {
            diasHabiles--;

        }
        diasHabiles++;
    };

    var total = diasHabiles * 50;
    if (fechaIn == "" || fechaFi == "") {
        alert("Se deben llenar todos los campos");
        return false;
    }

    var totalGeneral = total*array.length;
    swal({
        title: "El monto es de: $" + total,
        text: "Con disponibilidad de servicio durante: " + diasHabiles + " días. El total a cobrar es de: $" + totalGeneral,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { action: 'agregarRegistroPagoGeneral',  array: JSON.stringify(array), fechaI: fecha1, fechaF: fecha2, dias: diasHabiles, total: total },
                    url: "../controladores/control.php",
                    success: function (respuesta) {
                        if (respuesta == 1) {
                            alert("Pago registrado exitosamente");
                            $('#modalPagoGeneral').modal('hide');
                        } else {
                            console.log(respuesta);
                        }
                    }
                });
            }
        });

}

function agregarUsuario() {
    var formData = new FormData(document.getElementById('frmDataUsuarios'));

    $.ajax({
        url: "../controladores/controlImagenesUsuarios.php",
        type: "POST",
        datatype: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta == 1) {
                //alert("Usuario agregado exitosamente");
                swal({
                    title: 'Usuario agregado exitosamente',
                    icon: 'success',
                    timer: 800,
                    buttons: false,
                })
                document.getElementById("frmDataUsuarios").reset();
                $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");
            } else if (respuesta == 2) {
                //alert("Este usuario ya fue agregado");
                swal({
                    title: 'Este usuario ya fue agregado',
                    icon: 'warning',
                    timer: 800,
                    buttons: false,
                })
            } else {
                //alert("Error de sistema");
                swal({
                    title: 'Usuario agregado exitosamente',
                    icon: 'success',
                    timer: 800,
                    buttons: false,
                })
                document.getElementById("frmDataUsuarios").reset();
                $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");
            }
        }
    });
}

function obtenerDatosUsuario(id) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosUsuarioCocina', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            $('#edit-id').val(respuesta.id_usuario);
            $('#edit-nombre').val(respuesta.nombre);
            $('#edit-correo').val(respuesta.correo);
            $('#edit-pass').val(respuesta.contrasena);
            $('#tipoUsuario-edit').val(respuesta.id_tipo);
        }
    });
}

function editarUsuario() {
    var nombre = $('#edit-nombre').val();
    var correo = $('#edit-correo').val();
    var pass = $('#edit-pass').val();
    var id = $('#edit-id').val();
    var tipo = $('#tipoUsuario-edit').val();

    if (nombre == "" || correo == "" || pass == "") {
        //alert("Favor de llenar todos los campos");
        swal({
            title: 'Favor de llenar todos los campos',
            icon: 'warning',
            timer: 800,
            buttons: false,
        })
    } else if (id == "") {
        //alert("Error de sistema");
        swal({
            title: 'Error de sistema',
            icon: 'error',
            timer: 800,
            buttons: false,
        })
    }

    $.ajax({
        type: "POST",
        data: { action: 'editarUsuarioscCocina', nombre: nombre, correo: correo, pass: pass, id: id, tipo: tipo },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            if (respuesta == 1) {
                //alert("Usuario agregado exitosamente");
                swal({
                    title: 'Usuario agregado exitosamente',
                    icon: 'success',
                    timer: 800,
                    buttons: false,
                })
            } else if (respuesta == 2) {
                //alert("Este usuario ya fue agregado");
                swal({
                    title: 'Este usuario ya fue agregado',
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

function eliminarUsuario(idUsuario) {

    swal({
        title: "¿Estas seguro de eliminar este usuario?",
        text: "Una vez eliminado no podra recuperarse",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { action: 'eliminarUsuarioscCocina', id: idUsuario },
                    url: "../controladores/control.php",
                    success: function (respuesta) {
                        if (respuesta == 1) {
                            alert("Usuario eliminado exitosamente");
                            $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");
                        } else {
                            alert("Error de sistema");
                        }

                    }
                });
            }
        });


}

function abrirModalRegistroPagoUsuario(id) {

    $("#idUsuario").val(id);
    $('#modalRegistroPagos').modal('show');

    /*   $.ajax({
           type: "POST",
           data: { action: 'validacionModalFechas', id: id },
           url: "../controladores/control.php",
           dataType: "json",
           success: function(respuesta) {
               var date = new Date();
               var date2 = new Date(respuesta.fecha_final);


               if (date2 <= date) {
                   $("#idUsuario").val(id);
                   $('#modalRegistroPagos').modal('show');
                   $("#fechaIn").prop("disabled", false);
                   $("#tipOperacion").val(1);

               } else if (date2 > date) {

                   let day = date2.getDate() + 2;
                   let month = date2.getMonth() + 1;
                   let year = date2.getFullYear();
                   var fecha = "";
                   if (day < 10) {
                       fecha = year + "-" + month + "-0" + day;
                   } else if (day > 9) {
                       fecha = year + "-" + month + "-" + day;
                   }
                   $("#fechaIn").val(fecha);
                   $("#fechaFi").val(fecha);
                   $("#fechaIn").prop("disabled", true);
                   $("#idUsuario").val(id);
                   $('#modalRegistroPagos').modal('show');
                   $("#tipOperacion").val(2);

               } else if (respuesta == false) {
                   $('#modalRegistroPagos').modal('show');
                   $("#fechaIn").prop("disabled", false);
                   $("#idUsuario").val(id);
                   $("#tipOperacion").val(1);
               }

           }
       });*/
}

function agregarPagoCocina() {

    let dias = ["L", "Ma", "Mi", "J", "V", "S", "D"];
    var id = $("#idUsuario").val();
    var fechaIn = Date.parse($("#fechaIn").val());
    var fecha1 = $("#fechaIn").val();
    var fechaF = Date.parse($("#fechaFi").val());
    var fecha2 = $("#fechaFi").val();
    var tipOperacion = $("#tipOperacion").val();

    let fech = new Date(fechaIn);
    let fech1 = new Date(fechaF);


    if (fech > fech1) {
        swal({
            title: 'La fecha inicial tiene que ser menor a la fecha final del registro',
            icon: 'error',
            timer: 10000,
            buttons: false,
        })
        return false;
    }

    fech1.setDate(fech1.getDate() + 1);
    var diasHabiles = 0;

    for (var i = fech; i < fech1; i.setDate(i.getDate() + 1)) {
        let dia = dias[i.getDay()];
        if (dia == "S" || dia == "D") {
            diasHabiles--;

        }
        diasHabiles++;
    };

    var total = diasHabiles * 50;
    if (fechaIn == "" || fechaFi == "" || id == "") {
        alert("Se deben llenar todos los campos");
        return false;
    }
    swal({
        title: "El monto total es de: $" + total,
        text: "Con disponibilidad de servicio durante: " + diasHabiles + " Días",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { action: 'agregarRegistroPago', id: id, fechaI: fecha1, fechaF: fecha2, dias: diasHabiles, total: total },
                    url: "../controladores/control.php",
                    success: function (respuesta) {
                        if (respuesta == 1) {
                            alert("Pago registrado exitosamente");
                            $('#modalRegistroPagos').modal('hide');
                        } else {
                            console.log(respuesta);
                        }
                    }
                });
            }
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

            tabla = "<tr><td>" + res.dias + "</td><td>$" + res.total + "</td></tr>";


            $("#registroPagosTotal").empty().append(tabla);

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
            
            $('#tablaAdeudos').DataTable({
                pageLength: 5,
                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
            });

        }
    });
}

function obtenerDatosPagos(id) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosPagos', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function (respuesta) {
            tabla = "";

            $.map(respuesta, function (res) {
                tabla += "<tr><td>" + res.fecha_pago + "</td><td>" + res.fecha_inicial + "</td><td>" + res.fecha_final + "</td><td>" + res.dias_pagados + "</td><td>$" + res.total + "</td></tr>";
            })

            table = $('#demoApi').DataTable();
            $("#pagosCocina").empty().append(tabla);
          
        }
    });


    /*
        $.ajax({
            type: "POST",
            data: { action: 'obtenerDatosSeguimientoServicio', id: id },
            url: "../controladores/control.php",
            dataType: "json",
            success: function(respuesta) {

                let dias = ["L", "Ma", "Mi", "J", "V", "S", "D"];

                let fech = new Date();
                let day = fech.getDate();
                let month = fech.getMonth() + 1;
                let year = fech.getFullYear();

                let fech1 = new Date();
                let day1 = fech1.getDate() - 1;
                let month1 = fech1.getMonth() + 1;
                let year1 = fech1.getFullYear();

                let fech2 = new Date(respuesta.fecha_final);
                let day2 = fech2.getDate() + 1;
                let month2 = fech2.getMonth() + 1;
                let year2 = fech2.getFullYear();

                let fech3 = new Date(respuesta.fecha_inicial);
                let day3 = fech3.getDate() + 1;
                let month3 = fech3.getMonth() + 1;
                let year3 = fech3.getFullYear();

                let dateHoy = new Date(year + "-0" + month + "-" + day);
                let date = new Date(year1 + "-0" + month1 + "-" + day1);
                let date3 = new Date(year2 + "-0" + month2 + "-" + day2);
                let date2 = new Date(year3 + "-0" + month3 + "-" + day3);

                if (dateHoy.getTime() == date3.getTime()) {
                    $('#diasRestantes').val(1);
                } else if (dateHoy >= date2 && dateHoy < date3) {
                    var diasHabiles = 0;

                    for (var i = date; i < date3; i.setDate(i.getDate() + 1)) {
                        let dia = dias[i.getDay()];

                        if (dia == "S" || dia == "D") {
                            diasHabiles--;
                        }
                        diasHabiles++;
                    }

                    $('#diasRestantes').val(diasHabiles);
                } else if (dateHoy > date3) {
                    $('#diasRestantes').val("SIN DERECHO A SERVICIO");
                } else if (dateHoy < date2) {
                    $('#diasRestantes').val("EL SERVICIO INICIA EL: " + respuesta.fecha_inicial);
                } else {
                    $('#diasRestantes').val("NO SE HAN REGISTRADO PAGOS DE ESTE USUARIO");
                }
            }

        });*/
}

function actualizarFotoUsuario() {
    var formData = new FormData(document.getElementById('frmUpFoto'));

    $.ajax({
        url: "../controladores/controlImagenesUsuarios.php",
        type: "POST",
        datatype: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta == 'error1') {
                alert("No se a detectado ningun archivo");

            }
        }
    });
}

function obtenerid(id) {
    $('#idFoto').val(id);
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
                        obtenerTotalAdeudos(id);
                        $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");
                        swal("Pago registrado exitosamente", "", "success");
                        $("#DiasPago").val("");
                    }
                });


            }
        });
}

function registrarAdeudo() {
    let dias = ["L", "Ma", "Mi", "J", "V", "S", "D"];
    let dias2 = ["D", "L", "Ma", "Mi", "J", "V", "D"];
    var id = $("#idUsuarioAdeudo").val();
    var fechaIn = Date.parse($("#fechaInAdeudo").val());
    var fechaF = Date.parse($("#fechaFiAdeudo").val());


    let fech = new Date(fechaIn);
    let fech1 = new Date(fechaF);

    let fechReg = new Date(fechaIn);
    let fechReg2 = new Date(fechaF);
    
    fechReg.setDate(fech.getDate() + 1);
    fechReg2.setDate(fech1.getDate() + 2);
  
   

    if (fech > fech1) {
        swal({
            title: 'La fecha inicial tiene que ser menor a la fecha final del registro',
            icon: 'error',
            timer: 10000,
            buttons: false,
        })
        return false;
    }

    var fechas = [];

    fech1.setDate(fech1.getDate() + 1);
    var diasHabiles = 0;
    
    for (var i = fechReg; i < fechReg2; i.setDate(i.getDate() + 1)) {
        let dia = dias2[i.getDay()];
        if (dia == "S" || dia == "D") {
        } else {
              var str = i.getFullYear()+"/0"+(i.getMonth()+1) + "/" + (i.getDate()); 
              fechas.push(str);

        }
    
    };

    for (var i = fech; i < fech1; i.setDate(i.getDate() + 1)) {
        let dia = dias[i.getDay()];
        if (dia == "S" || dia == "D") {
            diasHabiles--;
        } else {
        
         //    var str = i.getFullYear()+"/0"+(i.getMonth()+1) + "/" + (i.getDate()); 
           //  fechas.push(str);

        }
        diasHabiles++;
    };

    

    var total = diasHabiles * 50;
    if (fechaIn == "" || fechaFi == "" || id == "") {
        alert("Se deben llenar todos los campos");
        return false;
    }

    console.log(fechas);
    swal({
        title: "El monto total es de: $" + total,
        text: "Con disponibilidad de servicio durante: " + diasHabiles + " Días",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                  $.ajax({
                       type: "POST",
                       data: { action: 'agregarRegistrosAdeudos', id: id, fechas:fechas },
                       url: "../controladores/control.php",
                       success: function (respuesta) {
                          
                            console.log(respuesta);
                               swal("Registrado agregado", "Se han registrado los dias de adeudo de este usuario", "success");
                               $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");
                               $('#modalRegistroPagos').modal('hide');
                               $("#fechaInAdeudo").val("");
                               $("#fechaFiAdeudo").val("");
    
                    
                       }
                   });
            }
        });
}