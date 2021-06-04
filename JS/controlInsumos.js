function agregarCategoria() {
    var nomCategoria = $("#nombre-categoria").val();
    if(nomCategoria==""){
        alert("Debe llenar todos los campos");
        return false;
    }


    $.ajax({
        type: "POST",
        data: { action: 'agregarCategoriaInsumos', nombre:nomCategoria},
        url: "../controladores/control.php",
        success: function(respuesta) {
            if(respuesta==1){
                alert("Categoria agregada exitosamente");
                document.getElementById("frmAddCategorias").reset();
                $('.slcIns').load("vistasCategorias/selectCategorias.php");
            }else if(respuesta==0){
                alert("Ya existe una categoria con este nombre");
            }else{
                alert("Error al agregar la categoria");
                console.log(respuesta);
            }

        }
    });

}

function obtenerDatosInsumo(id){
    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosInsumos', id:id},
        url: "../controladores/control.php",
        dataType:"json",
        success: function(respuesta) {
            console.log(respuesta);

            $("#edit-nombre-insumo").val(respuesta.producto);
            $("#edit-cantidad-insumo").val(respuesta.cantidad);
            $("#edit-slc-categoria").val(respuesta.id_categoria);
            $("#edit-id").val(respuesta.id_producto);
        }
    });
}

function agregarInsumo(){
    var nom = $("#nombre-insumo").val();
    var cant = $("#cantidad-insumo").val();
    var cate = $("#slc-categoria").val();

    if(nom=="" || cant=="" || cate==""){
        alert("Llenar todos los campos");
        return false;
    }

    $.ajax({
        type: "POST",
        data: { action: 'agregarInsumo', nombre:nom, cantidad:cant, categoria:cate},
        url: "../controladores/control.php",
        success: function(respuesta) {
            console.log(respuesta);
            if(respuesta==1){
                alert("Insumo agregado exitosamente");
                document.getElementById("frmAddInsumos").reset();
                $('#tablaInsumos').load("vistasInsumos/tablaInsumos.php");
            }else if(respuesta==0){
                alert("Ya existe un insumo con este nombre");
            }else{
                alert("Error al agregar el insumo");
                console.log(respuesta);
            }

        }
    });
}

function editarInsumo(){
    var id=$("#edit-id").val();
    var nom = $("#edit-nombre-insumo").val();
    var cant = $("#edit-cantidad-insumo").val();
    var cate = $("#edit-slc-categoria").val();

    if(nom=="" || cant=="" || cate==""){
        alert("Llenar todos los campos");
        return false;
    }

    $.ajax({
        type: "POST",
        data: { action: 'editarInsumo',id:id, nombre:nom, cantidad:cant, categoria:cate},
        url: "../controladores/control.php",
        success: function(respuesta) {
            if(respuesta==1){
                alert("Insumo editado exitosamente");
                $('#tablaInsumos').load("vistasInsumos/tablaInsumos.php");
            }else if(respuesta==0){
                alert("Ya existe un insumo con este nombre");
            }else{
                alert("Error al agregar el insumo");
                console.log(respuesta);
            }

        }
    });
}

function eliminarInsumo(id){


    swal({
        title: "¿Estas seguro de eliminar este producto?",
        text: "Una vez eliminado no podra recuperarse",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                data: { action: 'eliminarInsumo',id:id},
                url: "../controladores/control.php",
                success: function(respuesta) {
                    if(respuesta==1){
                        alert("Insumo eliminado exitosamente");
                        $('#tablaInsumos').load("vistasInsumos/tablaInsumos.php");
                    }else{
                        alert("Error al eliminar este insumo");
                        console.log(respuesta);
                    }
        
                }
            });
        }
    });
    
}

function obtenerDatosCategoria(id){

    $.ajax({
        type: "POST",
        data: { action: 'obtenerDatosCategoria',id:id},
        url: "../controladores/control.php",
        dataType:"json",
        success: function(respuesta) {
            $("#edit-nombre-categoria").val(respuesta.categoria);
            $("#edit-id-categoria").val(respuesta.id_categoria);
        }
    });
}

