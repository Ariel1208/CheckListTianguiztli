<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <div class="card text-center">
        <div class="card-header">
            Encuestas de platillos
        </div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-hover " id="tabla">
                    <thead style="text-align: center;">
                        <th>Fecha de creación</th>
                        <th></th>
                    </thead>
                    <tbody style="text-align: center;">
                        <?php
                        $sql = "SELECT * FROM encuesta_cocina";
                        $result = mysqli_query($c, $sql);

                        while ($mostrar = mysqli_fetch_array($result)) {
                            $id = $mostrar['id_encuesta'];
                        ?>
                            <td><?php echo $mostrar['fecha_creacion'] ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn  " type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fas fa-cogs" style="color:#007bff"></span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <span class="btn btn-warning btn-sm dropdown-item" onclick="crearGraficaVotacion('<?php echo $id ?>')" data-bs-toggle="modal" data-bs-target="#modalDetalleEncuesta">Ver grafica</span>
                                        <span class="btn btn-warning btn-sm dropdown-item" onclick="platillosMejorVotados('<?php echo $id ?>')" data-bs-toggle='offcanvas' data-bs-target='#canvaTop10' aria-controls='offcanvasRight'>Ver TOP 10</span>
                                        <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosEncuesta('<?php echo $id ?>')" data-bs-toggle="modal" data-bs-target="#modalEditarEncuesta">Editar</span>
                                        <span class="btn btn-warning btn-sm dropdown-item" onclick="eliminarEncuesta('<?php echo $id ?>')">Eliminar</span>
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
        </div>
        <div class="card-footer text-muted">

        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#tabla').DataTable();

        });
    </script>

<?php

}
?>