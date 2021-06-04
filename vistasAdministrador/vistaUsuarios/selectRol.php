<?php
    
    session_start();
    require_once "../../clases/conexion.php";


    $c = new conectar();
    $conexion = $c->conexion();

    $sql="SELECT* FROM rol ";

    $result = mysqli_query($conexion,$sql);
    
?>

    <?php
        while($mostrar= mysqli_fetch_array($result)){
            $id_area=$mostrar['id_rol'];
    ?>
        <option value="<?php echo $id_area?>"><?php echo $mostrar['rol'] ?></option>
    <?php
        }
    ?>
