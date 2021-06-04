<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <div class="table table-responsive">
        <table class="table table-hover " id="tablaPlatillos">
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
                                <button class="btn " type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="fas fa-cogs" style="color:#007bff"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" onclick="obtenerDatosPlatillo(<?php echo $id ?>)" type="button" data-bs-toggle="modal" data-bs-target="#modalEditarPlatillo">Editar</button>
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
            $('#tablaPlatillos').DataTable({

            });

        });
    </script>

<?php

}
?>