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
                <th>Correo</th>
                <th>Contraseña</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT * FROM lista_servicio_cocina";
                $result = mysqli_query($c, $sql);

                $i = 0;

                while ($mostrar = mysqli_fetch_array($result)) {
                    $i++;
                    $idUsu = $mostrar['id_usuario'];

                    $sql = "SELECT COUNT(*) AS total FROM lista_servicio_cocina a INNER JOIN adeudo_pagos b ON a.id_usuario = b.id_usuario WHERE a.id_usuario ='$idUsu' and b.estatus='PENDIENTE'";
                    $result2 = mysqli_query($c, $sql);

                    $cantidad = mysqli_fetch_array($result2);
                ?>
                    <?php
                    if ($cantidad['total'] > 0) {
                    ?>
                        <tr>
                            <td><span value='A' class="fa fa-user" style="color: rgba(255, 128, 0, 1);"></span></td>

                        <?php
                    } else {
                        ?>
                        <tr>
                            <td><span value='B' class="fa fa-user"></span></td>
                        <?php
                    }
                        ?>

                        <td><?php echo $mostrar['nombre'] ?></td>
                        <td><?php echo $mostrar['correo'] ?></td>
                        <td><?php echo $mostrar['contrasena'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn" style="color: #D0E3CC !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog" style="color: #DBA159;"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerid('<?php echo $idUsu ?>')" data-toggle="modal" data-target="#modalActualizarFoto">Cambiar foto</span>
                                    <!--<span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosPagos('<?php echo $idUsu ?>'); obtenerDatosPagosPendientes('<?php// echo $idUsu ?>');" data-toggle="modal" data-target="#modalInformacionUsuario">Ver información</span>-->
                                    <span class="btn btn-success btn-sm dropdown-item" onclick="abrirModalRegistroPagoUsuario('<?php echo $idUsu ?>'); obtenerTotalAdeudos('<?php echo $idUsu ?>');">Registrar pago</span>
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick="$('#idUsuarioAdeudo').val('<?php echo $idUsu ?>')" data-toggle="modal" data-target="#modalRegistrarAdeudo">Registrar adeudo</span>
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosUsuario('<?php echo $idUsu ?>')" data-toggle="modal" data-target="#modalEditUsuariosCocina">Editar</span>
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