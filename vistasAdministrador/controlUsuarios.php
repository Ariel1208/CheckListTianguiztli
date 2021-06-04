<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==1){
        include "header.php";
?>  
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
             <h1 class="display-4">Usuarios</h1>
             <div class="row">
                 <div class="col-sm-4">
                     <span class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarCategoria">
                        <span class="fas fa-plus-circle"></span> Agregar nuevo usuario
                     </span>
                 </div>
             </div>
             <hr>
             <div class="col-sm-12">
                 <div id="tablaUsuarios"></div>
             </div>
         </div>
    </div>


    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="text-align: center;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmAgregarUsuario">
        <div class="container">
        <div class="row">
        <label>Nombre</label>
            <input type="text" maxlength="45" name="nombre" id="nombre" class="form-control" required="">
      <div class="col-sm-6">
      <label>Apellido paterno</label>
            <input type="text" maxlength="45" name="apePaterno" id="apePaterno" class="form-control" required="">
      </div>
      <div class="col-sm-6">
      <label>Apellido materno</label>
            <input type="text" maxlength="45" name="apeMaterno" id="apeMaterno" class="form-control" required="">
      </div>
      <div class="col-sm-6">
            <label>Área</label>
            <select class="slcArea" name="slc-area" id="slc-area" class="form-control">
            </select>
      </div>
      <div class="col-sm-6">
            <label>Rol</label>
            <select class="slcRol" name="slc-roles" id="slc-roles" class="form-control">
            </select>
      </div>
            <label>Correo de usuario</label>
            <input type="text" maxlength="45" name="correoUsuario" id="correoUsuario" class="form-control" required="">
            </select>
            <label>Contraseña</label>
            <input type="password" maxlength="45" name="pass" id="pass" class="form-control" required="">
            <label>Confirmar contraseña</label>
            <input type="password" maxlength="45" name="pass2" id="pass2" class="form-control" required="">
            <input type="hidden" name="tipoOperacion"  id="tipoOperacion" value="1" >
            </div>
      </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnAgregarUsuario">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modalActualizarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición de usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmEditarUsuario">
        <div class="container">
        <div class="row">
              <label>Nombre</label>
              <input type="text" maxlength="45" name="edit-nombre" id="edit-nombre" class="form-control" required="">
              <div class="col-sm-6">
              <label>Apellido paterno</label>
              <input type="text" maxlength="45" name="edit-apePaterno" id="edit-apePaterno" class="form-control" required="">
      </div>
      <div class="col-sm-6">
              <label>Apellido materno</label>
              <input type="text" maxlength="45" name="edit-apeMaterno" id="edit-apeMaterno" class="form-control" required="">
      </div>
      <div class="col-sm-6">
              <label>Área</label>
              <select class="slcArea" name="edit-slc-areas" id="edit-slc-areas" class="form-control">
              </select>
      </div>
      <div class="col-sm-6">
              <label>Rol</label>
              <select class="slcRol" name="edit-slc-roles" id="edit-slc-roles" class="form-control">
              </select>
      </div>
              <label>Nombre de usuario</label>
              <input type="text" maxlength="45" name="edit-correoUsuario" id="edit-correoUsuario" class="form-control" required="">
              </select>
              <label>Contraseña</label>
              <input type="password" maxlength="45" name="edit-passUsuario" id="edit-passUsuario" class="form-control" required="">
              <label>Confirmar contraseña</label>
              <input type="password" maxlength="45" name="edit-passUsuario2" id="edit-passUsuario2" class="form-control" required="">
              <input type="hidden" name="edit-id"  id="edit-id" value="" >
              <input type="hidden" name="tipoOperacion"  id="tipoOperacion" value="3" >
      </div>
      </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnEditarUsuario">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnCerrarModalUp">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<?php
      include "footer.php";
?>
    <script src="../JS/controlUsuarios.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tablaUsuarios').load("vistaUsuarios/tablaUsuarios.php");
            $('.slcRol').load("vistaUsuarios/selectRol.php");
            $('.slcArea').load("vistaUsuarios/selectArea.php");
            
            $('#btnAgregarUsuario').click(function(){
                agregarUsuario();
            });

            $('#btnEditarUsuario').click(function(){
              actualizarDatosUsuarios();
            });

            
        });
    </script>
<?php
      }

    }else{
        header("location:../index.php");
    }
?>