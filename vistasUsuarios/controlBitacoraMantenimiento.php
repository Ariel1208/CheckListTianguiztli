<?php
session_start();
if (isset($_SESSION['ID_US'])) {
    if ($_SESSION['ROL']) {
        include "header.php";
?>

        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link btn " id="btnCerrarSesion"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="card text-center">
                <div class="card-header">
                    BITACORA DE MANTENIMIENTO
                </div>
                <div class="card-body">
                    <h5 class="card-title">REGISTROS DE ACTIVIDADES</h5>
                    <p class="card-text">Control de tareas y pendientes del area de mantenimiento</p>

                    <div class="dropdown show">
                        <span class="btn btn-primary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </span>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="btn dropdown-item" data-toggle="modal" data-target="#modalAddEncargadoMantenimiento">Agregar encargado de mantenimiento</a>
                            <a class="btn dropdown-item" data-toggle="modal" data-target="#modalAddActividades">Agregar actividades de mantenimiento</a>
                            <a class="btn dropdown-item" data-toggle="modal" data-target="#modalRegistroBitacora">Agregar registro de mantenimiento</a>
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listas de chequeo</h5>
                    <div id="tabla"></div>
                </div>
            </div>
            <hr>

            <!-- Modal -->
            <div class="modal fade" id="modalAddEncargadoMantenimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Encargados de mantenimiento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="">Nombre</label>
                            <br>
                            <input type="text" class="form-control" id="nomEncargadoMantenimiento">
                            <br>
                            <span class="btn btn-warning " id="btnAgregarEncargado"> Agregar </span>
                            <hr>
                            <div id="tablaEncargados">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalAddActividades" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar actividades de mantenimiento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="">Actividad</label>
                            <input type="text" class="form-control" id="actividadBitacora">
                            <br>
                            <span class="btn btn-warning btn-block" id="btnAgregarActividadesMantenimiento">Agregar</span>
                            <hr>
                            <div id="tablaActividades"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalRegistroBitacora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registro de bitacora</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="">Encargado</label>
                            <select class="form-control slcEncargados" id="select-encargados"></select>
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="fecha">
                            <label for="">Hora</label>
                            <input type="time" class="form-control" id="hora" step="2">
                            <label for="">Actividad</label>
                            <select class="form-control slcActividades" id="select-Actividad"></select>
                            <label for="">Observaciones</label>
                            <textarea class="form-control" name="" id="observaciones" cols="30" rows="10"></textarea>

                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-warning" id="btnGuardarRegistroBitacora">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalEditarRegistroMantenimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar registro de bitacora</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_edit">
                            <label for="">Encargado</label>
                            <select class="form-control slcEncargados" id="select-encargados-edit"></select>
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="fecha-edit">
                            <label for="">Hora</label>
                            <input type="time" class="form-control" id="hora-edit" step="2">
                            <label for="">Actividad</label>
                            <select class="form-control slcActividades" id="select-Actividad-edit"></select>
                            <hr>
                            <div class="table table-responsive ">
                                <table class="table table-hover" id="tablaEvidencias">
                                    <thead style="text-align: center;">
                                        <th>Evidencia</th>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody style="text-align: center;" id="evidenciasReporte">
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <label for="">Observaciones</label>
                            <textarea class="form-control" name="" id="observaciones-edit" cols="30" rows="10"></textarea>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnEditarRegistroBitacora">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="modalEvidenciasReporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Evidencias de reporte</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frmArchivosReporte">
                                <label for="">Archivos</label>
                                <input type="hidden" class="form-control" id="id-reg" name="id-reg">
                                <input type="file" name="archivo[]" id="archivo[]" class="form-control archivos" multiple="">
                                <input type="hidden" name="tipoOperacion" id="tipoOperacion" value="addEvidencias">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btnSubirArchivos">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="modalVerInfoRegistroBitacora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detalles de registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="">Encargado</label>
                            <select class="form-control slcEncargados" id="select-encargados-view" disabled></select>
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="fecha-view" disabled>
                            <label for="">Hora</label>
                            <input type="time" class="form-control" id="hora-view" step="2" disabled>
                            <label for="">Actividad</label>
                            <select class="form-control slcActividades" id="select-Actividad-view" disabled></select>
                            <hr>

                            <label for="">Evidencias</label>
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner ContenedorImagenes">
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <hr>
                            <label for="">Observaciones</label>
                            <textarea class="form-control" name="" id="observaciones-view" cols="30" rows="10" disabled></textarea>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                </div>
            </div>

            <?php
            include "footer.php";
            ?>
            <script src="../JS/controlMantenimineto.js"></script>
            <script src="../JS/files.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {

                    $('#tabla').load("vistasMantenimiento/tablaBitacora.php");
                    $('.slcActividades').load("vistasMantenimiento/selectActividades.php");
                    $('.slcEncargados').load("vistasMantenimiento/selectEncargados.php");
                    $('#tablaActividades').load("vistasMantenimiento/tablaActividadesMantenimiento.php");
                    $('#tablaEncargados').load("vistasMantenimiento/tablaEncargadosmantenimiento.php");

                    $('#btnAgregarActividadesMantenimiento').click(function() {
                        agregarActividadBitacora();
                        $('.slcActividades').load("vistasMantenimiento/selectActividades.php");
                        $('#tablaActividades').load("vistasMantenimiento/tablaActividadesMantenimiento.php");
                    });

                    $('#btnGuardarRegistroBitacora').click(function() {
                        agregarRegistroBitacra();

                    })

                    $('#btnEditarRegistroBitacora').click(function() {
                        editarRegistrosBitacora();
                        $('.slcActividades').load("vistasMantenimiento/selectActividades.php");
                        $('#tablaActividades').load("vistasMantenimiento/tablaActividadesMantenimiento.php");
                    })

                    $('#btnSubirArchivos').click(function() {
                        subirEvidenciasReportes();
                        $('.slcActividades').load("vistasMantenimiento/selectActividades.php");
                        $('#tablaActividades').load("vistasMantenimiento/tablaActividadesMantenimiento.php");
                    })

                    $('#btnAgregarEncargado').click(function() {
                        agregarEncargadoMantenimiento();

                    })


                    $("#tablaActividades").on('click', '#btn-del', function() {
                        $(this).parent().parent().remove();
                    });
                    $("#tablaActividades-edit").on('click', '#btn-del-sin', function() {
                        $(this).parent().parent().remove();
                    });



                });
            </script>
    <?php
    }
} else {
    header("location:../index.php");
}
    ?>