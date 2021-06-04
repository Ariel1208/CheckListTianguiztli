<?php

    require_once "../clases/conexion.php";
    $tipoOperacion=$_POST['tipoOperacion'];

    switch($tipoOperacion){
        case 1:
            $nom=$_POST['nombre'];
            $apPaterno=$_POST['apePaterno'];
            $apMaterno=$_POST['apeMaterno'];
            $Naciionalidad=$_POST['slc-nac'];
            $fecha = $_POST['FechaNac'];

            if($nom=="" || $apMaterno=="" || $apPaterno=="" && $Naciionalidad=="" || $fecha==""){
                echo 3;
                return false;
            }
                $c = new conectar();
                $conexion = $c->conexion();
                
                $sql = "INSERT INTO autor (id_nacionalidad,nombre,apPaterno,apMaterno, fecha_nacimiento) VALUES ('$Naciionalidad', '$nom','$apPaterno','$apMaterno','$fecha')";
            
                $respuesta = mysqli_query($conexion,$sql);
                echo $respuesta;
            
        break;
        case 2:
            $id=$_POST['id'];
            $nom=$_POST['edit-nombre'];
            $apPaterno=$_POST['edit-apePaterno'];
            $apMaterno=$_POST['edit-apeMaterno'];
            $Naciionalidad=$_POST['edit-slc-nac'];
            $fecha = $_POST['edit-FechaNac'];
    
            if($id=="" || $nom=="" || $apMaterno=="" || $apPaterno=="" && $Naciionalidad=="" || $fecha==""){
                echo 3;
                return false;
            }
            $c = new conectar();
            $conexion = $c->conexion();
            
            
                $sql = "UPDATE autor SET id_nacionalidad='$Naciionalidad', nombre='$nom', apPaterno='$apPaterno', apMaterno='$apMaterno', fecha_nacimiento='$fecha' WHERE id_autor='$id'";
            
                $respuesta = mysqli_query($conexion,$sql);
                echo $respuesta;
        break;
        case 3:
            $idAutor =$_POST['id'];

            $c = new conectar();
            $conexion = $c->conexion();
            
            $sql = "DELETE FROM autor  WHERE id_autor='$idAutor'";
            $respuesta = mysqli_query($conexion,$sql);
            
            echo $respuesta;
        break;
    }