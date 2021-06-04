<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <div class="table table-responsive">
        <table class="table table-hover " id="tablaCategoriaDataTable">
            <thead style="text-align: center;">
                <th></th>
                <th>Nombre</th>
                <th>Dias</th>
                <th>Total de deuda</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT a.id_usuario,nombre, SUM(monto) AS total, COUNT(*) as dias FROM adeudo_pagos a INNER JOIN lista_servicio_cocina b ON a.id_usuario=b.id_usuario WHERE a.estatus = 'PENDIENTE' GROUP BY a.id_usuario";
                $result = mysqli_query($c, $sql);
                while ($mostrar = mysqli_fetch_array($result)) {
                    $idUsu = $mostrar['id_usuario'];
                ?>
                    <tr>
                        <td><span value='B' class="fa fa-user"></span></td>
                        <td><?php echo $mostrar['nombre'] ?></td>
                        <td><?php echo $mostrar['dias'] ?></td>
                        <td>$<?php echo $mostrar['total'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn" style="color: #D0E3CC !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog" style="color: #DBA159;"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerTotalAdeudos('<?php echo $idUsu ?>')" data-toggle="modal" data-target="#modalRegistroPagos">Registrar pago</span>
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick=" obtenerDatosPagosPendientes('<?php echo $idUsu ?>');" data-toggle="modal" data-target="#modalInformacionUsuario">Ver detalles</span>
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
        $(document).ready(function() {
            $('#tablaCategoriaDataTable').DataTable();

        });
    </script>

<?php

}
?>