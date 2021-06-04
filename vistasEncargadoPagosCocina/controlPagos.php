<?php
session_start();
$idUsuario = $_SESSION['ID_CO'];
if (isset($_SESSION['ID_CO'])) {
  if ($_SESSION['ROL']) {
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
          Pagos de servicio de comida
        </div>
        <div class="card-body">
          <h5 class="card-title">Historial de pagos</h5>
          <p class="card-text">Registro de los pagos de cada uno de los usuarios.</p>
          <div class="dropdown">
            <span class="btn btn-warning " id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Opciones
            </span>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <span class="dropdown-item btn" data-toggle="modal" data-target="#modalTotales">Crear total</span>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Lista de pagos</h5>
          <div id="tabla"></div>
        </div>
      </div>
      <hr>
      <!-- Modal -->
      <div class="modal fade" id="modalTotales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Totales</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="">Fecha inicial</label>
              <input type="date" class="form-control" id="fechaInicial">
              <label for="">Fecha final</label>
              <input type="date" class="form-control" id="fechaFinal">
              <hr>
              <div class="table table-responsive">
                <table class="table table-hover" id="tablaCategoriaDataTable">
                  <thead style="text-align: center;">
                    <th>Nombre</th>
                    <th>Fecha de pago</th>
                    <th>Total</th>
                  </thead>
                  <tbody style="text-align: center;" id="bodyTablaPagos">
                  </tbody>
                </table>
              </div>
              <span class="btn btn-warning btn-block" id="btnCrearTotal"> Ver total </span>
              <span class="btn btn-success btn-block" id="btnCrearPDF"> Imprimir </span>
              <div id="reporte"></div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>


      <?php
      include "footer.php";
      ?>
      <script src="../JS/controlPagos.js"></script>

      <script type="text/javascript">
        $(document).ready(function() {
          $('#tabla').load("vistaspagos/historialPagos.php");


          $('#btnCrearPDF').click(function() {
            crearPDF();
          });

          $('#btnCrearTotal').click(function() {
            crearTotal();
          });
        });
      </script>
  <?php
  }
} else {
  header("location:../index.php");
}
  ?>