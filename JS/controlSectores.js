function agregarSector() {
    var nom = $("#nombre-sector").val();

    if(nom ==""){
        alert("Todos los campos son obligatorios");
        return false;
    }

    $.ajax({
        type: "POST",
        data: { action: 'agregarSector', nombre: nom },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            if(respuesta==1){
                alert('Sector agregado exitosamente');
                $('#tablaSectores').load("vistasSectores/tablaSectores.php");
                $("#nombre-sector").val("");
            }else if(respuesta==0){
                alert('Este sector ya ha sido dado de alta');
            }else{
                console.log(respuesta);
            }
        }
    });

}

function obtenerDatosSector(idSector) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerInfoSector', id:idSector},
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta);
            $('#edit-id').val(respuesta['id_sector']);
            $('#edit-nombre-sector').val(respuesta['sector']);
        }
    });
}

function editarSector() {
    var nom = $('#edit-nombre-sector').val();
    var id = $('#edit-id').val();

    if(nom ==""){
        alert("Todos los campos son obligatorios");
        return false;
    }
    if(id== ""){
        alert("Error de sistema");
        return false;
    }

    $.ajax({
        type: "POST",
        data: { action: 'editarSector', nombre: nom, id:id },
        url: "../controladores/control.php",
        success: function(respuesta) {
            console.log(respuesta);
            if(respuesta==1){
                alert('Sector editado exitosamente');
                $('#tablaSectores').load("vistasSectores/tablaSectores.php");
            }else if(respuesta==0){
                alert('Este nombre ya esta siendo ocupado');
            }else{
                console.log(respuesta);
            }
        }
    });


}

function eliminarSector(idSector) {

    swal({
            title: "¿Estas seguro de eliminar este sector?",
            text: "Una vez eliminado no podra recuperarse",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { action: 'eliminarSector', id:idSector},
                    url: "../controladores/control.php",
                    success: function(respuesta) {
                        console.log(respuesta);
                        if(respuesta==0){
                            alert("No es posible eliminar este sector debido a que hay reportes del mismo");
                            $('#tablaSectores').load("vistasSectores/tablaSectores.php");
                        }else if(respuesta==1){
                            alert("Sector eliminado correctamente");
                            $('#tablaSectores').load("vistasSectores/tablaSectores.php");
                        }else{
                            console.log(respuesta);
                        }
                    }
                });
            }
        });


}