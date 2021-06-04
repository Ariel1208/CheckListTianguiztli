function iniciarSesionControlador() {
    var user = $('#user').val();
    var password = $('#pass').val();

    if (user != "" && password != "") {
        $.ajax({
            type: 'POST',
            url: "controladores/control.php",
            data: { action: 'login', user: user, password: password },
            dataType: "json",
            success: function(response) {
               
                if (response == 1) {
                    // alert("Usuario no existente");
                    swal({
                        title: "Usuario no existente",
                        text: "Este usuario no se ha registrado",
                        icon: "error",
                        dangerMode: true,
                    })
                } else if (response == 2) {
                    //alert("Usuario o contraseña invalido");
                    swal({
                        title: "Usuario o contraseña invalido",
                        text: "Compruebe haber ingresado correctamente el usuario",
                        icon: "warning",
                        dangerMode: true,
                    })
                } else {
                    if (response.id_rol == 1) {
                        localStorage.session = 1;
                        localStorage.uid = response.id_usuario;
                        localStorage.nombre = response.nombre;

                        //alert("Bienvenido administrador");
                        swal({
                            title: 'Bienvenido Administrador',
                            text: 'Redirigiendo...',
                            icon: 'success',
                            timer: 800,
                            buttons: false,
                        })
                        .then(() => {
                            location.href = "vistasAdministrador/UsuariosAdministradores.php";
                        })
                    } else if (response.id_rol == 2) {
                        localStorage.session = 1;
                        localStorage.uid = response.id_usuario;
                        localStorage.nombre = response.nombre;

                        //alert("Bienvenido");
                        swal({
                            title: 'Bienvenido Usuario',
                            text: 'Redirigiendo...',
                            icon: 'success',
                            timer: 800,
                            buttons: false,
                        })
                        .then(() => {
                            location.href = "vistasUsuarios/inicio.php";
                        })
                    } else if (response.id_rol == 3) {
                        localStorage.session = 1;
                        localStorage.uid = response.id_usuario;
                        localStorage.nombre = response.nombre;

                        //alert("Bienvenido");
                        swal({
                            title: 'Bienvenido Cocinero',
                            text: 'Redirigiendo...',
                            icon: 'success',
                            timer: 800,
                            buttons: false,
                        })
                        .then(() => {
                            location.href = "vistasCocinero/inicio.php";
                        })
                    } else if (response.id_rol == 4) {
                        localStorage.session = 1;
                        localStorage.uid = response.id_usuario;
                        localStorage.nombre = response.nombre;

                        //alert("Bienvenido");
                        swal({
                            title: 'Bienvenido',
                            text: 'Redirigiendo...',
                            icon: 'success',
                            timer: 800,
                            buttons: false,
                        })
                        .then(() => {
                            location.href = "vistasEncargadoPagosCocina/inicio.php";
                        })
                    }


                }
            },
            error: function(xhr) {
                console.log(response);
            }
        });
    } else {
        alert("Lo sentimos, todos los campos son obligatorios!");
    }
}

function cerrarSesion() {
    $.ajax({
        type: 'POST',
        url: "../controladores/control.php",
        data: { action: 'salir' },
        dataType: "json",
        success: function(response) {

            if (response == 1) {
                location.href = "../index.php";
                localStorage.clear();
            }

        },
        error: function(xhr) {
            console.log(xhr);
            alert();
        }
    });
}

function iniciarSesionUsuarioCocina() {
    var user = $('#user').val();
    var password = $('#pass').val();

    if (user != "" && password != "") {
        $.ajax({
            type: 'POST',
            url: "controladores/control.php",
            data: { action: 'loginUsuarios', user: user, password: password },
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response == 1) {
                    alert("Usuario no existente");
                } else if (response == 2) {
                    alert("Usuario o contraseña invalido");
                } else if (response == 7) {
                    alert("Bienvenido Usuario");

                    location.href = "vistasEncargadoPagosCocina/inicio.php";
                }
            },
            error: function(xhr) {
                console.log(response);
            }
        });
    }
}