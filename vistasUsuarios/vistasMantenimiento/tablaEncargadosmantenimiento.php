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
                <th>Nombre</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT * FROM encargado_mantenimiento ORDER BY id_encargado DESC";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                    $id = $mostrar['id_encargado'];
                ?>
                    <tr>
                        <td id="encargadoNom"><?php echo $mostrar['encargado'] ?></td>

                        <td>
                            <span class="btn " onclick="eliminarEncargadoMantenimiento('<?php echo $id ?>')"><i class="fas fa-trash" style="color: red;"></i></span>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../JS/controlMantenimineto.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablaCategoriaDataTable').DataTable();
        });
    </script>

<?php

}
?>