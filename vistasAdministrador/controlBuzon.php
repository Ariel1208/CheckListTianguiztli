
<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==1){
        include "header.php";
?>  
        <div class="jumbotron jumbotron-fluid">
        <div class="container">
             <h1 class="display-4">Buzon de quejas</h1>
             <div class="dropdown ">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Opciones generales
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item" type="button" id="btnCrearGrafica" data-toggle="modal" data-target="#modalGrafica">Crear grafica</button>
                </div>
            </div>
             <hr>
             <div class="col-sm-12">
                 <div id="tabla"></div>
             </div>
         </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="detallesQueja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Reporte de queja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id">
        <label for="">Asunto</label>
        <input type="text" class="form-control" value="" id="asunto" disabled>
        <label for="">Sector</label>
        <input type="text" class="form-control" value="" id="area" disabled>
        <label for="">Descripción</label>
        <textarea cols="30" rows="10" class="form-control" id="desc" disabled></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block" id="btnImprimir">Imprimir reporte en PDF</button>
        <button type="button" class="btn btn-success btn-block" id="btnValidarQueja">Marcar como atendido</button>
        <button type="button" class="btn btn-danger btn-block" id="btnInValidarQueja">Marcar como irrelevante</button>
        <button type="button" class="btn btn-warning btn-block" id="btnNoLeidoQueja">Marcar como no leido</button>
        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalGrafica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reportes por area</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <canvas id="graficaQuejas"></canvas>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<?php
      include "footer.php";
?>
    <script src="../JS/controlReportesQuejas.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#tabla').load("vistasBuzon/tablaReportes.php");
            $('.slcRep').load("vistasReportes/selectReportes.php");


            $('#btnValidarQueja').click(function(){
                marcarRepLeido();
            });
            $('#btnInValidarQueja').click(function(){
                marcarRepInvalido();
            });
            $('#btnNoLeidoQueja').click(function(){
                marcarRepNoLeido();
            });
            $('#btnImprimir').click(function(){
                imprimirPDF();
            });

            $('#btnCrearGrafica').click(function(){
                crearGrafica();
            });

            $('#btnEliminarReportesIrrelevantes').click(function(){
                eliminarReportesIrrelevantes();
            });
            
        });
    </script>
<?php
      }

    }else{
        header("location:../index.php");
    }
?>