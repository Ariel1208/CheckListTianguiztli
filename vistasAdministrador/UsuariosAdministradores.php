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

    <link href="../CSS/dashboard.css" rel="stylesheet">
    <!-- Custom styles for this template -->

</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="#">TIANGUIZTLI</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      
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
                            <a class="nav-link active" href="UsuariosAdministradores.php">
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
                            <a class="nav-link" href="AdminComedor.php">
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
                    <h1 class="h2">Control de usuarios</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria"><i class="fas fa-user-plus"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="btnVerUsuarios"><i class="fas fa-users"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="btnVerSectores"><i class="fas fa-bezier-curve"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalAddSectores"><i class="fas fa-plus"></i><i class="fas fa-bezier-curve"></i></button>
                        </div>

                    </div>
                </div>



                <div class="" id="tablaDatos">
                </div>



                <!-- Modal -->
                <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="text-align: center;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="frmAgregarUsuario">
                                    <div class="container">
                                        <div class="row">
                                            <label>Nombre</label>
                                            <input type="text" maxlength="45" name="nombre" id="nombre" class="form-control" required="">
                                            <div class="col-sm-6">
                                                <label>Apellido paterno</label>
                                                <input type="text" maxlength="45" name="apePaterno" id="apePaterno" class="form-control" required="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Apellido materno</label>
                                                <input type="text" maxlength="45" name="apeMaterno" id="apeMaterno" class="form-control" required="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Área</label>
                                                <select class="slcArea form-control" name="slc-area" id="slc-area" class="form-control">
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Rol</label>
                                                <select class="slcRol form-control" name="slc-roles" id="slc-roles">
                                                </select>
                                            </div>
                                            <label>Correo de usuario</label>
                                            <input type="text" maxlength="45" name="correoUsuario" id="correoUsuario" class="form-control" required="">
                                            </select>
                                            <label>Contraseña</label>
                                            <input type="password" maxlength="45" name="pass" id="pass" class="form-control" required="">
                                            <label>Confirmar contraseña</label>
                                            <input type="password" maxlength="45" name="pass2" id="pass2" class="form-control" required="">
                                            <input type="hidden" name="tipoOperacion" id="tipoOperacion" value="1">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="btnAgregarUsuario">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="modalActualizarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edición de usuarios</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="frmEditarUsuario">
                                    <div class="container">
                                        <div class="row">
                                            <label>Nombre</label>
                                            <input type="text" maxlength="45" name="edit-nombre" id="edit-nombre" class="form-control" required="">
                                            <div class="col-sm-6">
                                                <label>Apellido paterno</label>
                                                <input type="text" maxlength="45" name="edit-apePaterno" id="edit-apePaterno" class="form-control" required="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Apellido materno</label>
                                                <input type="text" maxlength="45" name="edit-apeMaterno" id="edit-apeMaterno" class="form-control" required="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Área</label>
                                                <select class="slcArea form-control" name="edit-slc-areas" id="edit-slc-areas">
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Rol</label>
                                                <select class="slcRol form-control" name="edit-slc-roles" id="edit-slc-roles">
                                                </select>
                                            </div>
                                            <label>Nombre de usuario</label>
                                            <input type="text" maxlength="45" name="edit-correoUsuario" id="edit-correoUsuario" class="form-control" required="">
                                            </select>
                                            <label>Contraseña</label>
                                            <input type="password" maxlength="45" name="edit-passUsuario" id="edit-passUsuario" class="form-control" required="">
                                            <label>Confirmar contraseña</label>
                                            <input type="password" maxlength="45" name="edit-passUsuario2" id="edit-passUsuario2" class="form-control" required="">
                                            <input type="hidden" name="edit-id" id="edit-id" value="">
                                            <input type="hidden" name="tipoOperacion" id="tipoOperacion" value="3">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="btnEditarUsuario">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- SECTORES MODALS -->


                <!-- Modal -->
                <div class="modal fade" id="modalAddSectores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Agregar sector</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="frmEditarUsuario">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre-sector" id="nombre-sector" class="form-control" required="">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="btnGuardarSector">Guardar</button>
                              
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalEditarSector" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Editar sector</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="frmEditarUsuario">
                                    <label>Nombre</label>
                                    <input type="text" name="edit-nombre-sector" id="edit-nombre-sector" class="form-control" required="">
                                    <input type="hidden" name="edit-id" id="edit-id" class="form-control" required="">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="btnEditarSector">Guardar</button>

                            </div>
                        </div>
                    </div>
                </div>

            </main>
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



    <script src="../lib/jspdf.min.js"></script>
    <script src="../JS/app.js"></script>
    <script src="../JS/controlUsuarios.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablaDatos').load("vistaUsuarios/tablaUsuarios.php");
            $('.slcRol').load("vistaUsuarios/selectRol.php");
            $('.slcArea').load("vistaUsuarios/selectArea.php");

            $('#btnVerSectores').click(function() {
                $('#tablaDatos').load("vistasSectores/tablaSectores.php");
            });

            $('#btnVerUsuarios').click(function() {
                $('#tablaDatos').load("vistaUsuarios/tablaUsuarios.php");
            });

            $('#btnAgregarUsuario').click(function() {
                agregarUsuario();
            });

            $('#btnEditarUsuario').click(function() {
                actualizarDatosUsuarios();
            });

            $('#btnCerrarSesion').click(function() {
                cerrarSesion();
            });

        });
    </script>
    <script src="../JS/controlSectores.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablaSectores').load("vistasSectores/tablaSectores.php");
            $('.slcRol').load("vistaUsuarios/selectRol.php");
            $('.slcArea').load("vistaUsuarios/selectArea.php");

            $('#btnGuardarSector').click(function() {
                agregarSector();
            });

            $('#btnEditarSector').click(function() {
                editarSector();
            });


        });
    </script>
</body>

</html>