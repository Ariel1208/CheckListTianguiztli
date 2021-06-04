<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <div class="table table-responsive">
        <table class="table table-hover " id="tablaPagos">
            <thead style="text-align: center;">
                <th>Usuario</th>
                <th>Fecha de pago</th>
                <th>De</th>
                <th>a</th>
                <th>Dias pagados</th>
                <th>Total</th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT b.nombre,a.fecha_pago,a.fecha_inicial,a.fecha_final,SUM(a.dias_pagados) AS dias_pagados, SUM(total) AS total FROM historial_pagos_cocina a INNER JOIN lista_servicio_cocina b ON a.id_usuario=b.id_usuario GROUP BY a.fecha_pago  ORDER BY id_historial  DESC";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $mostrar['nombre'] ?></td>
                        <td><?php echo $mostrar['fecha_pago'] ?></td>
                        <td><?php echo $mostrar['fecha_inicial'] ?></td>
                        <td><?php echo $mostrar['fecha_final'] ?></td>
                        <td><?php echo $mostrar['dias_pagados'] ?></td>
                        <td>$<?php echo $mostrar['total'] ?></td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablaPagos').DataTable();

        });
    </script>

<?php

}
?>