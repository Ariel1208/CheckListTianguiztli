<?php

    session_start();
    require_once "../clases/conexion.php";

    $tip=$_POST['tipoOperacion'];
    $idUsuario=$_SESSION['ID_US'];

    $c = new conectar();
    $conexion = $c->conexion();

    switch ($tip) {
        case 'agregarEvidencia':
            $idMantenimiento = $_POST['idMantenimiento-evidencias'];

            if($_FILES['file']['name'] != null){
                
                    
                $rutaImagen="../carpetaEvidenciasMantenimiento/".$idMantenimiento;

                if(!file_exists($rutaImagen)){
                    mkdir($rutaImagen,0777,true);
                }

                $nombreArchivo = $_FILES['file']['name'];
                $explode = explode('.',$nombreArchivo);
                $tipoArchivo =array_pop($explode);

                $nombreNuevo = str_replace(" ","_",$nombreArchivo); 

                $rutaAlmacenamiento =$_FILES['file']['tmp_name'];
                
                $rutaFinal=$rutaImagen."/".$nombreNuevo;

                $sql = "SELECT COUNT(*) AS cantidad FROM evidencia_mantenimiento WHERE ruta = '$rutaFinal'";
                $respuesta = mysqli_query($conexion,$sql);

                $data=mysqli_fetch_array($respuesta);
                if($data['cantidad']>0){
                    echo 2;
                }else{
                    if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
                        $sql = "INSERT INTO evidencia_mantenimiento (evidencia,ruta,extencion,id_mantenimiento) VALUES ('$nombreNuevo','$rutaFinal','$tipoArchivo','$idMantenimiento')";
                        $respuesta = mysqli_query($conexion,$sql);
                        echo mysqli_error($conexion);
                        echo 1;
                        
                    }else{
                        echo "Error al mover los archivos";
                        echo $rutaAlmacenamiento;
                        echo 0;
                    }
                }
            }else{
                echo 3;
            }
        break;
        case 'eliminarEvidencia':
            $id = $_POST['id'];

            $sql = "SELECT* FROM evidencia_mantenimiento WHERE id_evidencia='$id'";
            $respuesta = mysqli_query($conexion,$sql);
            $data = mysqli_fetch_array($respuesta);

            $direccion = $data['ruta'];
            if (unlink($direccion)){
                $sql = "DELETE FROM evidencia_mantenimiento WHERE id_evidencia='$id'";
                $respuesta = mysqli_query($conexion,$sql);
                echo $respuesta;
            }
        break;
        default:
            # code...
            break;
    }