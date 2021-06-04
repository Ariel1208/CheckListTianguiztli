<?php 
    session_start();
    if(isset($_SESSION['ID_US'])){
      if($_SESSION['ROL']==3){
        include "header.php";
?>  
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
             <h1 class="display-4">Insumos</h1>
             <div class="row">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <span class="dropdown-item btn" data-toggle="modal" data-target="#modalAddInsumos">Agregar insumos</span>
                        <span class="dropdown-item" data-toggle="modal" data-target="#modalAddCategorias">Agregar categorias</span>
                        <span class="dropdown-item" data-toggle="modal" data-target="#modalTablaCategorias">Ver tabla categorias</span>
                        <span class="dropdown-item" data-toggle="modal" data-target="#modalReporteEntradaInsumos">Crear reporte de entrada de insumos</span>
                        <span class="dropdown-item" data-toggle="modal" data-target="#modalSalidaProductos">Crear reporte final del dia</span>
                    </div>
                </div>
             </div>
             <hr>
             <div class="col-sm-12">
                 <div id="tablaInsumos"></div>
             </div>
         </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="modalTablaCategorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="tablaCategorias"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editarInsimos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar insumo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmEditInsumos">
            <input type="hidden" id="edit-id" disable>
            <label for="">Producto</label>
            <input type="text" class="form-control" name="edit-nombre-insumo" id="edit-nombre-insumo">
            <label for="">Cantidad</label>
            <input type="text" class="form-control" name="edit-cantidad-insumo" id="edit-cantidad-insumo">
            <label for="">Categorias</label>
            <select class="slcIns" name="edit-slc-categoria" id="edit-slc-categoria" class="form-control"></select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnEditarInsumo">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAddCategorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="frmAddCategorias">
            <label for="">Categoria</label>
            <input type="text" class="form-control" id="nombre-categoria" name="nombre-categoria">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardarCategoria">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAddInsumos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar insumos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmAddInsumos">
            <label for="">Producto</label>
            <input type="text" class="form-control" name="nombre-insumo" id="nombre-insumo">
            <label for="">Cantidad</label>
            <input type="text" class="form-control" name="cantidad-insumo" id="cantidad-insumo">
            <label for="">Categorias</label>
            <select class="slcIns" name="slc-categoria" id="slc-categoria" class="form-control"></select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardarInsumo">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="frmEditCategorias">
            <input type="hidden" id="edit-id-categoria">
            <label for="">Categoria</label>
            <input type="text" class="form-control" name="edit-nombre-categoria" id="edit-nombre-categoria">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnEditarCategoria">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalReporteEntradaInsumos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Entrada de insumos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Insumo</label>
        <select class="form-control slcInsumo" name="slc-insumos" id="slc-insumos"></select>
        <label>Cantidad</label>
        <input type="text" name="cantidad" id="cantidad" class="form-control" value="0" placeholder="0" required="">
        <span class="btn btn-primary" id="btnAgregarAltaRegistro"><span class="far fa-plus-square"> Agregar</span></span>  
          <hr>
          <div class="table table-responsive">
              <table class="table table-hover" id="tablaReporteInsumos">
                      <thead style="text-align: center;">
                          <th>Insumo</th>
                          <th>Cantidad</th>
                          <th></th>
                      </thead>
                      <tbody style="text-align: center;" id="RegistrosBody" >
                  </tbody>
              </table>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnAgregarReporteInsumosEntrada">Crear reporte</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalSalidaProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reporte final del día</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Insumo</label>
        <select class="form-control slcInsumo" name="slc-insumos-salida" id="slc-insumos-salida"></select>
        <label>Cantidad</label>
        <input type="text" name="cantidad-salida" id="cantidad-salida" class="form-control" value="0" placeholder="0" required="">
        <span class="btn btn-primary" id="btnAgregarBajaRegistro"><span class="far fa-plus-square"> Agregar</span></span>  
          <hr>
          <div class="table table-responsive">
              <table class="table table-hover" id="tablaReporteInsumos-salida">
                      <thead style="text-align: center;">
                          <th>Insumo</th>
                          <th>Cantidad</th>
                          <th></th>
                      </thead>
                      <tbody style="text-align: center;" id="RegistrosBody-salida" >
                  </tbody>
              </table>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnAgregarReporteInsumosSalida">Guardar</button>
      </div>
    </div>
  </div>
</div>

<?php
      include "footer.php";
?>
    <script src="../JS/controlInsumos.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tablaInsumos').load("vistasInsumos/tablaInsumos.php");
            $('#tablaCategorias').load("vistasCategorias/tablaCategorias.php");
            $('.slcIns').load("vistasCategorias/selectCategorias.php");
            $('.slcInsumo').load("vistasInsumos/selectInsumos.php");
            
            $('#btnGuardarCategoria').click(function(){
                agregarCategoria();
            });

            $('#btnGuardarInsumo').click(function(){
                agregarInsumo();
              $('.slcInsumo').load("vistasInsumos/selectInsumos.php");

            });
           
            $('#btnEditarInsumo').click(function(){
                editarInsumo();
            });

            $('#btnEditarCategoria').click(function(){
                editarCategoria();
                $('#tablaCategorias').load("vistasCategorias/tablaCategorias.php");

            })

            $('#btnAgregarAltaRegistro').click(function(){
                agregarRegistroAlta();
            });

            $('#btnAgregarBajaRegistro').click(function(){
                agregarRegistroBaja();
            });

            $("#btnAgregarReporteInsumosEntrada").click(function(){
              CrearReporteInsumosEntrada();
              aumentarInsumos();
              $('.slcInsumo').load("vistasInsumos/selectInsumos.php");
            });

            $("#btnAgregarReporteInsumosSalida").click(function(){
              CrearReporteInsumosSalida();
              reducirInsumos();
              $('.slcInsumo').load("vistasInsumos/selectInsumos.php");
            });

            $("#tablaReporteInsumos").on('click', '#btn-del', function () { $(this).parent().parent().remove(); }); 
            $("#tablaReporteInsumos-salida").on('click', '#btn-del', function () { $(this).parent().parent().remove(); }); 

            
        });
    </script>
<?php
      }

    }else{
        header("location:../index.php");
    }
?>