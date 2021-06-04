<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <div class="table table-responsive">
        <table class="table table-hover table-warning" id="tablaCategoriaDataTable">
            <thead style="text-align: center;">
                <th>Actividad</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT * FROM actividades_mantenimiento ORDER BY id_actividad DESC";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                    $id = $mostrar['id_actividad'];
                ?>
                    <tr>
                        <td><?php echo $mostrar['actividad'] ?></td>
                        <td>
                            <span class="btn " onclick="eliminarActividadBitacora('<?php echo $id ?>')" data-toggle="modal" data-target="#modalAgregarEvidencia"><i class="fas fa-trash" style="color: red;"></i></span>
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