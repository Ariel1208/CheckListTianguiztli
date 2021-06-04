<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==1){
        include "header.php";
?>  
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
             <h1 class="display-4">Encuestas</h1>
             <hr>
             <div class="col-sm-12">
                 <div id="contenido"></div>
             </div>
         </div>
    </div>

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
          <input id="file" type="file" name="file" class="form-control" >
          <hr>
          <div id="card" class="card" style="width: 18rem;" >
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear encuesta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">Fecha limite</label>
        <input type="date" id="fechaLimiteEncuesta" name="" class="form-control" value="">
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
        <input type="hidden" id="encuestaid"value="">
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
  <div class="modal-dialog modal-xl">
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
                  <tbody style="text-align: center;" id="tabla-platillosMasVotados" >
                  </tbody>
              </table>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        $(document).ready(function(){

            $('#barrasVotosEncuesta').load("vistasEncuestas/barrasEncuesta.php");
            $('#contenido').load("vistasEncuestas/tablaEncuestas.php");
            


            $('#btnAgregarPlatillo').click(()=>{
              agregarPlatillo();
            });
            
            $('#btnEditarPlatillo').click(()=>{
              editarPlatillo();
            });


            $('#btnCrearEncuesta').click(()=>{
              crearEncuesta();
            });

            $('#btnEditarEncuesta').click(()=>{
              editarEncuesta();
            });
        });
    </script>
<?php
      }

    }else{
        header("location:../index.php");
    }
?>