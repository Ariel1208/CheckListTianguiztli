<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <div class="table table-responsive">
        <table class="table table-striped" id="tableReports">
            <thead style="text-align: center;">
                <th></th>
                <th>Nombre de reporte</th>
                <th>Fecha de inicio</th>
                <th data-breakpoints="xs sm">Fecha final</th>
                <th data-breakpoints="xs sm">Fecha límite de entrega</th>
                <th data-breakpoints="xs sm">Sector</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT * FROM reporte a inner join plantilla b on a.id_plantilla=b.id_plantilla inner join sectores c on b.id_sector=c.id_sector";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                    $id = $mostrar['id_reporte'];
                    $sql2 = "select count(*) as cantidad from evidencias_reporte where id_reporte='$id'";
                    $result2 = mysqli_query($c, $sql2);
                    $cantidad = mysqli_fetch_array($result2);

                ?>
                    <tr>
                        <?php
                        if ($cantidad['cantidad'] == 0) {
                        ?>
                            <td>
                                <span class="fas fa-exclamation-triangle " data-toggle="tooltip" data-placement="left" title="No se han adjuntado evidencias a este reporte"></span>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <span class="far fa-check-circle icon" data-toggle="tooltip" data-placement="left" title="Reporte completo"></span>
                            </td>
                        <?php
                        }
                        ?>
                        <td><?php echo $mostrar['nombre_reporte'] ?></td>
                        <td><?php echo $mostrar['fecha_inicial'] ?></td>
                        <td><?php echo $mostrar['fecha_final'] ?></td>
                        <td><?php echo $mostrar['fecha_limite'] ?></td>
                        <td><?php echo $mostrar['sector'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn " type="button" id="dropdownMenu2" data-bs-toggle="dropdown"  aria-expanded="false">
                                    <span class="fas fa-cogs" style="color:#007bff"></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <span class="btn btn-info btn-sm dropdown-item" onclick="seguimientoReporte('<?php echo $id ?>')" data-bs-toggle="modal" data-bs-target="#modalSeguimientoReporte" >Seguimineto de reporte</span>
                                    <span class="btn btn-success btn-sm dropdown-item" onclick="obtenerDatosReporte('<?php echo $id ?>')" data-bs-toggle="modal" data-bs-target="#modalEvidenciasReporte">Adjuntar evidencias</span>
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosReporte('<?php echo $id ?>')" data-bs-toggle="modal" data-bs-target="#modalEditarReporte">Editar</span>
                                    <span class="btn btn-danger btn-sm dropdown-item" onclick="eliminarReporte('<?php echo $id ?>')">Eliminar</span>
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
            var table = $('#tableReports').DataTable({
                lengthChange: false
            });

            // Display the button
        });
    </script>

<?php

}
?>