<?php
session_start();
$idUsuario=$_SESSION['ID_US'];
if($_SESSION['ID_US']){
        require_once "../../clases/conexion.php";
        $c= new conectar();
        $c=$c->conexion();       
        ?>
<div class="table table-responsive">
<table class="table table-hover " id="tablaCategoriaDataTable">
        <thead style="text-align: center;">
            <th style='display: none'>Id pago</th>
            <th>Usuario</th>
            <th>Fecha de pago</th>
            <th>De</th>
            <th>a</th>
            <th>Dias pagados</th>
            <th>Total</th>
        </thead>
        <tbody style="text-align: center;" >
        <?php
            $sql = "SELECT a.id_historial,b.nombre,a.fecha_pago,a.fecha_inicial,a.fecha_final, SUM(a.dias_pagados) AS dias_pagados, SUM(total) AS total FROM historial_pagos_cocina a INNER JOIN lista_servicio_cocina b ON a.id_usuario=b.id_usuario GROUP BY a.id_usuario, a.fecha_pago ORDER BY `a`.`fecha_pago` DESC";
            $result = mysqli_query($c, $sql);
         
         while($mostrar = mysqli_fetch_array($result)){
        ?>
         <tr>
            <td style='display: none'><?php echo $mostrar['id_historial']?></td>
            <td><?php echo $mostrar['nombre']?></td>
            <td><?php echo $mostrar['fecha_pago']?></td>
            <td><?php echo $mostrar['fecha_inicial']?></td>
            <td><?php echo $mostrar['fecha_final']?></td>
            <td><?php echo $mostrar['dias_pagados']?></td>
            <td>$<?php echo $mostrar['total']?></td>
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
