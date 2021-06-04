<?php

    require_once "../clases/conexion.php";
    $tipoOperacion=$_POST['tipoOperacion'];

    switch($tipoOperacion){
        case 1:
            $nombre=$_POST['nombre'];
            $apPaterno=$_POST['apePaterno'];
            $apMaterno=$_POST['apeMaterno'];
            $rol=$_POST['slc-roles'];
            $area=$_POST['slc-area'];
            $correo=$_POST['correoUsuario'];
            $pass=$_POST['pass'];
            $pass2=$_POST['pass2'];

print_r($_POST);
            if($nombre=="" || $apMaterno=="" || $apPaterno=="" && $rol=="" || $correo=="" || $pass =="" || $pass2=="" ){
                echo 3;
                return false;
            }
            if($pass!==$pass2){
                echo 0;
            }else{
                $c = new conectar();
                $conexion = $c->conexion();
                
                $cont = "SELECT count(*) as cantidad FROM usuario WHERE correo='$correo'";
                $ins = mysqli_query($conexion,$cont); 
                $cantidad=mysqli_fetch_array($ins);

                if($cantidad['cantidad']>0){
                    echo 2;
                }else{
                    $sql = "INSERT INTO usuario (nombre, ap_paterno, ap_materno, id_area, correo, contrasena, id_rol) VALUES ('$nombre','$apPaterno','$apMaterno','$area','$correo','$pass','$rol')";
                
                    $respuesta = mysqli_query($conexion,$sql);
                    echo $respuesta;
                }
            }
        break;
        case 2:
            $idUsuario =$_POST['id'];

            $c = new conectar();
            $conexion = $c->conexion();
            
            $sql = "DELETE FROM usuario  WHERE id_usuario='$idUsuario'";
            $respuesta = mysqli_query($conexion,$sql);
            
            echo $respuesta;
        break;
        case 3:
            $id=$_POST['edit-id'];
            $nombre=$_POST['edit-nombre'];
            $apPaterno=$_POST['edit-apePaterno'];
            $apMaterno=$_POST['edit-apeMaterno'];
            $rol=$_POST['edit-slc-roles'];
            $area=$_POST['edit-slc-areas'];
            $correo=$_POST['edit-correoUsuario'];
            $pass=$_POST['edit-passUsuario'];
            $pass2=$_POST['edit-passUsuario2'];

            if($id=="" || $nombre=="" || $apMaterno=="" || $apPaterno=="" && $rol=="" || $correo=="" || $pass =="" || $pass2=="" ){
                echo 3;
                return false;
            }
            if($pass!==$pass2){
                echo 0;
            }else{
                $c = new conectar();
                $conexion = $c->conexion();
                
                $cont = "SELECT count(*) as cantidad FROM usuario WHERE correo='$correo' and id_usuario != '$id'";
                $ins = mysqli_query($conexion,$cont); 
                $cantidad=mysqli_fetch_array($ins);

                if($cantidad['cantidad']>0){
                    echo 2;
                }else{
                    $sql = "UPDATE usuario SET id_rol='$rol', id_area='$area', nombre='$nombre', ap_paterno='$apPaterno', ap_materno='$apMaterno', correo='$correo', contrasena='$pass' WHERE id_usuario='$id'";
                
                    $respuesta = mysqli_query($conexion,$sql);
                    echo $respuesta;
                }
            }
        break;
    }