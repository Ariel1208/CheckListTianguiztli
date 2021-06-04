<?php
    
    session_start();
    require_once "../../clases/conexion.php";


    $c = new conectar();
    $conexion = $c->conexion();

    $sql="SELECT* FROM platillos_cocina WHERE tipo_platillo=2";

    $result = mysqli_query($conexion,$sql);
    
?>

    <?php
        while($mostrar= mysqli_fetch_array($result)){
            $id=$mostrar['id_platillo'];
    ?>
        <option value="<?php echo $id?>"><?php echo $mostrar['nombre_platillo'] ?></option>
    <?php
        }
    ?>