function editarCategoria(){
    var nomCategoria = $("#edit-nombre-categoria").val();
    var id = $("#edit-id-categoria").val();

    if(nomCategoria=="" || id==""){
        alert("Debe llenar todos los campos");
        return false;
    }


    $.ajax({
        type: "POST",
        data: { action: 'editarCategoriasInsumos', nombre:nomCategoria,id:id},
        url: "../controladores/control.php",
        success: function(respuesta) {
            if(respuesta==1){
                alert("Categoria agregada exitosamente");
                document.getElementById("frmAddCategorias").reset();
                $('.slcIns').load("vistasCategorias/selectCategorias.php");
            }else if(respuesta==0){
                alert("Ya existe una categoria con este nombre");
            }else{
                alert("Error al agregar la categoria");
                console.log(respuesta);
            }

        }
    });
}

function eliminarCategoria(id){

    swal({
        title: "¿Estas seguro de eliminar esta categoria?",
        text: "Una vez eliminado no podra recuperarse",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                data: { action: 'eliminarCategoriaInsumo',id:id},
                url: "../controladores/control.php",
                success: function(respuesta) {
                    console.log(respuesta);
                    if(respuesta==1){
                        alert("Insumo eliminado exitosamente");
                        $('#tablaCategorias').load("vistasCategorias/tablaCategorias.php");

                    }else if(respuesta==0){
                        alert("No es posible eliminar esta categoria por que hay productos agregados a esta categoria");
                    }else{
                        alert("Error de sistema");
                        console.log(respuesta);
                    }
        
                }
            });
        }
    });
}

function agregarRegistroAlta() {
    var idInsumo = $("#slc-insumos").val();
    var cantidad = $("#cantidad").val();
    var valid = 0;
    if(cantidad ==""){
        alert("Favor de llenar el campo");
        return false;
    }else{

        $.ajax({
            type: "POST",
            data: { action: 'obtenerDatosInsumos',id:idInsumo},
            url: "../controladores/control.php",
            dataType:"json",
            success: function(respuesta) {
                console.log(respuesta);

                $('#tablaReporteInsumos tbody tr').each(function(result) {
                    $(this).children("td").each(function(res2) {
                        switch (res2) {
                            case 1:
                                console.log();
                                if($(this).text()==respuesta.producto){
                                    valid=1;
                                }
                        }
                    })
                });
                if(valid !== 0){
                    alert("Este producto ya fue agregado");
                }else{
                    if(cantidad==0){
                        alert("La cantidad no puede ser 0");
                    }else if(cantidad>0){
                        tabla="<tr><td style='display:none;'>"+respuesta.id_producto+"</td><td>"+respuesta.producto+"</td><td>"+cantidad+"</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";

                        $("#RegistrosBody").append(tabla);
                        
                        $("#cantidad").val(0)
                    }else{
                        alert("Error");
                    }
                }
                
            }
        });
    }
}

function agregarRegistroBaja() {
    var idInsumo = $("#slc-insumos-salida").val();
    var cantidad = $("#cantidad-salida").val();
    var valid = 0;
    if(cantidad ==""){
        alert("Favor de llenar el campo");
        return false;
    }else{

        $.ajax({
            type: "POST",
            data: { action: 'obtenerDatosInsumos',id:idInsumo},
            url: "../controladores/control.php",
            dataType:"json",
            success: function(respuesta) {
                console.log(respuesta);

                $('#tablaReporteInsumos-salida tbody tr').each(function(result) {
                    $(this).children("td").each(function(res2) {
                        switch (res2) {
                            case 1:
                                console.log();
                                if($(this).text()==respuesta.producto){
                                    valid=1;
                                }
                        }
                    })
                });
                if(valid !== 0){
                    alert("Este producto ya fue agregado");
                }else{
                    if(cantidad==0){
                        alert("La cantidad no puede ser 0");
                    }else if(parseInt(respuesta.cantidad)<cantidad){
                        alert("La cantidad revaza el limite del stock");
                    }else if(parseInt(respuesta.cantidad)>=cantidad){
                        tabla="<tr><td style='display:none;'>"+respuesta.id_producto+"</td><td>"+respuesta.producto+"</td><td>"+cantidad+"</td><td><span class='btn btn-danger btn-sm' id='btn-del'><span class='far fa-trash-alt'></span></span></td></tr>";

                        $("#RegistrosBody-salida").append(tabla);
                        
                        $("#cantidad-salida").val(0)
                    }else{
                        alert("Error");
                    }
                }
                
            }
        });
    }
}

function ListaInsumosSalida(){

    var listaInsumos=[];

    $('#tablaReporteInsumos-salida tbody tr').each(function(result) {
        $(this).children("td").each(function(res2) {
            switch (res2) {
                case 1:
                    listaInsumos.push($(this).text());
                break;
                case 2:
                    listaInsumos.push($(this).text());
                break;
            }
        })
    });

    return listaInsumos;

}

