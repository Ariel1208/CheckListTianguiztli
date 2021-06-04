<?php

    session_start();
    require_once "../clases/conexion.php";

    $tip=$_POST['tipoOperacion'];
    $idUsuario=$_SESSION['ID_US'];

    $c = new conectar();
    $conexion = $c->conexion();
    
    switch($tip){
        case 1:
            $nombre=$_POST['nombre'];
            $correo=$_POST['correo'];
            $pass=$_POST['pass'];
            $tipo=$_POST['tipoUsuario'];
            $salida=0;

            

            $sql = "SELECT count(*) AS Cantidad FROM lista_servicio_cocina WHERE correo='$correo'";
            $consulta = mysqli_query($conexion,$sql);
            $data = mysqli_fetch_array($consulta);

            if($data['Cantidad']>0){
                echo 2;
            }else if($data['Cantidad']==0){
                $c = new conectar();
                $conexion = $c->conexion();
    
                $sql = "INSERT INTO lista_servicio_cocina (nombre, correo, contrasena,id_tipo) VALUES ('$nombre', '$correo', '$pass','$tipo')";
                $consulta = mysqli_query($conexion,$sql);

                $id=mysqli_insert_id($conexion);

                if($_FILES['archivo']['size'] > 0){

                    $carpetaImagenesUsuarios = '../imagenesUsuarios/'.$id;
                    if(!file_exists($carpetaImagenesUsuarios)){
                        mkdir($carpetaImagenesUsuarios,0777,true);
                    }

                    for($i=0;$i<count($_FILES['archivo']['name']); $i++){
                    
                        $nombreArchivo = $_FILES['archivo']['name'][$i];
                        $explode = explode('.',$nombreArchivo);
                        $tipoArchivo =array_pop($explode);
    
                        $nombreNuevo = str_replace(" ","_",$nombreArchivo); 
    
                        $rutaAlmacenamiento =$_FILES['archivo']['tmp_name'][$i];
                        
                        $rutaFinal=$carpetaImagenesUsuarios."/".$nombreNuevo;
                        
                        if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
                            
                            
                            $sql = "UPDATE lista_servicio_cocina SET ruta_imagen = '$rutaFinal' WHERE id_usuario=$id
                            ";
                            $respuesta = mysqli_query($conexion,$sql);
                            echo mysqli_error($conexion);
                            $salida=1;
                        }else{
                            echo "Error al mover los archivos";
                            echo $rutaAlmacenamiento;
                            $salida=0;
                        }
                    
                    }
                }
            }


        echo $salida;
        break;
        case 2:
            $id=$_POST['idFoto'];

            if($_FILES['archivo2']['name'] > 0){
                $carpetaImagenesUsuarios = '../imagenesUsuarios/'.$id;
                if(!file_exists($carpetaImagenesUsuarios)){
                    mkdir($carpetaImagenesUsuarios,0755);
                }

                for($i=0;$i<count($_FILES['archivo2']['name']); $i++){
                
                    $nombreArchivo = $_FILES['archivo2']['name'][$i];
                    $explode = explode('.',$nombreArchivo);
                    $tipoArchivo =array_pop($explode);

                    $nombreNuevo = str_replace(" ","_",$nombreArchivo); 

                    $rutaAlmacenamiento =$_FILES['archivo2']['tmp_name'][$i];
                    
                    $rutaFinal=$carpetaImagenesUsuarios."/".$nombreNuevo;
                    
                    if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
                        
                        
                        $sql = "UPDATE lista_servicio_cocina SET ruta_imagen = '$rutaFinal' WHERE id_usuario=$id
                        ";
                        $respuesta = mysqli_query($conexion,$sql);
                        echo mysqli_error($conexion);
                        $salida=1;
                    }else{
                        echo "Error al mover los archivos";
                        echo $rutaAlmacenamiento;
                        $salida=0;
                    }
                
                }
            }
        break;

    }

