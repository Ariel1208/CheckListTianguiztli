function agregarActividad() {
    var actividad = $("#actividad").val();

    if(actividad ==""){
        alert("Favor de llenar el campo");
        return false;
    }else{
        tabla="<tr><td>"+actividad+"</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";

        $("#ActividadesBody").append(tabla);
        
        $("#actividad").val("")
    }


}

function ListarActividades(){
    var listaActividades = [];
    $('#tablaActividades tbody tr').each(function(result) {
        $(this).children("td").each(function(res2) {
            switch (res2) {
                case 0:
                    listaActividades.push($(this).text());
                break;
            }
        })
    })

    return listaActividades; 
}

function ListarActividadesEdit(){
    var listaActividades = [];
    $('#edit-tablaActividades tbody tr').each(function(result) {
        $(this).children("td").each(function(res2) {
            switch (res2) {
                case 0:
                    listaActividades.push($(this).text());
                break;
            }
        })
    })

    return listaActividades; 
}
function agregarPlantilla(){

    var nombre = $("#nombre-plantilla").val();
    var id_sector= $("#slc-sectores").val();
    var actividades = ListarActividades();

    $.ajax({
        type: "POST",
        data: { 
            tipoOperacion: 'agregarPlantilla',
            nombrePlantilla:nombre,
            sector:id_sector,
            lstactividades:JSON.stringify(actividades)
        },
        url: "../controladores/ControlPlantillas.php",
        success: function(respuesta) {
            if(respuesta==1){
                alert("Plantilla creada exitosamente");
                $('#tablaPlantillas').load("vistasPlantillas/tablaPlantillas.php");
                document.getElementById("frmEditarUsuario").reset();
                $("#tablaActividades").empty();

            }else{
                console.log(respuesta);
            }
        }
    });

}

function verPlantilla(id){
    $.ajax({
        type: "POST",
        data: { action: 'cosultarActividades', id:id},
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            tabla="";
            $.map(respuesta,function(res){
                tabla +="<tr><td>"+res.actividad+"</td><td><input type='checkbox' id='LU' name='LU' value=''></td><td><input type='checkbox' id='MA' name='MA' value=''></td><td><input type='checkbox' id='MI' name='MI' value=''></td><td><input type='checkbox' id='JU' name='JU' value=''></td><td><input type='checkbox' id='VI' name='VI' value=''></td></tr>";
            })

        $("#actividadesPlantilla").empty().append(tabla);

        }
    });
}

function obtenerDatosPlantilla(idPlantilla) {
    $.ajax({
        type: "POST",
        data: { action: 'obtenerInfoPlantilla', id:idPlantilla},
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            $("#edit-id").val(respuesta.id_plantilla);
            $("#edit-nombre-plantilla").val(respuesta.nombre);
            $("#edit-slc-sectores").val(respuesta.id_sector);
        }
    });

    $.ajax({
        type: "POST",
        data: { action: 'cosultarActividades', id:idPlantilla},
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            tabla="";
            $.map(respuesta,function(res){
                tabla +="<tr><td contenteditable='true'>"+res.actividad+"</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";
            })

        $("#edit-ActividadesBody").empty().append(tabla);

        }
    });
}

function agregarActividadEdit(){
    var actividad = $("#edit-actividad").val();

    if(actividad ==""){
        alert("Favor de llenar el campo");
        return false;
    }else{
        tabla="<tr><td>"+actividad+"</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";

        $("#edit-tablaActividades").append(tabla);
        
        $("#edit-actividad").val("");
    }

}

function editarPlantilla(){
    var id=$("#edit-id").val();
    var nombre = $("#edit-nombre-plantilla").val();
    var id_sector= $("#edit-slc-sectores").val();
    var actividades = ListarActividadesEdit();

    $.ajax({
        type: "POST",
        data: { 
            tipoOperacion: 'editarPlantilla',
            id:id,
            nombrePlantilla:nombre,
            sector:id_sector,
            lstactividades:JSON.stringify(actividades)
        },
        url: "../controladores/ControlPlantillas.php",
        success: function(respuesta) {
            if(respuesta==1){
                alert("Plantilla editada exitosamente");
                $('#tablaPlantillas').load("vistasPlantillas/tablaPlantillas.php");

            }else{
                console.log(respuesta);
            }
        }
    });

}


function eliminarPlantilla(id) {

    swal({
            title: "¿Estas seguro de eliminar esta plantilla?",
            text: "Una vez eliminado no podra recuperarse",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { action: 'eliminarPlantilla', id:id},
                    url: "../controladores/control.php",
                    success: function(respuesta) {
                        if(respuesta==0){
                            alert("No es posible eliminar este sector debido a que hay reportes del mismo");
                            $('#tablaPlantillas').load("vistasPlantillas/tablaPlantillas.php");
                        }else if(respuesta==1){
                            alert("Plantilla eliminada correctamente");
                            $('#tablaPlantillas').load("vistasPlantillas/tablaPlantillas.php");
                        }else{
                            console.log(respuesta);
                        }
                    }
                });
            }
        });


}

function imprimirPlantilla(){
    var doc = jsPDF();
    
    doc.autoTable({html:'#tablaPlantilla'});

    doc.save('table.pdf');
}