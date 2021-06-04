<?php
session_start();
$idUsuario = $_SESSION['ID_CO'];
if (isset($_SESSION['ID_CO'])) {
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



            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Listas de usuarios</h5>
                    <div id="tabla"></div>
                </div>
            </div>
            <hr>


            <!-- Modal -->
            <div class="modal fade" id="modelaAdeudos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registro de adeudo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="">Fecha inicial</label>
                            <input type="date" id="fechaIn" class="form-control">
                            <label for="">Fecha final</label>
                            <input type="date" id="fechaFi" class="form-control">
                            <input type="hidden" id="idUsuario" class="form-control">
                            <input type="hidden" id="tipOperacion" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-warning">Continuar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalRegistroPagos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registro de pago</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="idUsuario" class="form-control">
                            <div class="table table-responsive">
                                <table class="table table-hover" id="">
                                    <thead style="text-align: center;">
                                        <th>Dias</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody style="text-align: center;" id="registroPagosTotal">
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <input type="number" class="form-control" placeholder="Dias a pagar" name="" id="DiasPago">
                            <br>
                            <span class="btn btn-warning btn-block" id="btnPagarAdeudo">Pagar adeudo</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalInformacionUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informacion del servicio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="">Historial de adeudos</label>
                            <div class="table table-responsive">
                                <table class="table table-hover" id="">
                                    <thead style="text-align: center;">
                                        <th>Fecha/Hora de servicio</th>
                                        <th>Monto por servicio</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody style="text-align: center;" id="pagosPendientesCocina">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include "footer.php";
            ?>
            <script src="../JS/controlPagos.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#tabla').load("vistasAdeudos/tablaAdeudos.php");


                    $('#btnPagarAdeudo').click(function() {
                        pagoPendientes();
                    });

                    $('#btnCrearPDF').click(function() {
                        crearPDF();
                    });

                    $('#btnCrearTotal').click(function() {
                        crearTotal();
                    });
                });
            </script>
    <?php
    }
} else {
    header("location:../index.php");
}
    ?>