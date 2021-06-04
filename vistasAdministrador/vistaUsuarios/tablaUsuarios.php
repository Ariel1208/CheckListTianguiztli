<?php

    session_start();
    $idUsuario=$_SESSION['ID_US'];
    if($_SESSION['ID_US']){
        ?>
            <div id="obtenerUsuarios"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('#obtenerUsuarios').load("vistaUsuarios/obtenerUsuarios.php");
                });
            </script>
    <?php
        
    }
    
?>


