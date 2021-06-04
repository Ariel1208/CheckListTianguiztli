<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==3){
        require_once "../clases/conexion.php";
        $c= new conectar();
        $c=$c->conexion(); 
        include "header.php";
        $sql = "SELECT COUNT(*) AS TOTAL FROM lista_servicio_cocina a INNER JOIN seguimiento_pagos b ON a.id_usuario = b.id_usuario WHERE b.fecha_inicial<= now() and b.fecha_final>=now()";
        $result = mysqli_query($c, $sql);
        $res = mysqli_fetch_array($result);
?>  
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
             <h1 class="display-4">Seguimiento de asistencia a cocina</h1>
             <br>
             <div class="row">
                 <div class="col-sm-4">
                 </div>
             </div>
             <hr>
             <div class="col-sm-12">
                <h2>Total de usuarios: <?php echo $res['TOTAL'] ?> </h2>
                <br>
                 <div id="cartasAsistencia"></div>
             </div>
         </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="modalEvidenciasReporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Evidencias de reporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmArchivosReporte">
            <label for="">Archivos</label>
            <input type="hidden" class="form-control" id="edit-id" name="edit-id">
            <input type="file" name="archivo[]" id="archivo[]" class="form-control archivos" multiple="">
            <input type="hidden" name="tipoOperacion" id="tipoOperacion" value="addEvidencias">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnSubirArchivos">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalSeguimientoReporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Seguimiento de reporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="id-reporte" name="id-reporte">
      <label for="">Encargado de sector</label>
      <input type="text" id="nomEncargado" class="form-control" readonly="readonly">
      <hr>
      <label for="">Tabla de revisión</label>
        <div class="table table-responsive ">
          <table class="table table-hover table-warning" id="tablaPlantilla">
              <thead style="text-align: center;">
                  <th>Actividad</th>
                  <th>Lunes</th>
                  <th>Martes</th>
                  <th>Miércoles</th>
                  <th>Jueves</th>
                  <th>Viernes</th>
              </thead>
              <tbody style="text-align: center;" id="actividadesPlantilla">
              </tbody>
          </table>
        </div>
        <hr>
        <label for="">Evidencias</label>
        <div class="table table-responsive ">
          <table class="table table-hover table-warning" id="tablaEvidencias">
              <thead style="text-align: center;">
                  <th>Evidencia</th>
                  <th></th>
                  <th></th>
              </thead>
              <tbody style="text-align: center;" id="evidenciasReporte">
              </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="btnImprimirPlantilla">Imprimir plantilla</button>
        <button type="button" class="btn btn-success" id="btnSeguimientoReporte">Guardar cambios</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<?php
      include "footer.php";
?>
    <script src="../JS/controlAsistenciaCocina.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.slcPlan').load("vistasPlantillas/selectPlantillas.php");
            $('.slcArea').load("vistaUsuarios/selectArea.php");
            $('#cartasAsistencia').load("vistasReportes/cartasAsistencia.php");
            
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