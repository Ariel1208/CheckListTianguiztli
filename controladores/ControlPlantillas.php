<?php

    require_once "../clases/conexion.php";
    $tipoOperacion=$_POST['tipoOperacion'];

    switch($tipoOperacion){
        case 'agregarPlantilla':
            $nom=$_POST['nombrePlantilla'];
            $sector=$_POST['sector'];
            $actividades= json_decode($_POST['lstactividades']);
            $contador = 0;
            
            $c = new conectar();
            $conexion = $c->conexion();
                
            $sql = "INSERT INTO plantilla (nombre,id_sector) VALUES ('$nom','$sector')";
            $respuesta = mysqli_query($conexion,$sql);
            if($respuesta==1){
                $id_consulta=mysqli_insert_id($conexion);

                for($i=0;$i<count($actividades);$i++){

                    $Actividad = $actividades[$i];
                    $sql = "INSERT INTO detalle_plantilla (actividad,id_plantilla) VALUES ('$Actividad','$id_consulta')";
                    $respuesta = mysqli_query($conexion,$sql);
                    $contador+=$respuesta;

                }

                if($contador== count($actividades)){
                    echo 1;
                }else{
                    echo $contador;
                }
                
            }
            
        break;
        case 'editarPlantilla':
            $id = $_POST['id'];
            $nom=$_POST['nombrePlantilla'];
            $sector=$_POST['sector'];
            $actividades= json_decode($_POST['lstactividades']);
            $contador = 0;

            
            $c = new conectar();
            $conexion = $c->conexion();
                
            $sql = "UPDATE plantilla SET nombre='$nom',id_sector='$sector' WHERE id_plantilla ='$id'";
            $respuesta = mysqli_query($conexion,$sql);
            if($respuesta==1){
                $sql = "DELETE FROM detalle_plantilla WHERE id_plantilla = '$id'";
                $respuesta = mysqli_query($conexion,$sql);
                if($respuesta==1){
                    for($i=0;$i<count($actividades);$i++){
                        $Actividad = $actividades[$i];
                        $sql = "INSERT INTO detalle_plantilla (actividad,id_plantilla) VALUES ('$Actividad','$id')";
                        $respuesta = mysqli_query($conexion,$sql);
                        $contador+=$respuesta;
                        echo mysqli_error($conexion);

                    }
                }
                
                if($contador== count($actividades)){
                    echo 1;
                }else{
                    echo $contador;
                }
                
            }
            
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