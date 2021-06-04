<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==1){
        include "header.php";
?>  
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
             <h1 class="display-4">Sectores</h1>
             <div class="row">
                 <div class="col-sm-4">
                     <span class="btn btn-warning" data-toggle="modal" data-target="#modalAddSectores">
                        <span class="fas fa-plus-circle"></span> Agregar nuevo sector
                     </span>
                 </div>
             </div>
             <hr>
             <div class="col-sm-12">
                 <div id="tablaSectores"></div>
             </div>
         </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="modalAddSectores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar sector</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmEditarUsuario">
              <label>Nombre</label>
              <input type="text" name="nombre-sector" id="nombre-sector" class="form-control" required="">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnGuardarSector">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditarSector" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar sector</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmEditarUsuario">
              <label>Nombre</label>
              <input type="text" name="edit-nombre-sector" id="edit-nombre-sector" class="form-control" required="">
              <input type="hidden" name="edit-id" id="edit-id" class="form-control" required="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnEditarSector">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<?php
      include "footer.php";
?>
    <script src="../JS/controlSectores.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tablaSectores').load("vistasSectores/tablaSectores.php");
            $('.slcRol').load("vistaUsuarios/selectRol.php");
            $('.slcArea').load("vistaUsuarios/selectArea.php");
            
            $('#btnGuardarSector').click(function(){
                agregarSector();
            });

            $('#btnEditarSector').click(function(){
              editarSector();
            });

            
        });
    </script>
<?php
      }

    }else{
        header("location:../index.php");
    }
?>