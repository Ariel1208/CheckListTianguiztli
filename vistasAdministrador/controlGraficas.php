<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==1){
        include "header.php";
?>  
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
             <h1 class="display-4">Gráficas estadísticas</h1>
             <div class="row">
                 <div class="col-sm-4">
                    <label for="">Seleccionar reporte</label>
                     <select class="form-control slcRep" name="slc-reportes" id="slc-reportes"></select>
                     <br>
                     <span class="btn btn-warning" id='btnCrearGrafica'><span class="fas fa-plus-circle" ></span> Ver gráfica</span>
                 </div>
             </div>
             <hr>
             <div class="col-sm-12">
                 <canvas id="graficaBarras" width="400" height="300"></canvas>
             </div>
         </div>
    </div>
<?php
      include "footer.php";
?>
    <script src="../JS/controlGraficas.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('.slcRep').load("vistasReportes/selectReportes.php");


            $('#btnCrearGrafica').click(function(){
                crearGrafica();
            });

            
        });
    </script>
<?php
      }

    }else{
        header("location:../index.php");
    }
?>