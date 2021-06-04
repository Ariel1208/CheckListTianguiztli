<?php
    
    session_start();
    require_once "../../clases/conexion.php";


    $c = new conectar();
    $conexion = $c->conexion();

    $sql="SELECT* FROM categorias_inventario ";

    $result = mysqli_query($conexion,$sql);
    
?>

    <?php
        while($mostrar= mysqli_fetch_array($result)){
            $id=$mostrar['id_categoria'];
    ?>
        <option value="<?php echo $id?>"><?php echo $mostrar['categoria'] ?></option>
    <?php
        }
    ?>
