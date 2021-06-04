<?php
     session_start();
     require_once "../clases/conexion.php";
 
     $tip=$_POST['tipoOperacion'];
     $idUsuario=$_SESSION['ID_US'];
 
     $c = new conectar();
     $conexion = $c->conexion();
     
    
     switch ($tip) {
         case 'agregarPlatillo':
             $nombrePlatillo= $_POST['nombrePlatillo'];
             $descripcion= $_POST['descripcionPlatillo'];
             $tipoPlatillo= $_POST['tipoPlatillo'];
            
             if($_FILES['file']['name'] != null){

                $sql = "SELECT count(*) AS Cantidad FROM platillos_cocina WHERE nombre_platillo='$nombrePlatillo'";
                $consulta = mysqli_query($conexion,$sql);
                $data = mysqli_fetch_array($consulta);

                if($data['Cantidad']<1){
                    $sql = "INSERT INTO platillos_cocina (nombre_platillo,descripcion,tipo_platillo) VALUES ('$nombrePlatillo','$descripcion','$tipoPlatillo')";
                    $consulta = mysqli_query($conexion,$sql);

                    $idConsulta=mysqli_insert_id($conexion);
                    
                    $rutaRelativa="imagenesPlatillos/".$idConsulta;
                    $rutaImagen="../imagenesPlatillos/".$idConsulta;

                    if(!file_exists($rutaImagen)){
                        mkdir($rutaImagen,0777,true);
                    }
                    if(!file_exists($rutaRelativa)){
                        mkdir($rutaRelativa,0777,true);
                    }

                    $nombreArchivo = $_FILES['file']['name'];
                    $explode = explode('.',$nombreArchivo);
                    $tipoArchivo =array_pop($explode);

                    $nombreNuevo = str_replace(" ","_",$nombreArchivo); 

                    $rutaAlmacenamiento =$_FILES['file']['tmp_name'];
                    
                    $rutaFinal=$rutaImagen."/".$nombreNuevo;
                    $rutaFinalRelativa=$rutaRelativa."/".$nombreNuevo;


                    if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
                        $sql = "UPDATE platillos_cocina SET imagen = '$rutaFinal' WHERE id_platillo='$idConsulta'";
                        $respuesta = mysqli_query($conexion,$sql);
                        echo mysqli_error($conexion);
                        echo 1;
                        if(copy($rutaFinal, $rutaFinalRelativa)){
                            $sql = "UPDATE platillos_cocina SET ruta_relativa = '$rutaFinalRelativa' WHERE id_platillo='$idConsulta'";
                            $respuesta = mysqli_query($conexion,$sql);
                            echo mysqli_error($conexion);
                        }else{
                            echo 400;
                        }
                    }else{
                        echo "Error al mover los archivos";
                        echo $rutaAlmacenamiento;
                        echo 0;
                    }

                }else{
                    echo 2;
                }

             }else{

                $sql = "INSERT INTO platillos_cocina (nombre_platillo,descripcion,tipo_platillo) VALUES ('$nombrePlatillo','$descripcion','$tipoPlatillo')";
                $consulta = mysqli_query($conexion,$sql);
                echo mysqli_error($conexion);

                $idConsulta=mysqli_insert_id($conexion);
                
                $rutaImagen="../imagenesPlatillos/".$idConsulta;
                if(!file_exists($rutaImagen)){
                    mkdir($rutaImagen,0777,true);
                }
                echo 1;
            }

        break;
        case 'editarPlatillo':
            $idPlatillo = $_POST['id-edit'];
            $nombrePlatillo = $_POST['nombrePlatillo-edit'];
            $descripcion= $_POST['descripcionPlatillo-edit'];
            $Tipo= $_POST['tipoPlatillo-edit'];

            
             if($_FILES['file-edit']['name'] != null){

                $sql = "SELECT count(*) AS Cantidad FROM platillos_cocina WHERE nombre_platillo='$nombrePlatillo' AND id_platillo != '$idPlatillo'";
                $consulta = mysqli_query($conexion,$sql);
                $data = mysqli_fetch_array($consulta);

                if($data['Cantidad']<1){
                    $sql = "UPDATE platillos_cocina SET nombre_platillo='$nombrePlatillo',descripcion='$descripcion',tipo_platillo='$Tipo' WHERE id_platillo='$idPlatillo'";
                    $consulta = mysqli_query($conexion,$sql);
                    
                    $rutaImagen="../imagenesPlatillos/".$idPlatillo;
                    $rutaRelativa="imagenesPlatillos/".$idPlatillo;

                    if(!file_exists($rutaImagen)){
                        mkdir($rutaImagen,0755,true);
                    }
                    if(!file_exists($rutaRelativa)){
                        mkdir($rutaRelativa,0755,true);
                    }

                    $sql = "SELECT* FROM platillos_cocina WHERE id_platillo = '$idPlatillo'";
                    $consulta = mysqli_query($conexion,$sql);
                    $data = mysqli_fetch_array($consulta);

                    if(file_exists($data['imagen'])){
                        unlink($data['imagen']);
                    }
                    if(file_exists($data['ruta_relativa'])){
                        unlink($data['ruta_relativa']);
                    }

                    $nombreArchivo = $_FILES['file-edit']['name'];
                    $explode = explode('.',$nombreArchivo);
                    $tipoArchivo =array_pop($explode);

                    $nombreNuevo = str_replace(" ","_",$nombreArchivo); 

                    $rutaAlmacenamiento =$_FILES['file-edit']['tmp_name'];
                    
                    $rutaFinal=$rutaImagen."/".$nombreNuevo;
                    $rutaFinalRelativa=$rutaRelativa."/".$nombreNuevo;
                    

                
                        if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
                            $sql = "UPDATE platillos_cocina SET imagen = '$rutaFinal' WHERE id_platillo='$idPlatillo'";
                            $respuesta = mysqli_query($conexion,$sql);
                            echo mysqli_error($conexion);
                            echo 1;
                            if(copy($rutaFinal, $rutaFinalRelativa)){
                                $sql = "UPDATE platillos_cocina SET ruta_relativa = '$rutaFinalRelativa' WHERE id_platillo='$idPlatillo'";
                                $respuesta = mysqli_query($conexion,$sql);
                                echo mysqli_error($conexion);
                            }else{
                                echo 400;
                            }
                        }else{
                            throw new Exception('Could not move file'); 
                        }
                    
                    
        

                }else{
                    echo 2;
                }

             }else{

                $sql = "SELECT count(*) AS Cantidad FROM platillos_cocina WHERE nombre_platillo='$nombrePlatillo' AND id_platillo != '$idPlatillo'";
                $consulta = mysqli_query($conexion,$sql);
                $data = mysqli_fetch_array($consulta);

                if($data['Cantidad']<1){
                    $sql = "UPDATE platillos_cocina SET nombre_platillo='$nombrePlatillo',descripcion='$descripcion',tipo_platillo='$Tipo' WHERE id_platillo='$idPlatillo'";
                    $consulta = mysqli_query($conexion,$sql);
                    echo mysqli_error($conexion);
                    
                    echo 1;
                }else{
                    echo 2;
                }
            }
        break;
        case 'eliminarPlatillo':
            $id=$_POST['id'];

            $sql = "SELECT COUNT(*) AS cantidad FROM detalle_menu_cocina WHERE id_platillo = '$id'";
            $consulta = mysqli_query($conexion,$sql);
            $data = mysqli_fetch_array($consulta);

            if($data['cantidad']>0){
                echo 4;
            }else{
                $sql = "SELECT* FROM platillos_cocina WHERE id_platillo = '$id'";
                $consulta = mysqli_query($conexion,$sql);
                $data = mysqli_fetch_array($consulta);
                
                $rutaImagen="../imagenesPlatillos/".$id;
                $rutaRelativa="../../imagenesPlatillos/".$id;


                if(file_exists($data['imagen'])){
                    unlink($data['imagen']);
                } 
                
                if(file_exists($rutaImagen)){
                    rmdir($rutaImagen);
                } 

                if(file_exists($data['ruta_relativa'])){
                    unlink($data['ruta_relativa']);
                } 
                
                if(file_exists($rutaRelativa)){
                    rmdir($rutaRelativa);
                } 
                $sql = "DELETE FROM platillos_cocina WHERE id_platillo = '$id'";
                $consulta = mysqli_query($conexion,$sql);
                echo 1;
            }
        break;
         default:
             echo 'No se encontro accion';
             break;
     }

?>