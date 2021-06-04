<?php
session_start();
$idUsuario=$_SESSION['ID_US'];
if($_SESSION['ID_US']){
        require_once "../../clases/conexion.php";
        $c= new conectar();
        $c=$c->conexion();       
        ?>
<div class="table table-responsive">
<table class="table table-hover table-warning" id="tabla">
        <thead style="text-align: center;">
            <th></th>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Cantidad</th>
            <th></th>
        </thead>
        <tbody style="text-align: center;" >
        <?php
            $sql = "SELECT a.id_producto,a.producto,a.cantidad,b.categoria FROM inventario_cocina a inner join categorias_inventario b on a.id_categoria=b.id_categoria";
            $result = mysqli_query($c, $sql);
         
         while($mostrar = mysqli_fetch_array($result)){
         $id=$mostrar['id_producto'];
        ?>
            <td>
            <span class="fas fa-carrot"></span>
            </td>
            <td><?php echo $mostrar['producto']?></td>
            <td><?php echo $mostrar['categoria']?></td>
            <td><?php echo $mostrar['cantidad']?></td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-warning " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-v"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosInsumo('<?php echo $id?>')"  data-toggle="modal" data-target="#editarInsimos" >Editar</span>
                        <span class="btn btn-danger btn-sm dropdown-item" onclick="eliminarInsumo('<?php echo $id?>')"  data-toggle="modal" data-target="#modalEvidenciasReporte">Eliminar</span>
                    </div>
                </div>
            </td>
        </tr>
        <?php
        }
        ?>

        </tbody>
    </table>
</div>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#tabla').DataTable();

    });
</script>

<?php
    
}
?>
