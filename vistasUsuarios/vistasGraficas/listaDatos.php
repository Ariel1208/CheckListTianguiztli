<?php

session_start();
require_once "../../clases/conexion.php";


$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT* FROM actividades_mantenimiento ORDER BY id_actividad DESC";

$result = mysqli_query($conexion, $sql);

?>

<?php
while ($mostrar = mysqli_fetch_array($result)) {
    $id = $mostrar['id_actividad'];
?>
    <option value="<?php echo $id ?>"><?php echo $mostrar['actividad'] ?></option>
<?php
}
?>