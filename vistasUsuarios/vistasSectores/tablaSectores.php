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
                <th></th>
                <th>Nombre</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT * FROM sectores ";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                    $id = $mostrar['id_sector'];
                ?>
                    <tr>
                        <td><span class="fas fa-chart-area"></span></td>
                        <td><?php echo $mostrar['sector'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn" style="color: #D0E3CC !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog" style="color: #DBA159;"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosSector('<?php echo $id ?>')" data-toggle="modal" data-target="#modalEditarSector">Editar</span>
                                    <span class="btn btn-danger btn-sm dropdown-item" onclick="eliminarSector('<?php echo $id ?>')">Eliminar</span>
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