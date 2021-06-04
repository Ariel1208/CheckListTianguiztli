<?php
session_start();
if (isset($_SESSION['ID_US'])) {
  if ($_SESSION['ROL'] == 4) {
    include "header.php";
    $FECHA = date("Y-m-d");
    $FECHA2 = date("Y-m-d", strtotime($FECHA . "+ 7 days"));


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
          Seguimiento del servicio de cocina
        </div>
        <div class="card-body">
          <h5 class="card-title">Comedor empresarial</h5>
          <p class="card-text">Controla y administra a los usuarios del comedor. Lleva un control de los pagos y manten un estatus de los adeudos</p>
          <div class="dropdown show">
            <span class="btn btn-primary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Opciones
            </span>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="btn dropdown-item" data-toggle="modal" data-target="#modalAddUsuariosCocina">Agregar usuarios</a>
              <a class="btn dropdown-item" id="btnVerTablaUsuarios">Recargar tabla de usuarios</a>
              <a class="btn dropdown-item" id="btnImprimirAsistencia">Imprimir hoja de asistencia</a>
              <a class="btn dropdown-item" id="btnRegistrarPagoGeneral">Registrar pago general</a>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Listas de usuarios</h5>
          <div id="tablaPrincipal"></div>
        </div>
      </div>
      <hr>





      <!-- Modal -->
      <div class="modal fade" id="modalAddUsuariosCocina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="frmDataUsuarios">
                <label for="">Imagen de usuario</label>
                <input type="file" name="archivo[]" id="archivo[]" class="form-control">
                <label for="">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
                <label for="">Correo</label>
                <input type="text" class="form-control" id="correo" name="correo">
                <label for="">Contraseña</label>
                <input type="text" class="form-control" id="pass" name="pass">
                <label for="">Tipo de usuario</label>
                <select name="tipoUsuario" id="tipoUsuario" class="tipoUsuario form-control"></select>
                <input type="hidden" id="tipoOperacion" name="tipoOperacion" value="1">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnAgregarUsuario">Guardar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalEditUsuariosCocina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="form-control" id="edit-id">
              <label for="">Nombre</label>
              <input type="text" class="form-control" id="edit-nombre">
              <label for="">Correo</label>
              <input type="text" class="form-control" id="edit-correo">
              <label for="">Contraseña</label>
              <input type="text" class="form-control" id="edit-pass">
              <label for="">Tipo de usuario</label>
              <select name="tipoUsuario-edit" id="tipoUsuario-edit" class="tipoUsuario form-control"></select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnEditarUsuario">Guardar</button>
            </div>
          </div>
        </div>
      </div>

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
              <h5>Servicio de comedor</h5>
              <label for="">Fecha inicial</label>
              <input type="date" id="fechaIn" class="form-control">
              <label for="">Fecha final</label>
              <input type="date" id="fechaFi" class="form-control">
              <input type="hidden" id="idUsuario" class="form-control">
              <input type="hidden" id="tipOperacion" class="form-control">
              <br>
              <span class="btn btn-warning btn-block" id="btnGuardarRegistroPago">Registrar pago</span>
              <hr>
              <h5>Pago de adeudos</h5>
              <div class="table table-responsive">
                <table class="table table-hover" id="">
                  <thead style="text-align: center;">
                    <th>Dias</th>
                    <th>Total</th>
                  </thead>
                  <tbody style="text-align: center;" id="registroPagosTotal">
                  </tbody>
                </table>
              </div>
              <br>
              <input type="number" class="form-control" placeholder="Dias a pagar" name="" id="DiasPago">
              <br>
              <span class="btn btn-warning btn-block" id="btnPagarAdeudo">Pagar adeudo</span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalInformacionUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Informacion del servicio</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="">Historial de pagos</label>
              <div class="table table-responsive">
                <table class="table table-hover" id="seguimientoPagos">
                  <thead style="text-align: center;">
                    <th>Fecha de pago</th>
                    <th>De</th>
                    <th>a</th>
                    <th>Dias pagados</th>
                    <th>Monto</th>
                  </thead>
                  <tbody style="text-align: center;" id="pagosCocina">
                  </tbody>
                </table>
              </div>
              <hr>
              <label for="">Historial de adeudos</label>
              <div class="table table-responsive">
                <table class="table table-hover" id="tablaAdeudos">
                  <thead style="text-align: center;">
                    <th>Fecha/Hora de servicio</th>
                    <th>Monto por servicio</th>
                    <th>Status</th>
                  </thead>
                  <tbody style="text-align: center;" id="pagosPendientesCocina">
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalActualizarFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cambiar imagen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="frmUpFoto">
                <input type="hidden" id="idFoto" name="idFoto" value="">
                <label for="">Imagen de usuario</label>
                <input type="file" name="archivo2[]" id="archivo2[]" class="form-control">
                <input type="hidden" id="tipoOperacion" name="tipoOperacion" value="2">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnActualizarFoto">Guardar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalPagoGeneral" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Registro de pago</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <h5>Servicio de comedor</h5>
              <label for="">Fecha inicial</label>
              <input type="date" id="fechaInG" class="form-control">
              <label for="">Fecha final</label>
              <input type="date" id="fechaFiG" class="form-control">
              <hr>
              <h5 for="">Selecciona los usuarios a los que se les registrara el pago del servicio</h5>
              <hr>
              <table id="myTable" class="table table-striped table-bordered" style="width: 100%; !important">
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnGenerarRegistroPago">Guardar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalRegistrarAdeudo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Registro de adeudos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="">Fecha inicial</label>
              <input type="date" id="fechaInAdeudo" class="form-control">
              <label for="">Fecha final</label>
              <input type="date" id="fechaFiAdeudo" class="form-control">
              <input type="hidden" id="idUsuarioAdeudo" class="form-control">
              <input type="hidden" id="tipOperacionAdeudo" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-warning" id="btnRegistrarAdeudo">Continuar</button>
            </div>
          </div>
        </div>
      </div>

      <?php
      include "footer.php";
      ?>

      <script src="../JS/operacionesFirebase.js"></script>
      <script src="../JS/controlUsuariosCocina.js"></script>
      <script src="https://momentjs.com/downloads/moment.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {


        var DATA = localStorage.getItem('infoUsers');
        datosUsuarios = JSON.parse(DATA);
    
        var table = $('#myTable').DataTable({
                    paging: true,
                    searching: true,
                    info: false,
                    data: datosUsuarios,
                    
                    columns: [
                      { title: "Nombre", data: "nombre"},
                        {title: "Correo", data: "correo" },
                        {title: "ID", data: "id_usuario" ,visible: false, searchable: false}

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
                  
                  

          //$('#tablaReportes').load("vistasReportes/tablaReportes.php");
          $('.slcUsu').load("vistasUsuariosCocina/selectUsuarios.php");
          $('.tipoUsuario').load("vistasUsuariosCocina/selectTipo.php");
          $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");

         

          $('#btnRegistrarPagoGeneral').click(function() {
            abrirModalPagoGeneral();
          });
          
          $('#btnGenerarRegistroPago').click(function() {
            generarRegistroPago();
          });

          $('#btnPagarAdeudo').click(function() {
            pagoPendientes();
          });

          $('#btnAgregarUsuario').click(function() {
            agregarUsuario();
          });

          $('#btnEditarUsuario').click(function() {
            editarUsuario();
            $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");
          });

          $('#btnGuardarRegistroPago').click(function() {
            agregarPagoCocina();
          });
          $('#btnVerTablaUsuarios').click(function() {
            $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");

          });

          $("#btnActualizarFoto").click(function() {
            actualizarFotoUsuario();
          })

          $("#btnRegistrarAdeudo").click(() => {
            registrarAdeudo();
          });



        });
      </script>
  <?php
  }
} else {
  header("location:../index.php");
}
  ?>