function ListaInsumosEntrada(){

    var listaInsumos=[];

    $('#tablaReporteInsumos tbody tr').each(function(result) {
        $(this).children("td").each(function(res2) {
            switch (res2) {
                case 1:
                    listaInsumos.push($(this).text());
                break;
                case 2:
                    listaInsumos.push($(this).text());
                break;
            }
        })
    });

    return listaInsumos;

}

function ListaInsumosIDSalida(){

    var listaInsumosid=[];

    $('#tablaReporteInsumos-salida tbody tr').each(function(result) {
        $(this).children("td").each(function(res2) {
            switch (res2) {
                case 0:
                    listaInsumosid.push($(this).text());
                    console.log($(this).text());
                break;
                case 2:
                    listaInsumosid.push($(this).text());
                    console.log($(this).text());
                break;
            }
        })
    });

    return listaInsumosid;

}

function ListaInsumosIDEntrada(){

    var listaInsumosid=[];

    $('#tablaReporteInsumos tbody tr').each(function(result) {
        $(this).children("td").each(function(res2) {
            switch (res2) {
                case 0:
                    listaInsumosid.push($(this).text());
                    console.log($(this).text());
                break;
                case 2:
                    listaInsumosid.push($(this).text());
                    console.log($(this).text());
                break;
            }
        })
    });

    return listaInsumosid;

}
function CrearReporteInsumosEntrada(){
    var listaInsumos =  ListaInsumosEntrada();
    if(listaInsumos.length==0){
        alert("El reporte no puede ir vacio");
        return false;
    }

    $.ajax({
        type: "POST",
        data: { tipoOperacion: 'agregarReporteInsumosEntrada', data: JSON.stringify(listaInsumos)},
        url: "../controladores/ControlInsumos.php",
        success: function(respuesta) {
            if(respuesta==1){
                alert("Reporte creado exitosamente");
                $("#RegistrosBody").empty();
                $("#cantidad").val(0);
            }else if(respuesta==0){
                alert("Error al crear reporte");
            }else{
                alert("Error de sistema");
                console.log(respuesta);
            }
        }
    });
}

function CrearReporteInsumosSalida(){
    var listaInsumos =  ListaInsumosSalida();
    if(listaInsumos.length==0){
        alert("El reporte no puede ir vacio");
        return false;
    }

    $.ajax({
        type: "POST",
        data: { tipoOperacion: 'agregarReporteInsumosSalida', data: JSON.stringify(listaInsumos)},
        url: "../controladores/ControlInsumos.php",
        success: function(respuesta) {
            if(respuesta==1){
                alert("Reporte creado exitosamente");
                $("#RegistrosBody-salida").empty();
                $("#cantidad-salida").val(0);
            }else if(respuesta==0){
                alert("Error al crear reporte");
            }else{
                alert("Error de sistema");
                console.log(respuesta);
            }
        }
    });
}

function reducirInsumos(){
    var listaInsumosID =  ListaInsumosIDSalida();

    $.ajax({
        type: "POST",
        data: { tipoOperacion: 'reducirInventarioInsumos', data: JSON.stringify(listaInsumosID)},
        url: "../controladores/ControlInsumos.php",
        success: function(respuesta) {
            if(respuesta==1){
                $('#tablaInsumos').load("vistasInsumos/tablaInsumos.php");
            }else if(respuesta==0){
                alert("Error al reducir stock");
            }else{
                alert("Error de sistema");
                console.log(respuesta);
            }
        }
    });
}

function aumentarInsumos(){
    var listaInsumosID =  ListaInsumosIDEntrada();

    $.ajax({
        type: "POST",
        data: { tipoOperacion: 'aumentarInventarioInsumos', data: JSON.stringify(listaInsumosID)},
        url: "../controladores/ControlInsumos.php",
        success: function(respuesta) {
            if(respuesta==1){
                $('#tablaInsumos').load("vistasInsumos/tablaInsumos.php");
            }else if(respuesta==0){
                alert("Error al reducir stock");
            }else{
                alert("Error de sistema");
                console.log(respuesta);
            }
        }
    });
}

function seguimientoReporte(id){
    $.ajax({
        type: "POST",
        data: { action: 'seguimientoReportesInsumos', id:id},
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            var tabla="";
            $.map(respuesta,function(res){
                tabla+="<tr><td>"+res.producto+"</td><td>"+res.cantidad+"</td></tr>";
            })

            $("#datosReporte").empty().append(tabla);
        }
    });
}