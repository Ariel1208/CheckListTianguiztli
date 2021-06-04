<?php
    
    session_start();
    require_once "../../clases/conexion.php";


    $c = new conectar();
    $conexion = $c->conexion();

    $sql="SELECT* FROM sectores ";

    $result = mysqli_query($conexion,$sql);
    
?>

    <?php
        while($mostrar= mysqli_fetch_array($result)){
            $id=$mostrar['id_sector'];
    ?>
        <option value="<?php echo $id?>"><?php echo $mostrar['sector'] ?></option>
    <?php
        }
    ?>
