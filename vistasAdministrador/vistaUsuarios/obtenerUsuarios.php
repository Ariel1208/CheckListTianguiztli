<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <h5>Usuarios</h5>
    <div class="table table-responsive">
        <table class="table table-hover " id="tablaCategoriaDataTable">
            <thead style="text-align: center;">
                <th></th>
                <th>Nombre</th>
                <th>A. Paterno</th>
                <th>A. Materno</th>
                <th>Rol</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT id_usuario,nombre,ap_paterno,ap_materno,correo,contrasena,area,rol FROM usuario a inner join area b on a.id_area =b.id_area inner join rol c on a.id_rol = c.id_rol  WHERE id_usuario != '$idUsuario' ";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                    $idUsu = $mostrar['id_usuario'];
                ?>
                    <tr>
                        <td><span class="fas fa-user"></span></td>
                        <td><?php echo $mostrar['nombre'] ?></td>
                        <td><?php echo $mostrar['ap_paterno'] ?></td>
                        <td><?php echo $mostrar['ap_materno'] ?></td>
                        <td><?php echo $mostrar['rol'] ?></td>
                        <td><?php echo $mostrar['correo'] ?></td>
                        <td><?php echo $mostrar['contrasena'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn " type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="fas fa-cogs" style="color:#007bff"></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosUsuario('<?php echo $idUsu ?>')" data-bs-toggle="modal" data-bs-target="#modalActualizarCategoria">Editar</span>
                                    <span class="btn btn-danger btn-sm dropdown-item" onclick="eliminarUsuario('<?php echo $idUsu ?>')">Eliminar</span>
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