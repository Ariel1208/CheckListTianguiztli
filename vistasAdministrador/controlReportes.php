<?php
session_start();
if (isset($_SESSION['ID_US'])) {
  if ($_SESSION['ROL'] == 1) {
    include "header.php";
?>

    <div id="content">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
          </button>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link btn " id="btnCerrarSesion"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
              </li>
            </ul>
          </div>
      </nav>

      <div class="card text-center">
        <div class="card-header">
          Reportes
        </div>
        <div class="card-body">
          <h5 class="card-title">Comedor empresarial</h5>
          <p class="card-text">Controla y administra a los usuarios del comedor. Lleva un control de los pagos y manten un estatus de los adeudos</p>
          <span class="btn btn-warning" data-toggle="modal" data-target="#modalAddReporte">
            <span class="fas fa-plus-circle"></span> Agregar nuevo reporte
          </span>
        </div>
      </div>
      <br>
      <br>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Listas de usuarios</h5>
          <div id="tablaReportes"></div>
        </div>
      </div>
      <hr>


      <!-- Modal -->
      <div class="modal fade" id="modalVistaPrevia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Vista previa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="previsualizacion"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success">Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
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


      <!-- Modal -->
      <div class="modal fade" id="modalEditarReporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edición de reporte</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="formEditReportes">
                <div class="container">
                  <div class="row">
                    <input type="hidden" id="edit-id" name="edit-id">
                    <label for="">Nombre de reporte</label>
                    <input type="text" class="form-control" maxlength="100" name="edit-nombreReporte" id="edit-nombreReporte">
                    <div class="col-sm-6">
                      <label for="">Fecha de inicio</label>
                      <input type="date" class="form-control" min="2018-01-01" id="edit-fecha-inicio" name="edit-fecha-inicio">
                    </div>
                    <div class="col-sm-6">
                      <label for="">Fecha de final</label>
                      <input type="date" class="form-control" min="2018-01-01" id="edit-fecha-final" name="edit-fecha-final">
                    </div>
                    <label for="">Fecha límite de entrega</label>
                    <input type="date" class="form-control" min="2018-01-01" id="edit-fecha-limite" name="edit-fecha-limite">
                    <label for="">Nombre de responsable</label>
                    <input type="text" class="form-control" maxlength="100" name="edit-nombreResponsable" id="edit-nombreResponsable">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="btnActualizarReporte">Guardar</button>
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
              <button type="button" class="btn btn-success" id="btnSeguimientoReporte">Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="modalAddReporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Crear reporte</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="formAddReportes">
                <div class="container">
                  <div class="row">
                    <label for="">Nombre de reporte</label>
                    <input type="text" maxlength="100" class="form-control" name="nombreReporte" id="nombreReporte">
                    <div class="col-sm-6">
                      <label for="">Fecha de inicio</label>
                      <input type="date" class="form-control" min="2018-01-01" id="fecha-inicio" name="fecha-inicio">
                    </div>
                    <div class="col-sm-6">
                      <label for="">Fecha de final</label>
                      <input type="date" class="form-control" min="2018-01-01" id="fecha-final" name="fecha-final">
                    </div>
                    <label for="">Fecha límite de entrega</label>
                    <input type="date" class="form-control" min="2018-01-01" id="fecha-limite" name="fecha-limite">
                    <label for="">Nombre de responsable</label>
                    <input type="text" class="form-control" maxlength="90" name="nombreResponsable" id="nombreResponsable">
                    <label for="">Plantilla</label>
                    <select class="slcPlan" name="slc-plantillas" id="slc-plantillas" class="form-control"></select>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="btnGuardarReporte">Crear reporte</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>


      <?php
      include "footer.php";
      ?>
      <script src="../JS/controlReportes.js"></script>
      <script src="../lib/jspdf.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('#tablaReportes').load("vistasReportes/tablaReportes.php");
          $('.slcPlan').load("vistasPlantillas/selectPlantillas.php");
          $('.slcArea').load("vistaUsuarios/selectArea.php");

          $('#btnGuardarReporte').click(function() {
            agregarReporte();
          });

          $('#btnSeguimientoReporte').click(function() {
            guardarSeguiminetoReporte();
          });

          $('#btnActualizarReporte').click(function() {
            actualizarDatosReporte();
          })

          $('#btnSubirArchivos').click(function() {
            subirEvidenciasReportes();
          });


        });
      </script>
  <?php
  }
} else {
  header("location:../index.php");
}
  ?>