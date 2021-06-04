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
                <th>Fecha de emisión</th>
                <th>Sector</th>
                <th>Usuario que reporta</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT * FROM reporte_quejas a INNER JOIN lista_servicio_cocina b on a.id_usuario=b.id_usuario INNER JOIN area c ON a.id_area=c.id_area";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                    $id = $mostrar['id_reporte'];
                    $status = $mostrar['estatus'];
                    $tipo = $mostrar['tipo'];

                    if ($status == 0) {
                ?>
                        <td><i class="far fa-square"></i></td>
                    <?php
                    } else if ($status == 1) {
                    ?>
                        <td><i class="fas fa-check-square" style="color:green;"></i></td>
                    <?php
                    } else if ($status == 2) {
                    ?>
                        <td><i class="fas fa-check-square" style="color:red;"></i></td>
                    <?php
                    }
                    ?>

                    <td><?php echo $mostrar['fecha_creacion'] ?></td>
                    <td><?php echo $mostrar['area'] ?></td>
                    <?php
                    if ($tipo == 0) {
                    ?>
                        <td><?php echo $mostrar['nombre'] ?></td>
                    <?php
                    } else {
                    ?>
                        <td>Anonimo</td>
                    <?php
                    }
                    ?>
                    <td>
                        <div class="dropdown">
                            <button class="btn  " type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fas fa-cogs" style="color:#007bff"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <span class="btn btn-info btn-sm dropdown-item" onclick="seguimientoQueja('<?php echo $id ?>')" data-bs-toggle="modal" data-bs-target="#detallesQueja">Ver detalles</span>
                                <span class="btn btn-success btn-sm dropdown-item" onclick="eliminarReporte('<?php echo $id ?>')" data-bs-toggle="modal" data-bs-target="#modalEvidenciasReporte">Eliminar</span>
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
    <script src="../JS/dashboard.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablaCategoriaDataTable').DataTable();

        });
    </script>

<?php

}
?>