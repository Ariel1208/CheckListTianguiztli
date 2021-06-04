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
            <th>Usuario</th>
            <th>Fecha de asistencia</th>
        </thead>
        <tbody style="text-align: center;" >
        <?php
         $sql = "SELECT * FROM `lista_asistencia_cocina` a INNER JOIN lista_servicio_cocina b ON a.id_usuario=b.id_usuario  
         ORDER BY a.fecha  DESC";
         $result = mysqli_query($c, $sql);
         
         while($mostrar = mysqli_fetch_array($result)){
         //$id=$mostrar['id_menu'];
        ?>
         <tr>
            <td><span class="fas fa-user"></span></td>
            <td><?php echo $mostrar['nombre']?></td>
            <td><?php echo $mostrar['fecha']?></td>
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
