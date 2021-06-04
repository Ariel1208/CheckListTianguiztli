<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.82.0">
  <title>TIANGUIZTLI</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <!-- Favicons -->
  <link rel="stylesheet" href="../lib/fontawesome/css/all.css">

  <link href="../lib/footable/css/footable.bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.24/b-1.7.0/sl-1.3.3/datatables.min.css" />


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <link href="../CSS/dashboard.css" rel="stylesheet">
  <!-- Custom styles for this template -->

</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="#">TIANGUIZTLI</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link btn" id="btnCerrarSesion">Cerrar sesión</a>
      </li>
    </ul>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="inicioDash.php">
                <span class="fas fa-home"></span>
                Inicio
              </a>
            </li>
          </ul>
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Administración de sistema</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column">

            <li class="nav-item">
              <a class="nav-link " href="UsuariosAdministradores.php">
                <span class="fas fa-users"></span>
                Usuarios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="permisosSistema.php">
                <span class="fas fa-lock"></span>
                Permisos
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>HERRAMIENTAS</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="ListasChequeo.php">
                <span class="fas fa-clipboard-check"></span>
                Listas de chequeo
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AdminComedor.php">
                <span class="fas fa-utensils"></span>
                Servicio de comedor
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="buzonQuejas.php">
                <span class="fas fa-mail-bulk"></span>
                Buzon de quejas
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Grafica de desempeño</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalDetallesDesempeño">Ver detalles</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
            </div>

          </div>
        </div>

        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>


        <h2>Tabla de reportes</h2>
        <div class="" id="tablaReportes">
        </div>


        <div class="modal fade" id="modalDetallesDesempeño" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desempeño por sector</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="desempeñoArea"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Seguimiento de reporte</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" id="id-reporte" name="id-reporte">
                <h5 for="">Encargado de sector</h5>
                <input type="text" id="nomEncargado" class="form-control" readonly="readonly">
                <hr>
                <h5 for="">Tabla de revisión</h5>
                <div class="table table-responsive ">
                  <table class="table table-hover " id="tablaPlantilla">
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
                  <table class="table table-hover" id="tablaEvidencias">
                    <thead style="text-align: center;">
                      <th>Evidencia</th>
                      <th></th>
                      <th></th>
                    </thead>
                    <tbody style="text-align: center;" id="evidenciasReporte">
                    </tbody>
                  </table>
                </div>
                <label>Observaciones</label>
                <textarea class="form-control" id="observaciones" maxlength="5000" rows="3"></textarea>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                      <label for="">Listas de chequeo creadas</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Plantilla</label>
                        </div>
                        <select class="custom-select slcPlan" name="slc-plantillas" id="slc-plantillas">
                        </select>
                      </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnGuardarReporte">Crear reporte</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>


      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

  <script src="../lib/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.24/b-1.7.0/sl-1.3.3/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script src="../JS/dashboard.js"></script>
  <script src="../JS/controlReportes.js"></script>
  <script src="../lib/jspdf.min.js"></script>
  <script src="../JS/app.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tablaReportes').load("vistasReportes/tablaReportes.php");
      $('#desempeñoArea').load("vistasGraficas/listaDesempenoAreas.php");
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
      $('#btnCerrarSesion').click(function() {
        cerrarSesion();
      });

    });
  </script>
</body>

</html>