<?php
session_start();
if (isset($_SESSION['ID_US'])) {
  if ($_SESSION['ROL']) {
    include "header.php";
?>


    <!-- Page Content  -->
    <!-- Page Content  -->
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
        </div>
      </nav>

      <div class="card text-center">
        <div class="card-header">
          REGISTRO DE MANTENIMIENTO
        </div>
        <div class="card-body">
          <h5 class="card-title">Reportes de mantenimineto</h5>
          <p class="card-text">Lleva acabo el control de las actividades de ofrma dinamica, establece los parametros segun tus necesidades</p>
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalAddRegistoMantenimiento">Agregar nuevo reporte</a>
        </div>
      </div>
      <br>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Listas de chequeo</h5>
          <div id="tabla"></div>
        </div>
      </div>
      <hr>

      <!-- Modal -->
      <div class="modal fade" id="modalAddRegistoMantenimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Registro de mantenimiento</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="frmAddMantenimiento">
                <label for="">Fecha de inicio</label>
                <input type="date" class="form-control" min="2018-01-01" id="fecha-inicio" name="edit-fecha-inicio">
                <label for="">Fecha de final</label>
                <input type="date" class="form-control" min="2018-01-01" id="fecha-final" name="edit-fecha-inicio">
                <hr>
                <label for="">Dias de revisión</label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-l" value="L">
                  <label class="form-check-label" for="inlineCheckbox1">Lunes</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-m" value="M">
                  <label class="form-check-label" for="inlineCheckbox2">Martes</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-mi" value="MI">
                  <label class="form-check-label" for="inlineCheckbox1">Miercoles</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-j" value="J">
                  <label class="form-check-label" for="inlineCheckbox2">Jueves</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-v" value="V">
                  <label class="form-check-label" for="inlineCheckbox1">Viernes</label>
                </div>
                <hr>
                <label>Actividades</label>
                <input type="text" name="actividad" id="actividad" maxlength="200" placeholder="Escriba la actividad" class="form-control" required="">
                <span class="btn btn-primary" id="btnAgregActividad"><span class="far fa-plus-square"> Agregar</span></span>
                <hr>
                <div class="table table-responsive">
                  <table class="table table-hover table-warning" id="tablaActividades">
                    <thead style="text-align: center;">
                      <th>Actividades</th>
                    </thead>
                    <tbody style="text-align: center;" id="ActividadesBody">
                    </tbody>
                  </table>
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnGuardarRegistroMantenimineto">Guardar</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="modalSeguimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Seguimiento</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="id-seguimiento" value="">
              <div class="table table-responsive plantilla">
                <table class="table table-hover" id="tablaMantenimiento">
                  <thead style="text-align: center;" id="headReporte">
                  </thead>
                  <tbody style="text-align: center;" id="actividadesMantenimiento">
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
              <hr>
              <label for="">Observaciones</label>
              <textarea class="form-control" id="observaciones" placeholder="Sin observaciones" maxlength="3000" rows="3"></textarea>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnGuardarSeguimiento">Guardar</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="modalEditarMantenimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar registro de mantenimiento</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="frmAddMantenimiento">
                <input type="hidden" id="id-edit" value="">
                <label for="">Fecha de inicio</label>
                <input type="date" class="form-control" min="2018-01-01" id="fecha-inicio-edit" name="edit-fecha-inicio">
                <label for="">Fecha de final</label>
                <input type="date" class="form-control" min="2018-01-01" id="fecha-final-edit" name="edit-fecha-inicio">
                <hr>
                <label for="">Dias de revisi贸n</label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-l-edit" value="L">
                  <label class="form-check-label" for="inlineCheckbox1">Lunes</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-m-edit" value="M">
                  <label class="form-check-label" for="inlineCheckbox2">Martes</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-mi-edit" value="MI">
                  <label class="form-check-label" for="inlineCheckbox1">Miercoles</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-j-edit" value="J">
                  <label class="form-check-label" for="inlineCheckbox2">Jueves</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="ch-v-edit" value="V">
                  <label class="form-check-label" for="inlineCheckbox1">Viernes</label>
                </div>
                <hr>
                <label>Actividades</label>
                <input type="text" name="actividad" id="actividad-edit" class="form-control" required="">
                <span class="btn btn-primary" id="btnAgregActividad-edit"><span class="far fa-plus-square"> Agregar</span></span>
                <hr>
                <div class="table table-responsive">
                  <table class="table table-hover table-warning" id="tablaActividades-edit">
                    <thead style="text-align: center;">
                      <th>Actividades</th>
                    </thead>
                    <tbody style="text-align: center;" id="ActividadesBody-edit">
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="btnEditarRegistroMantenimineto">Save changes</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="modalAgregarEvidencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Agregar evidencia</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="frmArchivosMantenimiento">
                <input type="hidden" name="idMantenimiento-evidencias" id="idMantenimiento-evidencias" value="">
                <input type="hidden" name="tipoOperacion" value="agregarEvidencia">
                <input id="file" type="file" name="file" class="form-control">
                <hr>
                <div id="card" class="card" style="width: 18rem;">
                  <img class="card-img-top" id="preview" src="" height="180px" alt="Previsualizaci贸n">
                </div>
                <div id="preview"></div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnAgregarEvidencia">Guardar</button>
            </div>
          </div>
        </div>
      </div>


      <?php
      include "footer.php";
      ?>
      <script src="../JS/controlMantenimineto.js"></script>
      <script src="../JS/files.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {

          $('#tabla').load("vistasMantenimiento/tablaMantenimiento.php");
          $('.slcRep').load("vistasReportes/selectReportes.php");


          $('#btnAgregActividad').click(function() {
            agregarActividad();
          });

          $('#btnAgregActividad-edit').click(function() {
            agregarActividadEdit();
          });

          $('#btnGuardarRegistroMantenimineto').click(function() {
            agregarRegistro();
          });

          $('#btnEditarRegistroMantenimineto').click(function() {
            editarMantenimiento();
          });

          $('#btnCrearGrafica').click(function() {
            crearGrafica();
          });

          $('#btnGuardarSeguimiento').click(function() {
            guardarSeguiminetoReporte();
          });

          $('#btnAgregarEvidencia').click(function() {
            agregarEvidencia();
          });



          $("#tablaActividades").on('click', '#btn-del', function() {
            $(this).parent().parent().remove();
          });
          $("#tablaActividades-edit").on('click', '#btn-del-sin', function() {
            $(this).parent().parent().remove();
          });



        });
      </script>
  <?php
  }
} else {
  header("location:../index.php");
}
  ?>