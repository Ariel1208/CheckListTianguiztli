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
          Publicacion del menu
        </div>
        <div class="card-body">
          <h5 class="card-title">Comedor empresarial</h5>
          <p class="card-text">Controla y administra a los usuarios del comedor. Lleva un control de los pagos y manten un estatus de los adeudos</p>
          <div class="dropdown">
            <button class="btn btn-warning " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Opciones
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <span class="dropdown-item btn" data-toggle="modal" data-target="#modalCrearMenu">Publicar menu</span>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Menus publicados</h5>
          <div id="tabla"></div>
        </div>
      </div>
      <hr>


      <!-- Modal -->
      <div class="modal fade" id="modalCrearMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Publicación de menu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="">Fecha</label>
              <input type="date" id="fechaSeguimiento" class="form-control">
              <hr>
              <label for="">Desayunos</label>
              <select id="selectPlatillos-desayunos" class="form-control slc-platillos_desayunos">
              </select>
              <label for="">Comidas</label>
              <select id="selectPlatillos-comidas" class="form-control slc-platillos_comidas">
              </select>

              <span class="btn btn-warning btn-block" id="btnAgregarRegistroMenu">Agregar</span>
              <hr>
              <div class="table table-responsive">
                <table class="table table-hover" id="tablaMenu">
                  <thead style="text-align: center;">
                    <th>Platillo</th>
                    <th>Tipo</th>
                    <th></th>
                  </thead>
                  <tbody style="text-align: center;" id="registrosMenu">
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-warning" id="btnPublicarMenu">Publicar</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="modalEditarMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar platillo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="id-edit" name="id-edit" value="">
              <label for="">Fecha</label>
              <input type="date" id="fechaSeguimiento-edit" class="form-control">
              <hr>
              <label for="">Platillos</label>
              <select id="selectPlatillos-edit" class="form-control slc-platillos">
              </select>
              <label for="">Tipo</label>
              <select id="selectTipo-edit" class="form-control">
                <option value="1">Desayuno</option>
                <option value="2">Comida</option>
              </select>
              <span class="btn btn-warning btn-block" id="btnAgregarRegistroMenu-edit">Agregar</span>
              <hr>
              <div class="table table-responsive">
                <table class="table table-hover" id="tablaMenu-edit">
                  <thead style="text-align: center;">
                    <th>Platillo</th>
                    <th>Tipo</th>
                    <th></th>
                  </thead>
                  <tbody style="text-align: center;" id="registrosMenu-edit">
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnEditarMenu">Guardar</button>
            </div>
          </div>
        </div>
      </div>
      <?php
      include "footer.php";
      ?>
      <script src="../lib/moment.min.js"></script>
      <script src="../JS/controlMenus.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('.slc-platillos_comidas').load("vistasPlatillos/selectPlatillos-comidas.php");
          $('.slc-platillos_desayunos').load("vistasPlatillos/selectPlatillos-desayunos.php");
          $('.slc-platillos').load("vistasPlatillos/selectPlatillos.php");
          $('#tabla').load("vistasMenu/tablaMenus.php");

          $('#btnAgregarRegistroMenu').click(() => {
            agregarRegistrosTablaMenu();
          });

          $('#btnAgregarRegistroMenu-edit').click(() => {
            agregarRegistrosTablaMenuEdit();
          });

          $('#btnPublicarMenu').click(() => {
            publicarMenu();
          });

          $('#btnEditarMenu').click(() => {
            editarMenu();
          });
          $("#tablaMenu").on('click', '#btn-del', function() {
            $(this).parent().parent().remove();
          });
          $("#tablaMenu-edit").on('click', '#btn-del', function() {
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