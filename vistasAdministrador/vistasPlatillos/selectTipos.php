<?php
    
    session_start();
    require_once "../../clases/conexion.php";


    $c = new conectar();
    $conexion = $c->conexion();

    $sql="SELECT* FROM tipo_platillo";

    $result = mysqli_query($conexion,$sql);
    
?>

    <?php
        while($mostrar= mysqli_fetch_array($result)){
            $id=$mostrar['id_tipo'];
    ?>
        <option value="<?php echo $id?>"><?php echo $mostrar['tipo'] ?></option>
    <?php
        }
    ?>
