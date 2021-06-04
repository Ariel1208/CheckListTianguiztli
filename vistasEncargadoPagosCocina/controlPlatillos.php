<?php
session_start();
if (isset($_SESSION['ID_US'])) {
  if ($_SESSION['ROL'] == 4) {
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
        </div>
      </nav>

      <div class="card text-center">
        <div class="card-header">
          Gestion de comedor
        </div>
        <div class="card-body">
          <h5 class="card-title">Platillos de comedor</h5>
          <p class="card-text">Gestiona y controla los platillos del servicio de comedor.</p>
          <div class="dropdown">
            <div class="dropdown">
              <button class="btn btn-warning " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opciones
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <span class="dropdown-item btn" onclick="abrirModalEncuesta()">Crear encuesta</span>
                <span class="dropdown-item btn" onclick="mosatrarTablaEncuestas()">Ver tabla de encuestas</span>
                <span class="dropdown-item btn" onclick="mosatrarPlatillos()">Ver platillos</span>
                <span class="dropdown-item btn" data-toggle="modal" data-target="#modalAgregarPlatillo">Agregar platillos</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>


      <div class="card">
        <div class="card-body ">
          <h5 class="card-title">Listas de platillos</h5>
          <hr>

          <div id="contenido" class=""></div>
        </div>
      </div>
    </div>
    <hr>


    <!-- Modal -->
    <div class="modal fade" id="modalAgregarPlatillo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar platillo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formPlatillo">
              <input id="file" type="file" name="file" class="form-control">
              <hr>
              <div id="card" class="card" style="width: 18rem;">
                <img class="card-img-top" id="preview" src="" height="180px" alt="Previsualización">
              </div>
              <div id="preview"></div>
              <label for="">Nombre platillo</label>
              <input type="text" id="nombrePlatillo" name="nombrePlatillo" class="form-control">
              <label for="">Descripción</label>
              <input type="text" id="descripcionPlatillo" name="descripcionPlatillo" class="form-control">
              <label for="">Tipo</label>
              <select name="tipoPlatillo" class="form-control slc-tipo-edit"></select>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnAgregarPlatillo">Guardar</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalEditarPlatillo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar platillo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formPlatillo-edit">
              <input id="file-edit" type="file" name="file-edit" class="form-control">
              <hr>
              <div id="card-edit" class="card" style="width: 18rem;">
                <img class="card-img-top" id="preview-edit" src="" height="180px" alt="Previsualización">
              </div>
              <div id="preview"></div>
              <label for="">Nombre platillo</label>
              <input type="text" id="nombrePlatillo-edit" name="nombrePlatillo-edit" class="form-control">
              <label for="">Descripción</label>
              <input type="text" id="descripcionPlatillo-edit" name="descripcionPlatillo-edit" class="form-control">
              <label for="">Tipo</label>
              <select id="tipoPlatillo-edit" name="tipoPlatillo-edit" class="form-control slc-tipo-edit"></select>
              <input type="hidden" id="id-edit" name="id-edit" class="form-control">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnEditarPlatillo">Guardar</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalAgregarEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear encuesta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label for="">Fecha limite</label>
            <input type="date" id="fechaLimiteEncuesta" name="" class="form-control" value="">
            <label for="">No. de latillos seleccionados</label>
            <input type="text" id="numPlatillos" name="" class="form-control" value="0" disabled>
            <hr>
            <h5 for="">Selecciona los platillos que se mostraran en la encuesta</h5>
            <hr>
              <table id="myTable" class="table table-striped table-bordered" style="width: 100%; !important">
              </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnCrearEncuesta">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEditarEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar encuesta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="encuestaid" value="">
            <label for="">Fecha limite</label>
            <input type="date" id="fechaLimiteEncuesta-edit" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnEditarEncuesta">Guardar</button>
          </div>
        </div>
      </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalDetalleEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalles de encuesta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="barrasVotosEncuesta">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalTopEncuesta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Top 10</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table table-responsive">
              <table class="table table-hover">
                <thead style="text-align: center;">
                  <th>No.</th>
                  <th>Platillo</th>
                  <th>No. de votos</th>
                  <th></th>
                </thead>
                <tbody style="text-align: center;" id="tabla-platillosMasVotados">
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalVerParticipacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Votación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table table-responsive">
              <table class="table table-hover">
                <thead style="text-align: center;">
                  <th>Usuario</th>
                </thead>
                <tbody style="text-align: center;" id="tabla-usuarios">
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal" id="btnClose">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <?php
    include "footer.php";
    ?>
    <script src="../JS/controlPlatillos.js"></script>
    <script src="../JS/files.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {

        var DATA = localStorage.getItem('infoPlatillos');
        datosPlatillos = JSON.parse(DATA);
    
        var table =  $('#myTable').DataTable({
            paging: false,
            searching: true,
            info: false,
            data: datosPlatillos,
            columns: [
              { title: "Nombre", data: "nombre_platillo"},
                {title: "tipo", data: "tipo" },
            ]
          });

      
          $('#myTable tbody').on( 'click', 'tr', function () {
                      
              var num = $('#numPlatillos').val();
              
          if($(this).hasClass("selected bg-info"))
              num--;
          else
              num++;
          
          $(this).toggleClass('selected bg-info');
              
            $('#numPlatillos').val(num);  
          } );
                  
                  

        $('#barrasVotosEncuesta').load("vistasEncuestas/barrasEncuesta.php");

        $('.slc-tipo-edit').load("vistasPlatillos/selectTipos.php");

        $('#contenido').load("vistasPlatillos/cartasPlatillos.php");

        $('#btnAgregarPlatillo').click(() => {
          agregarPlatillo();
        });

        $('#btnEditarPlatillo').click(() => {
          editarPlatillo();
        });

        

        $('#btnCrearEncuesta').click(() => {
          crearEncuesta();
        });

        $('#btnEditarEncuesta').click(() => {
          editarEncuesta();
        });

        $('#btnClose').click(() => {

          $('#modalTopEncuesta').modal('show');
        });

      });
    </script>
<?php
  }
} else {
  header("location:../index.php");
}
?>