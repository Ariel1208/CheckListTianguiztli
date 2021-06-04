<?php
    
    session_start();
    require_once "../../clases/conexion.php";


    $c = new conectar();
    $conexion = $c->conexion();

    $sql="SELECT* FROM area ";

    $result = mysqli_query($conexion,$sql);
    
?>

    <?php
        while($mostrar= mysqli_fetch_array($result)){
            $id_area=$mostrar['id_area'];
    ?>
        <option value="<?php echo $id_area?>"><?php echo $mostrar['area'] ?></option>
    <?php
        }
    ?>
