<?php
session_start();
$idUsuario=$_SESSION['ID_US'];
if($_SESSION['ID_US']){
        require_once "../../clases/conexion.php";
        $c= new conectar();
        $c=$c->conexion();       
        ?>
<div class="table table-responsive">
<table class="table table-hover table-warning" id="tablaCategoriaDataTable">
        <thead style="text-align: center;">
            <th></th>
            <th>Fecha de seguimiento</th>
            <th></th>
        </thead>
        <tbody style="text-align: center;" >
        <?php
         $sql = "SELECT * FROM menu_cocina ";
         $result = mysqli_query($c, $sql);
         
         while($mostrar = mysqli_fetch_array($result)){
         $id=$mostrar['id_menu'];
        ?>
         <tr>
            <td><span class="fas fa-utensils"></span></td>
            <td><?php echo $mostrar['fecha_seguimiento']?></td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-warning " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-v"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosMenu('<?php echo $id?>')" data-toggle="modal" data-target="#modalEditarMenu">Editar</span>
                        <span class="btn btn-danger btn-sm dropdown-item" onclick="eliminarMenu('<?php echo $id?>')">Eliminar</span>
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
        $('#tablaCategoriaDataTable').DataTable();

    });
</script>

<?php
    
}
?>
