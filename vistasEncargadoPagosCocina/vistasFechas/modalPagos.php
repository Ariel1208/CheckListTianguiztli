
<?php
    session_start();
    $id = $_SESSION['user_select'];
    require_once "../../clases/conexion.php";
    $c= new conectar();
    $c=$c->conexion();    

    $sql = "SELECT COUNT(*) AS cantidad FROM seguimiento_pagos WHERE id_usuario = '$id'";
    $result = mysqli_query($c, $sql);

    $mostrar= mysqli_fetch_array($result);

    if($mostrar['cantidad']>0){
    $FECHA = date("Y-m-d");
    $FECHA2 = date("Y-m-d",strtotime($FECHA."+ 7 days")); 
?>
<!-- Modal -->
<div class="modal fade" id="modalRegistroPagos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <label for="">Fecha inicial</label>
        <input type="date" id="fechaIn" min="<?php echo $FECHA;?>" value="<?php echo $FECHA;?>"class="form-control">
        <label for="">Fecha final</label>
        <input type="date" id="fechaFi" min="<?php echo $FECHA2;?>" value="<?php echo $FECHA2;?>" class="form-control">
        <input type="hidden" id="idUsuario" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardarRegistroPago">Guardar</button>
      </div>
    </div>
  </div>
</div>
<?php 
    }