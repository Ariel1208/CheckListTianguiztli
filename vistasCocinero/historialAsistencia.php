<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==3){
        include "header.php";
?>  
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
             <h1 class="display-4">Historial de asistencia a cocina</h1>
             <hr>
             <div class="col-sm-12">
                 <div id="tablaHistorial"></div>
             </div>
         </div>
    </div>




<?php
      include "footer.php";
?>
    <script src="../JS/controlAsistenciaCocina.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tablaHistorial').load("vistasReportes/historialAsistencia.php");
            $('.slcArea').load("vistaUsuarios/selectArea.php");
            
            $('#btnIniciarRegistroAsistencia').click(function(){
               iniciarRegistroAsistencia();
            });

            $('#btnMarcarAsistencia').click(function(){
                marcarAsistencia();
            });

            $('#btnActualizarReporte').click(function(){
                actualizarDatosReporte();
            })

            $('#btnSubirArchivos').click(function(){
                subirEvidenciasReportes();
            });

            
        });
    </script>
<?php
      }

    }else{
        header("location:../index.php");
    }
?>