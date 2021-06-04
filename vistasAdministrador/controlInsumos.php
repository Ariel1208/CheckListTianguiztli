
<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==1){
        include "header.php";
?>  
        <div class="jumbotron jumbotron-fluid">
        <div class="container">
             <h1 class="display-4">Insumos</h1>
             <div class="row">
             </div>
             <hr>
             <div class="col-sm-12">
                <div id="tablaReportes"></div>
                 <canvas id="graficaBarras" width="1100" height="300"></canvas>
             </div>
         </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="listadoReportes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reportes de insumos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <div class="table table-responsive ">
          <table class="table table-hover table-warning" id="tablaReporte">
              <thead style="text-align: center;">
                  <th>Producto</th>
                  <th>Cantidad</th>
              </thead>
              <tbody style="text-align: center;" id="datosReporte">
              </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<?php
      include "footer.php";
?>
    <script src="../JS/controlGraficas.js"></script>
    <script src="../JS/controlInsumos.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#tablaReportes').load("vistasInsumos/tablaReportes.php");
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