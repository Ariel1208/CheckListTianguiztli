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
                <th>Platillo</th>
                <th>Tipo</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT* FROM platillos_cocina a INNER JOIN tipo_platillo b ON a.tipo_platillo=b.id_tipo ORDER BY id_platillo DESC";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                    $id = $mostrar['id_platillo'];
                ?>
                    <tr>
                        <td style="text-align: left;"><?php echo $mostrar['nombre_platillo'] ?></td>
                        <td><?php echo $mostrar['tipo'] ?></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn" style="color: #D0E3CC !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog" style="color: #DBA159;"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" onclick="obtenerDatosPlatillo(<?php echo $id ?>)" type="button" data-toggle="modal" data-target="#modalEditarPlatillo">Editar</button>
                                    <button class="dropdown-item" onclick="eliminarPlatillo(<?php echo $id ?>)" type="button">Eliminar</button>
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
            $('#tablaCategoriaDataTable').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            });

        });
    </script>

<?php

}
?>