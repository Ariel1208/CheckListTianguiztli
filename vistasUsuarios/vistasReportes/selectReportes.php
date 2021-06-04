<?php
    
    session_start();
    require_once "../../clases/conexion.php";


    $c = new conectar();
    $conexion = $c->conexion();

    $sql="SELECT* FROM reporte ";

    $result = mysqli_query($conexion,$sql);
    
?>

    <?php
        while($mostrar= mysqli_fetch_array($result)){
            $id=$mostrar['id_reporte'];
    ?>
        <option value="<?php echo $id?>"><?php echo $mostrar['nombre_reporte'] ?></option>
    <?php
        }
    ?>
