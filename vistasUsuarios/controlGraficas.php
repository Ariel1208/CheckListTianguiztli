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

            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header text-center" id="headingOne">
                        <h2 class="mb-0">
                            <span class="btn " data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                EVALUCAION POR SECTOR
                            </span>
                        </h2>
                    </div>
                    <div class="collapse" id="collapseOne">
                        <div class="card card-body" id="lstDesempeño">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">REPORTES POR AREAS</h5>
                            <hr>
                            <canvas id="myChart" width="10" height="10"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">REBDIMIENTO EMPRESARIAL</h5>
                            <hr>
                            <canvas id="myChart2" width="100" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ACTIVIDADES POR TRABAJADOR</h5>
                            <hr>
                            <canvas id="myChart3" width="100" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">CALIFICACIÓNES</h5>
                            <hr>
                            <div class="card card-body" id="lstDesempeñoMantenimiento">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <?php
            include "footer.php";
            ?>
            <script src="../JS/controlGraficas.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {

                    graficasGenerales();
                    $('.slcRep').load("vistasReportes/selectReportes.php");
                    $('#lstDesempeño').load("vistasGraficas/listaDesempenoAreas.php");
                    $('#lstDesempeñoMantenimiento').load("vistasGraficas/listaDesempenoMantenimiento.php");

                    $('#btnCrearGrafica').click(function() {
                        crearGrafica();
                    });


                });
            </script>
    <?php
    } else {
        header("location:../index.php");
    }
} else {
    header("location:../index.php");
}
    ?>