<?php

session_start();
require_once "../clases/conexion.php";

$tip = $_POST['tipoOperacion'];
$idUsuario = $_SESSION['ID_US'];

switch ($tip) {
    case 'addEvidencias':
        $id = $_POST['edit-id'];
        $salida = 0;

        if ($_FILES['archivo']['size'] > 0) {

            $c = new conectar();
            $conexion = $c->conexion();

            $carpetaReporte = '../carpetaEvidencias/' . $id;
            if (!file_exists($carpetaReporte)) {
                mkdir($carpetaReporte, 0777, true);
            }

            for ($i = 0; $i < count($_FILES['archivo']['name']); $i++) {

                $nombreArchivo = $_FILES['archivo']['name'][$i];
                $explode = explode('.', $nombreArchivo);
                $tipoArchivo = array_pop($explode);

                $nombreNuevo = str_replace(" ", "_", $nombreArchivo);

                $rutaAlmacenamiento = $_FILES['archivo']['tmp_name'][$i];

                $rutaFinal = $carpetaReporte . "/" . $nombreNuevo;

                $sql = "SELECT count(*) AS Cantidad FROM evidencias_reporte WHERE nombre='$nombreNuevo' and id_reporte='$id'";
                $consulta = mysqli_query($conexion, $sql);
                $data = mysqli_fetch_array($consulta);

                if ($data['Cantidad'] > 0) {
                    $salida = 2;
                } else {

                    if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {


                        $sql = "INSERT INTO evidencias_reporte(nombre, ruta, extencion, id_reporte) VALUES ('$nombreNuevo','$rutaFinal','$tipoArchivo','$id')";

                        $respuesta = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                        $salida = 1;
                    } else {
                        echo "Error al mover los archivos";
                        echo $rutaAlmacenamiento;
                        $salida = 0;
                    }
                }
            }

            echo $salida;
        }


        break;
    case 'eliminarEvidencia':
        $idArchivo = $_POST['id'];

        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT* FROM evidencias_reporte WHERE id_archivo = '$idArchivo'";

        $respuesta = mysqli_query($conexion, $sql);
        echo mysqli_error($conexion);

        $filas = mysqli_fetch_array($respuesta);


        $rutaEliminar = $filas['ruta'];
        if (unlink($rutaEliminar)) {
            $sql = "DELETE FROM evidencias_reporte WHERE id_archivo = '$idArchivo'";

            $respuesta = mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);
            echo $respuesta;
        } else {
            echo 0;
        }
        break;
    case 'verEvidencia':
        $id = $_POST['id'];

        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT* FROM evidencias_reporte WHERE id_archivo = '$id'";

        $respuesta = mysqli_query($conexion, $sql);
        echo mysqli_error($conexion);

        $filas = mysqli_fetch_assoc($respuesta);

        echo json_encode($filas);
        die();

        break;
}
