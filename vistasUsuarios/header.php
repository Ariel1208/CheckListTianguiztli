<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>TIANGUIZTLI</title>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../CSS/navbar.css">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

  <!-- Font Awesome JS -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <script src="bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>
  <link href="bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet">
</head>

<body>

  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header text-center">
        <h3>TIANGUIZTLI</h3>
      </div>

      <ul class="list-unstyled components ">

        <li class="">
          <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <i class="fas fa-user-alt"></i> Perfil</a>
          <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
              <a href="#">Cambiar contraseña</a>
            </li>
            <li>
              <a href="https://accounts.google.com/o/oauth2/auth/oauthchooseaccount?response_type=code&access_type=offline&client_id=359394619942-1dsba24dahq06m1mtsdrp6atq7spu7gd.apps.googleusercontent.com&redirect_uri=urn%3Aietf%3Awg%3Aoauth%3A2.0%3Aoob&state&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fcalendar.readonly&prompt=select_account%20consent&flowName=GeneralOAuthFlow">Mi servicio de cocina</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="controlMantenimiento.php"><i class="fas fa-cogs"></i> Mantenimiento</a>
        </li>
        <li>
          <a href="controlBitacoraMantenimiento.php"><i class="fas fa-clipboard-list"></i> Bitacora de mantenimiento</a>
        </li>
        <li>
          <a href="inicio.php"><i class="fas fa-tasks"></i> Listas de chequeo</a>
        </li>
        <li>
          <a href="controlPlantillas.php"><i class="fas fa-paste"></i> Plantillas de chequeo</a>
        </li>
        <li>
          <a href="controlGraficas.php"><i class="fas fa-chart-bar"></i> Estadisticas</a>
        </li>
      </ul>

      <!--
      <ul class="list-unstyled CTAs">
        <li>
          <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
        </li>
        <li>
          <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
        </li>
      </ul>
      -->
    </nav>