<?php

session_start();
require_once "../../clases/conexion.php";


$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT* FROM plantilla ";

$result = mysqli_query($conexion, $sql);

?>

<?php
while ($mostrar = mysqli_fetch_array($result)) {
    $id = $mostrar['id_plantilla'];
?>
    <option value="<?php echo $id ?>"><?php echo $mostrar['nombre'] ?></option>
<?php
}
?>