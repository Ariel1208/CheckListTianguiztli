<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>TIANGUIZTLI</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">

    <link href="../lib/footable/css/footable.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.24/b-1.7.0/sl-1.3.3/datatables.min.css" />

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="../CSS/dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="#">TIANGUIZTLI</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link btn" id="btnCerrarSesion">Cerrar sesi®Æn</a>
            </li>
        </ul>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="inicioDash.php">
                                <span class="fas fa-home"></span>
                                Inicio
                            </a>
                        </li>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Administraci√≥n de sistema</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link " href="UsuariosAdministradores.php">
                                <span class="fas fa-users"></span>
                                Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="permisosSistema.php">
                                <span class="fas fa-lock"></span>
                                Permisos
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>HERRAMIENTAS</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="ListasChequeo.php">
                                <span class="fas fa-clipboard-check"></span>
                                Listas de chequeo
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="AdminComedor.php">
                                <span class="fas fa-utensils"></span>
                                Servicio de comedor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="buzonQuejas.php">
                                <span class="fas fa-mail-bulk"></span>
                                Buzon de quejas
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>


            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Buzon de quejas</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            This week
                        </button>
                    </div>
                </div>
                <canvas class="my-4 w-100" id="graficaQuejas" width="900" height="380"></canvas>
                <div id="tabla"> </div>

                <!-- Modal -->
                <div class="modal fade" id="detallesQueja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Reporte de queja</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="id">
                                <label for="">Asunto</label>
                                <input type="text" class="form-control" value="" id="asunto" disabled>
                                <label for="">Sector</label>
                                <input type="text" class="form-control" value="" id="area" disabled>
                                <label for="">Descripci√≥n</label>
                                <textarea cols="30" rows="10" class="form-control" id="desc" disabled></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-block" id="btnImprimir">Imprimir reporte en PDF</button>
                                <button type="button" class="btn btn-success btn-block" id="btnValidarQueja">Marcar como atendido</button>
                                <button type="button" class="btn btn-danger btn-block" id="btnInValidarQueja">Marcar como irrelevante</button>
                                <button type="button" class="btn btn-warning btn-block" id="btnNoLeidoQueja">Marcar como no leido</button>
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalGrafica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Reportes por area</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <canvas id="graficaQuejas"></canvas>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

                <script src="../lib/jquery-3.5.1.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.24/b-1.7.0/sl-1.3.3/datatables.min.js"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


                <script src="../JS/app.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {

                        $('#btnCerrarSesion').click(function() {
                            cerrarSesion();
                        });

                    });
                </script>
                <script src="../JS/controlReportesQuejas.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {

                        $('#tabla').load("vistasBuzon/tablaReportes.php");
                        $('.slcRep').load("vistasReportes/selectReportes.php");


                        $('#btnValidarQueja').click(function() {
                            marcarRepLeido();
                        });
                        $('#btnInValidarQueja').click(function() {
                            marcarRepInvalido();
                        });
                        $('#btnNoLeidoQueja').click(function() {
                            marcarRepNoLeido();
                        });
                        $('#btnImprimir').click(function() {
                            imprimirPDF();
                        });

                
                            crearGrafica();
                      

                        $('#btnEliminarReportesIrrelevantes').click(function() {
                            eliminarReportesIrrelevantes();
                        });

                    });
                </script>
</body>

</html>