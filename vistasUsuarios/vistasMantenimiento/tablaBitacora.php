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
                <th>Encargado</th>
                <th>Hora</th>
                <th>Actividad</th>
                <th>Fecha</th>
                <th>Calificación</th>
                <th></th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                $sql = "SELECT * FROM bitacora_mantenimiento a INNER JOIN actividades_mantenimiento b ON a.id_actividad = b.id_actividad INNER JOIN encargado_mantenimiento c ON a.id_encargado = c.id_encargado ORDER BY a.id_registro DESC";
                $result = mysqli_query($c, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                    $id = $mostrar['id_registro'];
                ?>
                    <tr>
                        <td class="texto-tabla truncate text-trunk " style="background-color: white !important;"><?php echo $mostrar['encargado'] ?></td>
                        <td cla="target"><?php echo $mostrar['hora'] ?></td>
                        <td><?php echo $mostrar['actividad'] ?></td>
                        <td><?php echo $mostrar['fecha'] ?></td>
                        <?php if ($mostrar['calificacion'] == 5) { ?>
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
                        <?php } else if ($mostrar['calificacion'] == 4) { ?>
                            <td style="align-items: center;">
                                <div class="stars">

                                    <input class="star star-5" id="star-5-<?php echo $id ?>" onclick="valorRadio(this)" type="radio" name="star-<?php echo $id ?>" value="1" />


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
                        <?php } else if ($mostrar['calificacion'] == 1) { ?>
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
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <span class="dropdown-item" onclick="obtenerDatosRegistroBitacora(<?php echo $id ?>)" data-toggle="modal" data-target="#modalEditarRegistroMantenimiento">Editar</span>
                                    <span class="dropdown-item" onclick="eliminarRergistroBitacora(<?php echo $id ?>)">Eliminar</span>
                                    <hr>
                                    <span class="dropdown-item" onclick="$('#id-reg').val(<?php echo $id ?>)" data-toggle="modal" data-target="#modalEvidenciasReporte">Anexar evidencias</span>
                                    <span class="dropdown-item" onclick="verInfoRegistroBitacora(<?php echo $id ?>)" data-toggle="modal" data-target="#modalVerInfoRegistroBitacora">Ver registro</span>
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


            $("#target").dblclick(function() {
                alert("Handler for .dblclick() called.");
            });

        });
    </script>

<?php

}
?>