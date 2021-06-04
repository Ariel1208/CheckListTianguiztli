<?php
session_start();
$idUsuario=$_SESSION['ID_US'];
if($_SESSION['ID_US']){
        require_once "../../clases/conexion.php";
        $c= new conectar();
        $c=$c->conexion(); 
        
        $totalCartas = 0;
        ?>
        <div class="row">
        
        <?php
         $sql = "SELECT * FROM lista_servicio_cocina a INNER JOIN seguimiento_pagos b ON a.id_usuario = b.id_usuario WHERE b.fecha_inicial<= now() and b.fecha_final>=now()";
         $result = mysqli_query($c, $sql);
          
          while($mostrar = mysqli_fetch_array($result)){
              $totalCartas ++;
          $idUsu=$mostrar['id_usuario'];
          $img=$mostrar['ruta_imagen'];
          if($img=='sin'){
              $img="../imagenesUsuarios/anonimo.png";
          }
        ?>
            <div class="col-sm-4">
                <div class="card" style="width: 14rem;">
                    <img class="card-img-top" src="<?php echo $img?>" height="180px" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $mostrar['nombre'] ?></h5>
                    </div>
                </div>
            </div>
            <br>
        <?php
        }
        ?>
        </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#tablaCategoriaDataTable').DataTable();

    });
</script>

<?php
    
}
?>
