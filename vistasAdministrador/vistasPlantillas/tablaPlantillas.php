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
            <th>Nombre</th>
            <th>Sector</th>
            <th>Fecha de creación</th>
            <th></th>
        </thead>
        <tbody style="text-align: center;" >
        <?php
         $sql = "SELECT * FROM plantilla a inner join sectores b on a.id_sector=b.id_sector ";
         $result = mysqli_query($c, $sql);
         
         while($mostrar = mysqli_fetch_array($result)){
         $id=$mostrar['id_plantilla'];
        ?>
         <tr>
            <td><span class="fas fa-chart-area"></span></td>
            <td><?php echo $mostrar['nombre']?></td>
            <td><?php echo $mostrar['sector']?></td>
            <td><?php echo $mostrar['fecha_creacion']?></td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-warning " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-v"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <span class="btn btn-success btn-sm dropdown-item" onclick="verPlantilla('<?php echo $id?>')"  data-toggle="modal" data-target="#modalVerPlantilla">Ver</span>
                        <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosPlantilla('<?php echo $id?>')"  data-toggle="modal" data-target="#modalEditarPlantilla">Editar plantilla</span>
                        <span class="btn btn-danger btn-sm dropdown-item" onclick="eliminarPlantilla('<?php echo $id?>')">Eliminar plantilla</span>
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
