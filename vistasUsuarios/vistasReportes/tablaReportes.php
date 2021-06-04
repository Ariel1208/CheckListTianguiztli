<?php
session_start();
$idUsuario = $_SESSION['ID_US'];
if ($_SESSION['ID_US']) {
    require_once "../../clases/conexion.php";
    $c = new conectar();
    $c = $c->conexion();
?>
    <div class="table table-responsive">
        <table class="table table-hover table-warning" style="background: #FBFBFB;" id="tablaCategoriaDataTable">
            <thead style="text-align: center;">
                <th></th>
                <th>Sector</th>
                <th>Fecha de inicio</th>
                <th>Fecha final</th>
                <th>Calificación</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT * FROM reporte a inner join plantilla b on a.id_plantilla=b.id_plantilla inner join sectores c on b.id_sector=c.id_sector ORDER BY a.id_reporte DESC";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                    $id = $mostrar['id_reporte'];
                    $sql2 = "select count(*) as cantidad from evidencias_reporte where id_reporte='$id'";
                    $result2 = mysqli_query($c, $sql2);
                    $cantidad = mysqli_fetch_array($result2);

                ?>
                    <tr>
                        <?php
                        if ($cantidad['cantidad'] == 0) {
                        ?>
                            <td>
                                <span class="fas fa-exclamation-triangle " data-toggle="tooltip" data-placement="left" title="No se han adjuntado evidencias a este reporte"></span>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <span class="fas fa-check-circle icon" data-toggle="tooltip" data-placement="left" title="Reporte completo"></span>
                            </td>
                        <?php
                        }
                        ?>
                        <td><?php echo $mostrar['sector'] ?></td>
                        <td><?php echo $mostrar['fecha_inicial'] ?></td>
                        <td><?php echo $mostrar['fecha_final'] ?></td>
                        <?php if ($mostrar['calificacion'] == 1) { ?>
                            <td style="align-items: center;">
                                <div class="stars">

                                    <input class="star star-5" id="star-5-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="5" />


                                    <label class="star star-5" for="star-5-<?php echo $id ?>"></label>


                                    <input class="star star-4" id="star-4-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="4" />


                                    <label class="star star-4" for="star-4-<?php echo $id ?>"></label>


                                    <input class="star star-3" id="star-3-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="3" />


                                    <label class="star star-3" for="star-3-<?php echo $id ?>"></label>


                                    <input class="star star-2" id="star-2-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="2" />


                                    <label class="star star-2" for="star-2-<?php echo $id ?>"></label>


                                    <input class="star star-1" id="star-1-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="1" checked />


                                    <label class="star star-1" for="star-1-<?php echo $id ?>"></label>
                                </div>

                            </td>
                        <?php } else if ($mostrar['calificacion'] == 2) { ?>
                            <td style="align-items: center;">
                                <div class="stars">

                                    <input class="star star-5" id="star-5-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="5" />


                                    <label class="star star-5" for="star-5-<?php echo $id ?>"></label>


                                    <input class="star star-4" id="star-4-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="4" />


                                    <label class="star star-4" for="star-4-<?php echo $id ?>"></label>


                                    <input class="star star-3" id="star-3-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="3" />


                                    <label class="star star-3" for="star-3-<?php echo $id ?>"></label>


                                    <input class="star star-2" id="star-2-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="2" checked />


                                    <label class="star star-2" for="star-2-<?php echo $id ?>"></label>


                                    <input class="star star-1" id="star-1-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="1" />


                                    <label class="star star-1" for="star-1-<?php echo $id ?>"></label>
                                </div>

                            </td>
                        <?php } else if ($mostrar['calificacion'] == 3) { ?>
                            <td style="align-items: center;">
                                <div class="stars">

                                    <input class="star star-5" id="star-5-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="5" />


                                    <label class="star star-5" for="star-5-<?php echo $id ?>"></label>


                                    <input class="star star-4" id="star-4-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="4" />


                                    <label class="star star-4" for="star-4-<?php echo $id ?>"></label>


                                    <input class="star star-3" id="star-3-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="3" checked />


                                    <label class="star star-3" for="star-3-<?php echo $id ?>"></label>


                                    <input class="star star-2" id="star-2-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="2" />


                                    <label class="star star-2" for="star-2-<?php echo $id ?>"></label>


                                    <input class="star star-1" id="star-1-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="1" />


                                    <label class="star star-1" for="star-1-<?php echo $id ?>"></label>
                                </div>

                            </td>
                        <?php } else if ($mostrar['calificacion'] == 4) { ?>
                            <td style="align-items: center;">
                                <div class="stars">

                                    <input class="star star-5" id="star-5-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="5" />


                                    <label class="star star-5" for="star-5-<?php echo $id ?>"></label>


                                    <input class="star star-4" id="star-4-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="4" checked />


                                    <label class="star star-4" for="star-4-<?php echo $id ?>"></label>


                                    <input class="star star-3" id="star-3-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="3" />


                                    <label class="star star-3" for="star-3-<?php echo $id ?>"></label>


                                    <input class="star star-2" id="star-2-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="2" />


                                    <label class="star star-2" for="star-2-<?php echo $id ?>"></label>


                                    <input class="star star-1" id="star-1-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="1" />


                                    <label class="star star-1" for="star-1-<?php echo $id ?>"></label>
                                </div>

                            </td>
                        <?php } else if ($mostrar['calificacion'] == 5) { ?>
                            <td style="align-items: center;">
                                <div class="stars">

                                    <input class="star star-5" id="star-5-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="5" checked />


                                    <label class="star star-5" for="star-5-<?php echo $id ?>"></label>


                                    <input class="star star-4" id="star-4-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="4" />


                                    <label class="star star-4" for="star-4-<?php echo $id ?>"></label>


                                    <input class="star star-3" id="star-3-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="3" />


                                    <label class="star star-3" for="star-3-<?php echo $id ?>"></label>


                                    <input class="star star-2" id="star-2-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="2" />


                                    <label class="star star-2" for="star-2-<?php echo $id ?>"></label>


                                    <input class="star star-1" id="star-1-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="1" />


                                    <label class="star star-1" for="star-1-<?php echo $id ?>"></label>
                                </div>

                            </td>
                        <?php } else if ($mostrar['calificacion'] == 0) { ?>
                            <td style="align-items: center;">
                                <div class="stars">

                                    <input class="star star-5" id="star-5-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="5" />


                                    <label class="star star-5" for="star-5-<?php echo $id ?>"></label>


                                    <input class="star star-4" id="star-4-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="4" />


                                    <label class="star star-4" for="star-4-<?php echo $id ?>"></label>


                                    <input class="star star-3" id="star-3-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="3" />


                                    <label class="star star-3" for="star-3-<?php echo $id ?>"></label>


                                    <input class="star star-2" id="star-2-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="2" />


                                    <label class="star star-2" for="star-2-<?php echo $id ?>"></label>


                                    <input class="star star-1" id="star-1-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="1" />


                                    <label class="star star-1" for="star-1-<?php echo $id ?>"></label>
                                </div>

                            </td>
                        <?php } ?>
                        <td>
                            <div class="dropdown">
                                <button class="btn" style="color: #D0E3CC !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog" style="color: #DBA159;"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <span class="btn btn-info btn-sm dropdown-item" onclick="seguimientoReporte('<?php echo $id ?>')" data-toggle="modal" data-target="#modalSeguimientoReporte">Seguimineto de reporte</span>
                                    <span class="btn btn-success btn-sm dropdown-item" onclick="obtenerDatosReporte('<?php echo $id ?>')" data-toggle="modal" data-target="#modalEvidenciasReporte">Adjuntar evidencias</span>
                                    <span class="btn btn-warning btn-sm dropdown-item" onclick="obtenerDatosReporte('<?php echo $id ?>')" data-toggle="modal" data-target="#modalEditarReporte">Editar</span>
                                    <span class="btn btn-danger btn-sm dropdown-item" onclick="eliminarReporte('<?php echo $id ?>')">Eliminar</span>
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