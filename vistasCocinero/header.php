<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckList</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../lib/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
    <link rel="stylesheet" href="../lib/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../CSS/formCarpetasCompartidas.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="../lib/jspdf.min.js"></script>
    <script src="../lib/jspdf.plugin.autotable.min.js"></script>
    <script src="../lib/Chart.js"></script>
    <script src="../JS/navbar.js"></script>
</head>

<body id="page-top" class="index">
  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-color navbar-fixed-top navbar-expand-lg static-top">
      <div class="container">
      <a class="navbar-brand" href="inicio.php">
          <img src="../img/logo1.png" alt="" width="50px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fas fa-bars" style="color:white"></span>
        </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
              <li class="page-scroll">
                  <?php 
                        $id_CO=$_SESSION['ID_CO'];
                        $id_Rol=$_SESSION['ROL'];
                        $id_us=$_SESSION['ID_US'];
                      ?>
                    <a class="nav-link" href="https://cocina.checklist.tianguiztli.com/index.php?ID_CO=<?php echo $id_CO ?>&ROL=<?php echo $id_Rol ?>&id_us=<?php echo $id_us ?>" style="color: orange">Mi servicio de cocina</a>
                  </li>
                  <li class="page-scroll">
                    <a class="nav-link" href="controlMenu.php">Publicación de menus</a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Asistencia
                      </a>
                      <div class="dropdown-menu" style="background-color:#212121;" aria-labelledby="navbarDropdown">
                          <div class="dropdown-divider"></div>
                          <a class="nav-link" href="inicio.php">Registro de asistencia</a>
                          <div class="dropdown-divider"></div>
                      </div>
                  </li>
                  <li class="page-scroll">
                    <a class="nav-link" href="controlPlatillos.php">Platillos</a>
                  </li>
                  <li class="page-scroll">
                    <a class="nav-link" href="#"id="btnCerrarSesion" style="color: orange">Salir</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
</body>