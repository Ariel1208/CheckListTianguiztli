<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==1){
        include "header.php";
?>  
<div class="jumbotron jumbotron-fluid">
    <div class="container">
            <h1 class="display-4">Plantilla de reporte</h1>
            <div class="row">
                <div class="col-sm-4">
                    <span class="btn btn-warning" data-toggle="modal" data-target="#modalAddPlantilla">
                    <span class="fas fa-plus-circle"></span> Agregar nueva plantilla
                    </span>
                </div>
        </div>
            <hr>
            <div class="col-sm-12">
                <div id="tablaPlantillas"></div>
            </div>




<!-- Modal -->
<div class="modal fade" id="modalEditarPlantilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar plantilla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="frmEditarPlantilla">
            <input type="hidden" name="edit-id" id="edit-id" class="form-control" required="">
            <label>Nombre</label>
            <input type="text" name="edit-nombre-plantilla" id="edit-nombre-plantilla" class="form-control" required="">
            <label>Sector</label>
            <select class="slcSec" name="edit-slc-sectores" id="edit-slc-sectores" class="form-control"></select>
            <br>
            <label>Actividades</label>
            <input type="text" name="edit-actividad" id="edit-actividad" class="form-control" required="">
            <span class="btn btn-primary" id="btnActualizarActividad"><span class="far fa-plus-square"> Agregar</span></span>  
            <hr>
            <div class="table table-responsive">
                <table class="table table-hover table-warning" id="edit-tablaActividades">
                    <thead style="text-align: center;">
                        <th>Actividades</th>
                    </thead>
                    <tbody style="text-align: center;" id="edit-ActividadesBody" >
                    </tbody>
                </table>
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnEditarPlantilla">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

            <!-- Modal -->
<div class="modal fade" id="modalVerPlantilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Plantilla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
      <div class="table table-responsive plantilla">
        <table class="table table-hover" id="tablaPlantilla">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="btnImprimir">Imprimir</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAddPlantilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar plantilla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmEditarUsuario">
              <label>Nombre</label>
              <input type="text" name="nombre-plantilla" id="nombre-plantilla" class="form-control" required="">
              <label>Sector</label>
              <select class="slcSec" name="slc-sectores" id="slc-sectores" class="form-control"></select>
              <br>
                <label>Actividades</label>
              <input type="text" name="actividad" id="actividad" class="form-control" required="">
              <span class="btn btn-primary" id="btnAgregarActividad"><span class="far fa-plus-square"> Agregar</span></span>  
                <hr>
                <div class="table table-responsive">
                    <table class="table table-hover table-warning" id="tablaActividades">
                            <thead style="text-align: center;">
                                <th>Actividades</th>
                            </thead>
                            <tbody style="text-align: center;" id="ActividadesBody" >
                        </tbody>
                    </table>
                </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnGuardarPlantilla">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button> 
      </div>
    </div>
  </div>
</div>




<?php
      include "footer.php";
?>
    <script src="../JS/controlPlantillas.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tablaPlantillas').load("vistasPlantillas/tablaPlantillas.php");
            $('.slcSec').load("vistasSectores/selectSectores.php");
            $('.slcArea').load("vistaUsuarios/selectArea.php");
            
            $('#btnAgregarActividad').click(function(){
                agregarActividad();
            });

            $('#btnEditarPlantilla').click(function(){
                editarPlantilla();
            });

            $('#btnGuardarPlantilla').click(function(){
                agregarPlantilla();
            });

            $('#btnActualizarActividad').click(function(){
                agregarActividadEdit();
            });

            $("#btnImprimir").click(function(){
                imprimirPlantilla();
            });

            $("#tablaActividades").on('click', '#btn-del', function () { $(this).parent().parent().remove(); }); 
            $("#edit-tablaActividades").on('click', '#btn-del', function () { $(this).parent().parent().remove(); });
            
        });
    </script>
<?php
      }

    }else{
        header("location:../index.php");
    }
?>