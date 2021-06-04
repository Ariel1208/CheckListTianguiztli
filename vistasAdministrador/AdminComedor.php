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
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link btn" id="btnCerrarSesion">Cerrar sesión</a>
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
                        <span>Administración de sistema</span>
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
                            <a class="nav-link active" href="AdminComedor.php">
                                <span class="fas fa-utensils"></span>
                                Servicio de comedor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="buzonQuejas.php">
                                <span class="fas fa-mail-bulk"></span>
                                Buzon de quejas
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Servicio de comedor</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary" id="btnVerPlatillos"><i class="fas fa-utensils"></i></button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">

                                </button>
                                <ul class="dropdown-menu">
                                    <span class="dropdown-item btn" onclick="abrirModalEncuesta()">Crear encuesta</span>
                                    <span class="dropdown-item btn" onclick="mosatrarTablaEncuestas()">Ver tabla de encuestas</span>
                                    <span class="dropdown-item btn" onclick="mosatrarPlatillos()">Ver platillos</span>
                                    <span class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#modalAgregarPlatillo">Agregar platillos</span>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-info" id="btnTablaUsuarios"><i class="fas fa-user-tie"></i></button>
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">

                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalAddUsuariosCocina">Agregar usuarios</a></li>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-success" id="btnTablaPagos"><i class="fas fa-coins"></i></button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">

                                </button>
                                <ul class="dropdown-menu">
                                    <li><span class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#canvaPagos" aria-controls="offcanvasRight">Crear total</span></li>
                                </ul>
                            </div>

                        </div>
                    
                    </div>
                </div>




                <div class="offcanvas offcanvas-end" tabindex="-1" id="canvaTop10" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header text-center">
                        <h5 id="offcanvasRightLabel">Top 10</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="table table-responsive">
                            <table class="table table-hover">
                                <thead style="text-align: center;">
                                    <th>No.</th>
                                    <th>Platillo</th>
                                    <th>No. de votos</th>
                                    <th></th>
                                </thead>
                                <tbody style="text-align: center;" id="tabla-platillosMasVotados">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="canvaPagos" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Historial de pagos</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <label for="">Fecha inicial</label>
                        <input type="date" class="form-control" id="fechaInicial">
                        <label for="">Fecha final</label>
                        <input type="date" class="form-control" id="fechaFinal">
                        <hr>
                        <div class="table table-responsive">
                            <table class="table table-hover" id="tablaCategoriaDataTable">
                                <thead style="text-align: center;">
                                    <th>Nombre</th>
                                    <th>Fecha de pago</th>
                                    <th>Total</th>
                                </thead>
                                <tbody style="text-align: center;" id="bodyTablaPagos">
                                </tbody>
                            </table>
                        </div>
                        <span class="btn btn-warning btn-block" id="btnCrearTotal"> Ver total </span>
                        <span class="btn btn-success btn-block" id="btnCrearPDF"> Imprimir </span>
                        <div id="reporte"></div>
                    </div>
                </div>
                <br>
                <div id="contenido"></div>

                <!-- MODALS PAGOS -->

                <div class="modal fade" id="modalTotales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Totales</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODALS USUARIOS -->

                <!-- Modal -->
                <div class="modal fade" id="modalAddUsuariosCocina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="frmDataUsuarios">
                                    <label for="">Imagen de usuario</label>
                                    <input type="file" name="archivo[]" id="archivo[]" class="form-control">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                    <label for="">Correo</label>
                                    <input type="text" class="form-control" id="correo" name="correo">
                                    <label for="">Contraseña</label>
                                    <input type="text" class="form-control" id="pass" name="pass">
                                    <label for="">Tipo de usuario</label>
                                    <select name="tipoUsuario" id="tipoUsuario" class="tipoUsuario form-control"></select>
                                    <input type="hidden" id="tipoOperacion" name="tipoOperacion" value="1">
                                </form>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary" id="btnAgregarUsuario">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalEditUsuariosCocina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="edit-id">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" id="edit-nombre">
                                <label for="">Correo</label>
                                <input type="text" class="form-control" id="edit-correo">
                                <label for="">Contraseña</label>
                                <input type="text" class="form-control" id="edit-pass">
                                <label for="">Tipo de usuario</label>
                                <select name="tipoUsuario-edit" id="tipoUsuario-edit" class="tipoUsuario form-control"></select>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary" id="btnEditarUsuario">Guardar</button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>Servicio de comedor</h5>
                                <label for="">Fecha inicial</label>
                                <input type="date" id="fechaIn" class="form-control">
                                <label for="">Fecha final</label>
                                <input type="date" id="fechaFi" class="form-control">
                                <input type="hidden" id="idUsuario" class="form-control">
                                <input type="hidden" id="tipOperacion" class="form-control">
                                <br>
                                <span class="btn btn-warning btn-block" id="btnGuardarRegistroPago">Registrar pago</span>
                                <hr>
                                <h5>Pago de adeudos</h5>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Historial de pagos</label>
                                <div class="table table-responsive">
                                    <table class="table table-hover" id="seguimientoPagos">
                                        <thead style="text-align: center;">
                                            <th>Fecha de pago</th>
                                            <th>De</th>
                                            <th>a</th>
                                            <th>Dias pagados</th>
                                            <th>Monto</th>
                                        </thead>
                                        <tbody style="text-align: center;" id="pagosCocina">
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <label for="">Historial de adeudos</label>
                                <div class="table table-responsive">
                                    <table class="table table-hover" id="tablaAdeudos">
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

                                <button type="button" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalActualizarFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cambiar imagen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="frmUpFoto">
                                    <input type="hidden" id="idFoto" name="idFoto" value="">
                                    <label for="">Imagen de usuario</label>
                                    <input type="file" name="archivo2[]" id="archivo2[]" class="form-control">
                                    <input type="hidden" id="tipoOperacion" name="tipoOperacion" value="2">
                                </form>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary" id="btnActualizarFoto">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="modalRegistrarAdeudo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registro de adeudos</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Fecha inicial</label>
                                <input type="date" id="fechaInAdeudo" class="form-control">
                                <label for="">Fecha final</label>
                                <input type="date" id="fechaFiAdeudo" class="form-control">
                                <input type="hidden" id="idUsuarioAdeudo" class="form-control">
                                <input type="hidden" id="tipOperacionAdeudo" class="form-control">
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-warning" id="btnRegistrarAdeudo">Continuar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODALS ENCUESTAS-->

                <!-- Modal -->
                <div class="modal fade" id="modalAgregarPlatillo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar platillo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formPlatillo">
                                    <input id="file" type="file" name="file" class="form-control">
                                    <hr>
                                    <div id="card" class="card" style="width: 18rem;">
                                        <img class="card-img-top" id="preview" src="" height="180px" alt="Previsualización">
                                    </div>
                                    <div id="preview"></div>
                                    <label for="">Nombre platillo</label>
                                    <input type="text" id="nombrePlatillo" name="nombrePlatillo" class="form-control">
                                    <label for="">Descripción</label>
                                    <input type="text" id="descripcionPlatillo" name="descripcionPlatillo" class="form-control">
                                    <label for="">Tipo</label>
                                    <select name="tipoPlatillo" class="form-control slc-tipo-edit"></select>
                                </form>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary" id="btnAgregarPlatillo">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="modalEditarPlatillo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar platillo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formPlatillo-edit">
                                    <input id="file-edit" type="file" name="file-edit" class="form-control">
                                    <hr>
                                    <div id="card-edit" class="card" style="width: 18rem;">
                                        <img class="card-img-top" id="preview-edit" src="" height="180px" alt="Previsualización">
                                    </div>
                                    <div id="preview"></div>
                                    <label for="">Nombre platillo</label>
                                    <input type="text" id="nombrePlatillo-edit" name="nombrePlatillo-edit" class="form-control">
                                    <label for="">Descripción</label>
                                    <input type="text" id="descripcionPlatillo-edit" name="descripcionPlatillo-edit" class="form-control">
                                    <label for="">Tipo</label>
                                    <select id="tipoPlatillo-edit" name="tipoPlatillo-edit" class="form-control slc-tipo-edit"></select>
                                    <input type="hidden" id="id-edit" name="id-edit" class="form-control">
                                </form>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary" id="btnEditarPlatillo">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="modalAgregarEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear encuesta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Fecha limite</label>
                                <input type="date" id="fechaLimiteEncuesta" name="" class="form-control" value="">
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary" id="btnCrearEncuesta">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalEditarEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar encuesta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="encuestaid" value="">
                                <label for="">Fecha limite</label>
                                <input type="date" id="fechaLimiteEncuesta-edit" class="form-control" value="">
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary" id="btnEditarEncuesta">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Modal -->
                <div class="modal fade" id="modalDetalleEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalles de encuesta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="barrasVotosEncuesta">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- MODALS PLATILLOS-->


                <!-- Modal -->
                <div class="modal fade" id="modalAgregarPlatillo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar platillo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formPlatillo">
                                    <input id="file" type="file" name="file" class="form-control">
                                    <hr>
                                    <div id="card" class="card" style="width: 18rem;">
                                        <img class="card-img-top" id="preview" src="" height="180px" alt="Previsualización">
                                    </div>
                                    <div id="preview"></div>
                                    <label for="">Nombre platillo</label>
                                    <input type="text" id="nombrePlatillo" name="nombrePlatillo" class="form-control">
                                    <label for="">Descripción</label>
                                    <input type="text" id="descripcionPlatillo" name="descripcionPlatillo" class="form-control">
                                    <label for="">Tipo</label>
                                    <select name="tipoPlatillo" class="form-control slc-tipo-edit"></select>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnAgregarPlatillo">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="modalEditarPlatillo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar platillo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formPlatillo-edit">
                                    <input id="file-edit" type="file" name="file-edit" class="form-control">
                                    <hr>
                                    <div id="card-edit" class="card" style="width: 18rem;">
                                        <img class="card-img-top" id="preview-edit" src="" height="180px" alt="Previsualización">
                                    </div>
                                    <div id="preview"></div>
                                    <label for="">Nombre platillo</label>
                                    <input type="text" id="nombrePlatillo-edit" name="nombrePlatillo-edit" class="form-control">
                                    <label for="">Descripción</label>
                                    <input type="text" id="descripcionPlatillo-edit" name="descripcionPlatillo-edit" class="form-control">
                                    <label for="">Tipo</label>
                                    <select id="tipoPlatillo-edit" name="tipoPlatillo-edit" class="form-control slc-tipo-edit"></select>
                                    <input type="hidden" id="id-edit" name="id-edit" class="form-control">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnEditarPlatillo">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="modalAgregarEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear encuesta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Fecha limite</label>
                                <input type="date" id="fechaLimiteEncuesta" name="" class="form-control" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnCrearEncuesta">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalEditarEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar encuesta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="encuestaid" value="">
                                <label for="">Fecha limite</label>
                                <input type="date" id="fechaLimiteEncuesta-edit" class="form-control" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnEditarEncuesta">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Modal -->
                <div class="modal fade" id="modalDetalleEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalles de encuesta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="barrasVotosEncuesta">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="modalTopEncuesta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Top 10</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table table-responsive">
                                    <table class="table table-hover">
                                        <thead style="text-align: center;">
                                            <th>No.</th>
                                            <th>Platillo</th>
                                            <th>No. de votos</th>
                                            <th></th>
                                        </thead>
                                        <tbody style="text-align: center;" id="tabla-platillosMasVotados">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Modal -->
                <div class="modal fade" id="modalVerParticipacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Votación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table table-responsive">
                                    <table class="table table-hover">
                                        <thead style="text-align: center;">
                                            <th>Usuario</th>
                                        </thead>
                                        <tbody style="text-align: center;" id="tabla-usuarios">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" id="btnClose">Cerrar</button>
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
                <script src="../JS/controlGraficas.js"></script>
                <script src="../JS/controlPlatillos.js"></script>
                <script src="../JS/files.js"></script>
                <script src="../JS/controlPlatillos.js"></script>
                <script src="../JS/files.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {

                        $('#barrasVotosEncuesta').load("vistasEncuestas/barrasEncuesta.php");

                        $('.slc-tipo-edit').load("vistasPlatillos/selectTipos.php");

                        $('#contenido').load("vistasPlatillos/cartasPlatillos.php");

                        $('#btnAgregarPlatillo').click(() => {
                            agregarPlatillo();
                        });

                        $('#btnEditarPlatillo').click(() => {
                            editarPlatillo();
                        });


                        $('#btnCrearEncuesta').click(() => {
                            crearEncuesta();
                        });

                        $('#btnEditarEncuesta').click(() => {
                            editarEncuesta();
                        });

                        $('#btnClose').click(() => {
                            $('#modalVerParticipacion').modal('hidden');
                        });

                    });
                </script>
                <script src="../JS/controlPagos.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#tabla').load("vistaspagos/historialPagos.php");


                        $('#btnCrearPDF').click(function() {
                            crearPDF();
                        });

                        $('#btnCrearTotal').click(function() {
                            crearTotal();
                        });
                    });
                </script>
                <script src="../JS/controlUsuariosCocina.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {

                        //$('#tablaReportes').load("vistasReportes/tablaReportes.php");
                        $('.slcUsu').load("vistasUsuariosCocina/selectUsuarios.php");
                        $('.tipoUsuario').load("vistasUsuariosCocina/selectTipo.php");
                        $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");




                        $('#btnPagarAdeudo').click(function() {
                            pagoPendientes();
                        });

                        $('#btnAgregarUsuario').click(function() {
                            agregarUsuario();
                        });

                        $('#btnEditarUsuario').click(function() {
                            editarUsuario();
                            $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");
                        });

                        $('#btnGuardarRegistroPago').click(function() {
                            agregarPagoCocina();
                        });
                        $('#btnVerTablaUsuarios').click(function() {
                            $('#tablaPrincipal').load("vistasUsuariosCocina/tablaUsuarios.php");

                        });

                        $("#btnActualizarFoto").click(function() {
                            actualizarFotoUsuario();
                        })

                        $("#btnRegistrarAdeudo").click(() => {
                            registrarAdeudo();
                        });



                    });
                </script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#contenido').load("vistasUsuariosCocina/tablaUsuarios.php");

                        $('#btnTablaPagos').click(function() {
                            $('#contenido').load("vistaspagos/historialPagos.php");
                        });

                        $('#btnTablaUsuarios').click(function() {
                            $('#contenido').load("vistasUsuariosCocina/tablaUsuarios.php");
                        });
                        $('#btnVerPlatillos').click(function() {
                            $('#contenido').load("vistasPlatillos/cartasPlatillos.php");
                        });

                        $('#btnCerrarSesion').click(function() {
                            cerrarSesion();
                        });

                    });
                </script>

</body>

</html>