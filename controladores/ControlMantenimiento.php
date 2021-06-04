<?php

session_start();
require_once "../clases/conexion.php";

$tip = $_POST['tipoOperacion'];
$idUsuario = $_SESSION['ID_US'];

$c = new conectar();
$conexion = $c->conexion();

switch ($tip) {
    case 'agregarRegistro':
        $fechaInicial = $_POST['fechaInicial'];
        $fechaFinal = $_POST['fechaFinal'];
        $listaDias = json_decode($_POST['listaDias']);
        $listaActividades = json_decode($_POST['listaActividades']);
        $cantidadDias = COUNT($listaDias);

        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "INSERT INTO registro_mantenimiento (fecha_inicial,fecha_final) VALUES ('$fechaInicial','$fechaFinal')";
        mysqli_query($conexion, $sql);
        echo mysqli_error($conexion);
        $idConsulta = mysqli_insert_id($conexion);

        $sql = "INSERT INTO configuracion_lista_mantenimiento (cantidad_dias,id_mantenimiento) VALUES ('$cantidadDias','$idConsulta')";
        mysqli_query($conexion, $sql);
        echo mysqli_error($conexion);
        $idConsulta2 = mysqli_insert_id($conexion);

        for ($i = 0; $i < $cantidadDias; $i++) {
            $dia = $listaDias[$i];
            switch ($dia) {
                case 'L':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Lunes = 1 WHERE id_configuracion = '$idConsulta2'";
                    mysqli_query($conexion, $sql);
                    break;
                case 'M':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Martes = 1 WHERE id_configuracion = '$idConsulta2'";
                    mysqli_query($conexion, $sql);
                    break;
                case 'MI':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Miercoles = 1 WHERE id_configuracion = '$idConsulta2'";
                    mysqli_query($conexion, $sql);
                    break;
                case 'J':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Jueves = 1 WHERE id_configuracion = '$idConsulta2'";
                    mysqli_query($conexion, $sql);
                    break;
                case 'V':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Viernes = 1 WHERE id_configuracion = '$idConsulta2'";
                    mysqli_query($conexion, $sql);
                    break;
                    echo "Error";
                    return false;
                default:
                    # code...
                    break;
            }
        }

        for ($i = 0; $i < COUNT($listaActividades); $i++) {
            $actividad = $listaActividades[$i];

            $sql = "INSERT INTO detalle_mantenimiento (id_mantenimiento,Actividad) VALUES ('$idConsulta','$actividad')";
            mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);
        }
        echo 1;

        break;
    case 'editarRegistro':
        $id = $_POST['id'];
        $fechaInicial = $_POST['fechaInicial'];
        $fechaFinal = $_POST['fechaFinal'];
        $listaDias = json_decode($_POST['listaDias']);
        $listaActividades = json_decode($_POST['listaActividades']);
        $cantidadDias = COUNT($listaDias);

        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "UPDATE registro_mantenimiento SET fecha_inicial='$fechaInicial',fecha_final='$fechaFinal' WHERE id_mantenimiento='$id'";
        mysqli_query($conexion, $sql);
        echo mysqli_error($conexion);

        $sql = "UPDATE configuracion_lista_mantenimiento SET cantidad_dias='$cantidadDias',Lunes=0,Martes=0,Miercoles=0,Jueves=0,Viernes=0 WHERE id_mantenimiento='$id'";
        mysqli_query($conexion, $sql);
        echo mysqli_error($conexion);

        $dias = ["L", "M", "MI", "J", "V"];

        for ($i = 0; $i < COUNT($dias); $i++) {
            $dia = $dias[$i];
            if (!in_array($dia, $listaDias)) {
                switch ($dia) {
                    case 'L':
                        $sql = "UPDATE detalle_mantenimiento SET Lunes = 0 WHERE id_mantenimiento = '$id'";
                        mysqli_query($conexion, $sql);
                        break;
                    case 'M':
                        $sql = "UPDATE detalle_mantenimiento SET Martes = 0 WHERE id_mantenimiento = '$id'";
                        mysqli_query($conexion, $sql);
                        break;
                    case 'MI':
                        $sql = "UPDATE detalle_mantenimiento SET Miercoles = 0 WHERE id_mantenimiento = '$id'";
                        mysqli_query($conexion, $sql);
                        break;
                    case 'J':
                        $sql = "UPDATE detalle_mantenimiento SET Jueves = 0 WHERE id_mantenimiento = '$id'";
                        mysqli_query($conexion, $sql);
                        break;
                    case 'V':
                        $sql = "UPDATE detalle_mantenimiento SET Viernes = 0 WHERE id_mantenimiento = '$id'";
                        mysqli_query($conexion, $sql);
                        break;
                        echo "Error";
                        return false;
                    default:

                        break;
                }
            }
        }

        for ($i = 0; $i < $cantidadDias; $i++) {
            $dia = $listaDias[$i];

            switch ($dia) {
                case 'L':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Lunes = 1 WHERE id_mantenimiento = '$id'";
                    mysqli_query($conexion, $sql);
                    break;
                case 'M':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Martes = 1 WHERE id_mantenimiento = '$id'";
                    mysqli_query($conexion, $sql);
                    break;
                case 'MI':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Miercoles = 1 WHERE id_mantenimiento = '$id'";
                    mysqli_query($conexion, $sql);
                    break;
                case 'J':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Jueves = 1 WHERE id_mantenimiento = '$id'";
                    mysqli_query($conexion, $sql);
                    break;
                case 'V':
                    $sql = "UPDATE configuracion_lista_mantenimiento SET Viernes = 1 WHERE id_mantenimiento = '$id'";
                    mysqli_query($conexion, $sql);
                    break;
                    echo "Error";
                    return false;
                default:

                    break;
            }
        }



        $idMantenimiento = [];

        for ($i = 0; $i < COUNT($listaActividades); $i += 2) {
            $idDetalle = $listaActividades[$i];
            $actividad = $listaActividades[$i + 1];

            if ($listaActividades[$i] != 0) {
                $sql = "UPDATE detalle_mantenimiento SET Actividad='$actividad' WHERE id_detalle = '$idDetalle'";
                $consulta = mysqli_query($conexion, $sql);
                echo mysqli_error($conexion);
            } else if ($listaActividades[$i] == 0) {
                $sql = "INSERT INTO detalle_mantenimiento (id_mantenimiento,Actividad) VALUES ('$id','$actividad')";
                $consulta = mysqli_query($conexion, $sql);
                echo mysqli_error($conexion);
            }
        }

        echo 1;

        break;
    case 'editarSeguimiento':
        $id = $_POST['id'];
        $observaciones = $_POST['observaciones'];
        $lu = json_decode($_POST['lunes']);
        $ma = json_decode($_POST['martes']);
        $mi = json_decode($_POST['miercoles']);
        $ju = json_decode($_POST['jueves']);
        $vi = json_decode($_POST['viernes']);

        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "UPDATE registro_mantenimiento SET observaciones='$observaciones' WHERE id_mantenimiento='$id'";
        mysqli_query($conexion, $sql);
        echo mysqli_error($conexion);

        if (empty($lu)) {
            $sql = "UPDATE detalle_mantenimiento SET Lunes=0 WHERE id_mantenimiento='$id'";
            mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);
        } else {
            $sql = "SELECT id_detalle FROM detalle_mantenimiento WHERE id_mantenimiento='$id'";
            $consulta = mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);

            while ($fila = mysqli_fetch_assoc($consulta)) {
                for ($i = 0; $i < count($lu); $i++) {
                    if (in_array($fila['id_detalle'], $lu)) {
                        $idDet = $lu[$i];
                        $sql = "UPDATE detalle_mantenimiento SET Lunes=1 WHERE id_mantenimiento='$id' and id_detalle ='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    } else {
                        $idDet = $fila['id_detalle'];
                        $sql = "UPDATE detalle_mantenimiento SET Lunes=0 WHERE id_mantenimiento='$id' and id_detalle='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    }
                }
            }
        };

        if (empty($ma)) {
            $sql = "UPDATE detalle_mantenimiento SET Martes=0 WHERE id_mantenimiento='$id'";
            mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);
        } else {
            $sql = "SELECT id_detalle FROM detalle_mantenimiento WHERE id_mantenimiento='$id'";
            $consulta = mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);

            while ($fila = mysqli_fetch_assoc($consulta)) {
                for ($i = 0; $i < count($ma); $i++) {
                    if (in_array($fila['id_detalle'], $ma)) {
                        $idDet = $ma[$i];
                        $sql = "UPDATE detalle_mantenimiento SET Martes=1 WHERE id_mantenimiento='$id' and id_detalle ='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    } else {
                        $idDet = $fila['id_detalle'];
                        $sql = "UPDATE detalle_mantenimiento SET Martes=0 WHERE id_mantenimiento='$id' and id_detalle='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    }
                }
            }
        };

        if (empty($mi)) {
            $sql = "UPDATE detalle_mantenimiento SET Miercoles=0 WHERE id_mantenimiento='$id'";
            mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);
        } else {
            $sql = "SELECT id_detalle FROM detalle_mantenimiento WHERE id_mantenimiento='$id'";
            $consulta = mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);

            while ($fila = mysqli_fetch_assoc($consulta)) {
                for ($i = 0; $i < count($mi); $i++) {
                    if (in_array($fila['id_detalle'], $mi)) {
                        $idDet = $mi[$i];
                        $sql = "UPDATE detalle_mantenimiento SET Miercoles=1 WHERE id_mantenimiento='$id' and id_detalle ='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    } else {
                        $idDet = $fila['id_detalle'];
                        $sql = "UPDATE detalle_mantenimiento SET Miercoles=0 WHERE id_mantenimiento='$id' and id_detalle='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    }
                }
            }
        };

        if (empty($ju)) {
            $sql = "UPDATE detalle_mantenimiento SET Jueves=0 WHERE id_mantenimiento='$id'";
            mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);
        } else {
            $sql = "SELECT id_detalle FROM detalle_mantenimiento WHERE id_mantenimiento='$id'";
            $consulta = mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);

            while ($fila = mysqli_fetch_assoc($consulta)) {
                for ($i = 0; $i < count($ju); $i++) {
                    if (in_array($fila['id_detalle'], $ju)) {
                        $idDet = $ju[$i];
                        $sql = "UPDATE detalle_mantenimiento SET Jueves=1 WHERE id_mantenimiento='$id' and id_detalle ='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    } else {
                        $idDet = $fila['id_detalle'];
                        $sql = "UPDATE detalle_mantenimiento SET Jueves=0 WHERE id_mantenimiento='$id' and id_detalle='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    }
                }
            }
        };

        if (empty($vi)) {
            $sql = "UPDATE detalle_mantenimiento SET Viernes=0 WHERE id_mantenimiento='$id'";
            mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);
        } else {
            $sql = "SELECT id_detalle FROM detalle_mantenimiento WHERE id_mantenimiento='$id'";
            $consulta = mysqli_query($conexion, $sql);
            echo mysqli_error($conexion);

            while ($fila = mysqli_fetch_assoc($consulta)) {
                for ($i = 0; $i < count($vi); $i++) {
                    if (in_array($fila['id_detalle'], $vi)) {
                        $idDet = $vi[$i];
                        $sql = "UPDATE detalle_mantenimiento SET Viernes=1 WHERE id_mantenimiento='$id' and id_detalle ='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    } else {
                        $idDet = $fila['id_detalle'];
                        $sql = "UPDATE detalle_mantenimiento SET Viernes=0 WHERE id_mantenimiento='$id' and id_detalle='$idDet'";
                        $resp = mysqli_query($conexion, $sql);
                        echo mysqli_error($conexion);
                    }
                }
            }
        };


        echo 1;



        break;
    case 'eliminarRegistro':
        $id = $_POST['id'];

        $sql = "SELECT COUNT(*) FROM evidencia_mantenimiento WHERE id_mantenimiento='$id'";
        $respuesta = mysqli_query($conexion, $sql);
        $CANTIDAD = mysqli_fetch_array($respuesta);

        if ($CANTIDAD > 0) {
            $sql = "SELECT* FROM evidencia_mantenimiento WHERE id_mantenimiento='$id'";
            $respuesta = mysqli_query($conexion, $sql);
            while ($fila = mysqli_fetch_assoc($respuesta)) {
                print_r($fila);
                $direccion = $fila['ruta'];
                $idEvidencia = $fila['id_evidencia'];
                (unlink($direccion));
            }
            $sql = "DELETE FROM evidencia_mantenimiento WHERE id_mantenimiento='$id'";
            $respuesta = mysqli_query($conexion, $sql);
        }


        $directorio = "../carpetaEvidenciasMantenimiento/" . $id;

        if (file_exists($directorio)) {
            rmdir($directorio);
        }
        $sql = "DELETE FROM configuracion_lista_mantenimiento WHERE id_mantenimiento='$id'";
        mysqli_query($conexion, $sql);
        $sql = "DELETE FROM detalle_mantenimiento WHERE id_mantenimiento='$id'";
        mysqli_query($conexion, $sql);
        $sql = "DELETE FROM registro_mantenimiento WHERE id_mantenimiento='$id'";
        mysqli_query($conexion, $sql);
        echo 1;


        break;
    case 'agregarActividadBitacora':

        $actividad = $_POST['actividad'];

        if ($actividad != "") {
            $sql = "SELECT COUNT(*) as cantidad FROM actividades_mantenimiento WHERE actividad='$actividad'";
            $respuesta = mysqli_query($conexion, $sql);
            $CANTIDAD = mysqli_fetch_array($respuesta);

            if ($CANTIDAD['cantidad'] == 0) {
                $sql = "INSERT INTO actividades_mantenimiento (actividad) VALUES ('$actividad')";
                $respuesta = mysqli_query($conexion, $sql);
                echo "Actividad guardada exitosamente";
            } else {
                echo "Esta actividad ya esta registrada";
            }
        }


        break;
    case 'eliminarActividadBitacora':
        $id = $_POST['id'];

        $sql = "SELECT COUNT(*) as cantidad FROM bitacora_mantenimiento WHERE id_actividad='$id'";
        $respuesta = mysqli_query($conexion, $sql);
        $CANTIDAD = mysqli_fetch_array($respuesta);

        if ($CANTIDAD['cantidad'] == 0) {
            $sql = "DELETE FROM actividades_mantenimiento WHERE id_actividad = '$id'";
            $respuesta = mysqli_query($conexion, $sql);
            echo "Actividad eliminada exitosamente";
        } else {
            echo "Hay registros en bitacora con esta actividad, asegurate de eliminarlos antes de quitar esta actividad";
        }
        break;
    case 'agregarRegistroBitacora':

        $encargado = $_POST['encargado'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $actividad = $_POST['actividad'];
        $observaciones = $_POST['observaciones'];


        $sql = "INSERT INTO bitacora_mantenimiento (id_actividad,id_encargado, observaciones,fecha,hora) VALUES ('$actividad','$encargado','$observaciones','$fecha','$hora')";
        $respuesta = mysqli_query($conexion, $sql);
        if ($respuesta == 1) {
            echo 'Registro agregado exitosamente';
        } else {
            echo 'Error al agregar el registro';
        }
        break;
    default:
        # code...
        break;
}
