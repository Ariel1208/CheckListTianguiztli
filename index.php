<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="lib/bootstrap4/bootstrap.min.css">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="description" content="Bienvenid@s ">
    
      <meta name="theme-color" content="#ff944d">
      <meta name="MobileOptimized" content="width">
      <meta name="HandheldFriendly" content="true">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
      <link rel="shortcut icon" type="image/png" href="./img/logo1.png">
      <link rel="apple-touch-icon" href="./logo1.png">
      <link rel="apple-touch-startup-image" href="./logo1.png">
      <link rel="manifest" href="./manifest.json">
    
      <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
      <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">

</head>

<body>
    <div class="wrapper ">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="img/logo1.png" id="icon" alt="Icon" />
                <h1>Tianguiztli</h1>
            </div>

            <!-- Login Form -->
            <form >
                <input type="text" id="user" class="fadeIn second" name="user" placeholder="Usuario" required="">
                <input type="password" id="pass" class="fadeIn third" name="pass" placeholder="Contraseña" required="">
                <button class="btn btn-warning" id="btnIniciarSesion" >Iniciar sesión</button>
            </form>

            <!-- Remind Passowrd -->

        </div>
    </div>
    <script src="lib/sweetalert.min.js"></script>
    <script src="lib/jquery-3.5.1.min.js"></script>
    <script src="JS/app.js"></script>
    <script src="./script.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {

        $('#btnIniciarSesion').click(function(event){
            event.preventDefault();
            iniciarSesionControlador();
        });
    
    });
    
    </script>
</body>


</html>