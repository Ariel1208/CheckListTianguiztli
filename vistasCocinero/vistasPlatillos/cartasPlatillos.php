<?php
session_start();
$idUsuario=$_SESSION['ID_US'];
if($_SESSION['ID_US']){
        require_once "../../clases/conexion.php";
        $c= new conectar();
        $c=$c->conexion(); 
        ?>
        <div class="row">
        <?php
         $sql = "SELECT* FROM platillos_cocina a INNER JOIN tipo_platillo b ON a.tipo_platillo=b.id_tipo ORDER BY id_platillo DESC";
         $result = mysqli_query($c, $sql);
          
          while($mostrar = mysqli_fetch_array($result)){
          $id=$mostrar['id_platillo'];
          $img=$mostrar['imagen'];
          if($img=='sin'){
              $img="../imagenesPlatillos/sinImagen.jpg";
          }
        ?>
            <div class="col-sm-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo $img?>" height="180px" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $mostrar['nombre_platillo'] ?></h5>
                        <p class="card-text"><?php echo $mostrar['descripcion'] ?></p>
                        <hr>
                        <p class="card-text"><?php echo $mostrar['tipo'] ?></p>
                        
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" onclick="obtenerDatosPlatillo(<?php echo $id?>)" type="button" data-toggle="modal" data-target="#modalEditarPlatillo">Editar</button>
                            <button class="dropdown-item" onclick="eliminarPlatillo(<?php echo $id?>)" type="button">Eliminar</button>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <br>
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
