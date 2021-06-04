function seguimientoQueja(id){
    $.ajax({
        type: "POST",
        data: { action: 'obtenerQueja', id: id },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta);
            $("#asunto").val(respuesta.asunto);
            $("#area").val(respuesta.area);
            $("#desc").val(respuesta.descripcion);
            $("#id").val(respuesta.id_reporte);
        }
    });
}

function marcarRepLeido(){
    var id=$("#id").val();
    if(id==""){
        alert("Error de sistema");
    }else{
        $.ajax({
            type: "POST",
            data: { action: 'marcarQuejaLeido', id: id },
            url: "../controladores/control.php",
            dataType: "json",
            success: function(respuesta) {
                if(respuesta==1){
                    swal("El reporte a sido marcado como relevante", ":D", "success");
                    $('#tabla').load("vistasBuzon/tablaReportes.php");

                }else{
                    swal("Error de sistema", ":C", "error");
                    console.log(respuesta);
                }
            }
        });
    }
   
}

function marcarRepInvalido(){
    var id=$("#id").val();
    if(id==""){
        alert("Error de sistema");
    }else{
        $.ajax({
            type: "POST",
            data: { action: 'marcarQuejaInvalido', id: id },
            url: "../controladores/control.php",
            dataType: "json",
            success: function(respuesta) {
                if(respuesta==1){
                    swal("El reporte a sido marcado como irrelevante", ":O", "warning");
                    $('#tabla').load("vistasBuzon/tablaReportes.php");
                }else{
                    swal("Error de sistema", ":C", "error");
                    console.log(respuesta);
                }
            }
        });
    }
   
}

function marcarRepNoLeido(){
    var id=$("#id").val();
    if(id==""){
        alert("Error de sistema");
    }else{
        $.ajax({
            type: "POST",
            data: { action: 'marcarQuejaNoLeido', id: id },
            url: "../controladores/control.php",
            dataType: "json",
            success: function(respuesta) {
                if(respuesta==1){
                    swal("El reporte a sido marcado como irrelevante", ":O", "warning");
                    $('#tabla').load("vistasBuzon/tablaReportes.php");
                }else{
                    swal("Error de sistema", ":C", "error");
                    console.log(respuesta);
                }
            }
        });
    }
   
}

function imprimirPDF(){
    var id=$("#id").val();
    if(id==""){
        alert("Error de sistema");
    }else{
        $.ajax({
            type: "POST",
            data: { action: 'obtenerQueja', id: id },
            url: "../controladores/control.php",
            dataType: "json",
            success: function(respuesta) {
                
                var doc = new jsPDF();
                
                doc.text(80, 30, 'REPORTE DE QUEJA');
                if(respuesta.tipo==1){
                    doc.text(20, 50, 'USUARIO: Anonimo');
                    doc.text(20, 60, 'CORREO: Anonimo');
                }else if(respuesta.tipo==0){
                    doc.text(20, 50, 'USUARIO: '+respuesta.nombre);
                    doc.text(20, 60, 'CORREO: '+respuesta.correo);
                }
                doc.text(80, 90, 'DETALLE DE REPORTE');
                doc.text(20, 110, 'SECTOR DE QUEJA:'+respuesta.area);
                doc.text(20, 120, 'ASUNTO:'+respuesta.asunto);
                doc.text(20, 140, 'DESCRIPCIÓN:'+respuesta.descripcion);

                
                // Save the PDF
                doc.save('Reporte_de_queja.pdf');
            }
        });
    }
}

function crearGrafica(){
    var id = $('#slc-reportes').val();

    $.ajax({
        type: "POST",
        data: {
            action: 'obtenerReportesQuejas',
        },
        url: "../controladores/control.php",
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta);
            var areas=[];
            var cantidad=[];
            $.map(respuesta,function(res){
                areas.push(res.area);
                cantidad.push(res.CANTIDAD);
            });

            let myCanva = document.getElementById("graficaQuejas");

            var chartOptions = {
                scales: {
                  yAxes: [{
                    barPercentage: 0.5,
                    gridLines: {
                      display: false
                    }
                  }],
                  xAxes: [{
                    gridLines: {
                      zeroLineColor: "black",
                      zeroLineWidth: 1
                    },
                    ticks: {
                      min: 0,
                      stepSize: 1
                    },
                    scaleLabel: {
                      display: true,
                      labelString: "Cantidad de reportes"
                    }
                  }]
                },
                elements: {
                  rectangle: {
                    borderSkipped: 'left',
                  }
                }
              };

            var chart = new Chart(myCanva, {
                type: "bar",
                boxWidth: 4,
                data: {
                    labels: areas,
                    datasets: [{
                            label: "Cantidad",
                        backgroundColor: "green",
                            data: cantidad
                        }

                    ]
                },
                options: chartOptions
            });
           
        }
    });
}

function eliminarReportesIrrelevantes(){
    swal({
        title: "¿Esta seguro de eliminar los reportes?",
        text: "Una vez eliminado no podra recuperarse la información",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                data: { action: 'eliminarReportesIrrelevantes'},
                url: "../controladores/control.php",
                dataType: "json",
                success: function(respuesta) {
                    if(respuesta==1){
                        swal("Los reportes han sido eliminados exitosamente", ":D", "success");
                        $('#tabla').load("vistasBuzon/tablaReportes.php");
                    }else{
                        swal("Error de sistema", ":C", "error");
                        console.log(respuesta);
                    }
                }
            });
        } 
      });

}

function eliminarReporte(id){
    swal({
        title: "¿Esta seguro de eliminar este reporte?",
        text: "Una vez eliminado no podra recuperarse la información",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                data: { action: 'eliminarReporteQueja',id:id},
                url: "../controladores/control.php",
                dataType: "json",
                success: function(respuesta) {
                    if(respuesta==1){
                        swal("El reporte ha sido eliminado exitosamente", ":D", "success");
                        $('#tabla').load("vistasBuzon/tablaReportes.php");
                    }else{
                        swal("Error de sistema", ":C", "error");
                        console.log(respuesta);
                    }
                }
            });
        } 
      });

}