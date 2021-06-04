<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <div class="row">
        <?php
        $sql = "SELECT* FROM platillos_cocina a INNER JOIN tipo_platillo b ON a.tipo_platillo=b.id_tipo ORDER BY id_platillo DESC";
        $result = mysqli_query($c, $sql);

        while ($mostrar = mysqli_fetch_array($result)) {
            $id = $mostrar['id_platillo'];
            $img = $mostrar['imagen'];
            if ($img == 'sin') {
                $img = "../imagenesPlatillos/sinImagen.jpg";
            }
        ?>
            <div class="card col-6 " style="max-width: 100%;">
                <div class="media">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1"><?php echo $mostrar['nombre_platillo'] ?></h5>
                        <p class="card-text" <?php echo $mostrar['descripcion'] ?></p>
                        <p class="card-text"><small class="text-muted"><?php echo $mostrar['tipo'] ?></small></p>
                        <hr>
                        <div class="btn-group">
                        <button type="button" class="btn btn-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Editar
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" onclick="obtenerDatosPlatillo(<?php echo $id?>)" type="button" data-toggle="modal" data-target="#modalEditarPlatillo">Editar</button>
                            <button class="dropdown-item" onclick="eliminarPlatillo(<?php echo $id?>)" type="button">Eliminar</button>
                        </div>
                    </div>
                    </div>
                    <img src='<?php echo $img ?>' style="max-width: 180px;" class="ml-3" alt="...">
                </div>
                
            </div>
        <?php
        }
        ?>
        <br>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablaCategoriaDataTable').DataTable();

        });
    </script>

<?php

}
?>