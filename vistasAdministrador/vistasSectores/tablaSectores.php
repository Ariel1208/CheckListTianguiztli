<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <h5>Sectores</h5>
    <div class="table ">
        <table class="table table-striped " id="tablaCategoriaDataTable">
            <thead style="text-align: center;">
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
                        <td><?php echo $mostrar['sector'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn " type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="fas fa-cogs" style="color:#007bff"></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosSector('<?php echo $id ?>')" data-bs-toggle="modal" data-bs-target="#modalEditarSector">Editar</span>
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