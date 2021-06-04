function agregarUsuario() {
    var formData = new FormData(document.getElementById('frmAgregarUsuario'));

    $.ajax({
        url: "../controladores/ControlUsuarios.php",
        type: "POST",
        datatype: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            console.log(respuesta);
            switch (respuesta) {
                case "0":
                    swal({
                        title: "¿Las contraseñas no coinciden",
                        text: "Compruebe haber escrito las contraseñas bien",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })

                    alert("Las contraseñas no coinciden");
                    break;
                case "1":
                    alert("Usuario agreagado axitosamente");
                    document.getElementById("frmAgregarUsuario").reset();
                    $('#tablaUsuarios').load("vistaUsuarios/tablaUsuarios.php");
                    break;
                case "2":
                    alert("Este nombre ya ha sido registrado");
                    break;
                case "3":
                    alert("Todos los campos tienen que ser llenados");
                    break;

            }
        }

    })

}

function obtenerDatosUsuario(idUsuario) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosUsuario', id: idUsuario },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            $('#edit-id').val(respuesta['id_usuario']);
            $('#edit-nombre').val(respuesta['nombre']);
            $('#edit-apePaterno').val(respuesta['ap_paterno']);
            $('#edit-apeMaterno').val(respuesta['ap_materno']);
            $('#edit-slc-roles').val(respuesta['id_rol']);
            $('#edit-slc-areas').val(respuesta['id_area']);
            $('#edit-correoUsuario').val(respuesta['correo']);
            $('#edit-passUsuario').val(respuesta['contrasena']);
            $('#edit-passUsuario2').val(respuesta['contrasena']);
        }
    });
}

function actualizarDatosUsuarios() {
    var formData = new FormData(document.getElementById('frmEditarUsuario'));

    $.ajax({
        url: "../controladores/ControlUsuarios.php",
        type: "POST",
        datatype: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            switch (respuesta) {
                case "0":
                    alert("Las contraseñas no coinciden");
                    break;
                case "1":
                    alert("Usuario editado axitosamente");
                    $('#tablaUsuarios').load("vistaUsuarios/tablaUsuarios.php");
                    break;
                case "2":
                    alert("Este nombre ya ha sido registrado");
                    break;
                case "3":
                    alert("Todos los campos tienen que ser llenados");
                    break;

            }
        }

    })


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
                    data: { tipoOperacion: '2', id: idUsuario },
                    url: "../controladores/ControlUsuarios.php",
                    success: function(respuesta) {
                        console.log(respuesta);
                        if (respuesta == 1) {
                            alert("usuario eliminado exitosamente");
                            $('#tablaUsuarios').load("vistaUsuarios/tablaUsuarios.php");
                        } else {
                            alert("Error de sistema");
                        }

                    }
                });
            }
        });


}