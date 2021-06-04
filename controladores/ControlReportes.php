<?php

    require_once "../clases/conexion.php";
    $tipoOperacion=$_POST['tipoOperacion'];

    switch($tipoOperacion){
        case 'agregarReporte':
            $nombreReporte=$_POST['nombreReporte'];
            $fechaInicio=$_POST['fechaInicio'];
            $fechaFinal=$_POST['fechaFinal'];
            $fechaLimite=$_POST['fechaLimite'];
            $responsable=$_POST['responsable'];
            $id_plantilla=$_POST['id_plantilla'];
            
            $c = new conectar();
            $conexion = $c->conexion();
                
            $sql = "INSERT INTO reporte (nombre_reporte,nombre_responsable,fecha_inicial,fecha_final,id_plantilla,fecha_limite) VALUES ('$nombreReporte','$responsable','$fechaInicio','$fechaFinal','$id_plantilla','$fechaLimite')";
            $respuesta=mysqli_query($conexion,$sql);
            $id_consulta=mysqli_insert_id($conexion);

            if($respuesta==1){
                $sql = "SELECT COUNT(*) AS cantidad FROM detalle_plantilla WHERE id_plantilla='$id_plantilla'";
                $data = mysqli_query($conexion,$sql);
                echo mysqli_error($conexion);

                $dataRow = mysqli_fetch_array($data);

                $sql = "SELECT * FROM detalle_plantilla where id_plantilla='$id_plantilla'";
                $data = mysqli_query($conexion,$sql);
                echo mysqli_error($conexion);

                while($fila = mysqli_fetch_assoc($data)){
                    $nombreActividad = $fila['actividad'];
                    $var =0;
                    $sql3 = "INSERT INTO detalle_reporte (id_reporte,actividad,lunes,martes,miercoles,jueves,viernes) VALUES ('$id_consulta','$nombreActividad','0','0','0','0','0')";
                    $data3 = mysqli_query($conexion,$sql3);
                    echo mysqli_error($conexion);
                }
                echo 1;   
            }
            
            
        break;
        case 'editarSeguimiento':
            $id=$_POST['idReporte'];
            $observaciones=$_POST['observaciones'];
            $lu=json_decode($_POST['lunes']);
            $ma=json_decode($_POST['martes']);
            $mi=json_decode($_POST['miercoles']);
            $ju=json_decode($_POST['jueves']);
            $vi=json_decode($_POST['viernes']);

            $c = new conectar();
            $conexion = $c->conexion();

            $sql = "UPDATE reporte SET observaciones='$observaciones' WHERE id_reporte='$id'";
                mysqli_query($conexion,$sql);
                echo mysqli_error($conexion);

            if(empty($lu)){
                $sql = "UPDATE detalle_reporte SET lunes=0 WHERE id_reporte='$id'";
                mysqli_query($conexion,$sql);
                echo mysqli_error($conexion);

            }else{
                $sql = "SELECT id_detalle_reporte FROM detalle_reporte WHERE id_reporte='$id'";
                $consulta=mysqli_query($conexion,$sql);
                echo mysqli_error($conexion);

                while($fila = mysqli_fetch_assoc($consulta)){
                    for($i=0;$i<count($lu);$i++){
                        if(in_array($fila['id_detalle_reporte'],$lu)){
                            $idDet=$lu[$i];
                            $sql = "UPDATE detalle_reporte SET lunes=1 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                            echo mysqli_error($conexion);

                        }else{
                            $idDet=$fila['id_detalle_reporte'];
                            $sql = "UPDATE detalle_reporte SET lunes=0 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                            echo mysqli_error($conexion);

                        }
                    }
                }
            };

            if(empty($ma)){
                $sql = "UPDATE detalle_reporte SET martes=0 WHERE id_reporte='$id'";
                mysqli_query($conexion,$sql);
            }else{
                $sql = "SELECT id_detalle_reporte FROM detalle_reporte WHERE id_reporte='$id'";
                $consulta=mysqli_query($conexion,$sql);
                while($fila = mysqli_fetch_assoc($consulta)){
                    for($i=0;$i<count($ma);$i++){
                        if(in_array($fila['id_detalle_reporte'],$ma)){
                            $idDet=$ma[$i];
                            $sql = "UPDATE detalle_reporte SET martes=1 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                        }else{
                            $idDet=$fila['id_detalle_reporte'];
                            $sql = "UPDATE detalle_reporte SET martes=0 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                        }
                    }
                }
            };

            if(empty($mi)){
                $sql = "UPDATE detalle_reporte SET miercoles=0 WHERE id_reporte='$id'";
                mysqli_query($conexion,$sql);
            }else{
                $sql = "SELECT id_detalle_reporte FROM detalle_reporte WHERE id_reporte='$id'";
                $consulta=mysqli_query($conexion,$sql);
                while($fila = mysqli_fetch_assoc($consulta)){
                    for($i=0;$i<count($mi);$i++){
                        if(in_array($fila['id_detalle_reporte'],$mi)){
                            $idDet=$mi[$i];
                            $sql = "UPDATE detalle_reporte SET miercoles=1 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                        }else{
                            $idDet=$fila['id_detalle_reporte'];
                            $sql = "UPDATE detalle_reporte SET miercoles=0 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                        }
                    }
                }
            };

            if(empty($ju)){
                $sql = "UPDATE detalle_reporte SET jueves=0 WHERE id_reporte='$id'";
                mysqli_query($conexion,$sql);
            }else{
                $sql = "SELECT id_detalle_reporte FROM detalle_reporte WHERE id_reporte='$id'";
                $consulta=mysqli_query($conexion,$sql);
                while($fila = mysqli_fetch_assoc($consulta)){
                    for($i=0;$i<count($ju);$i++){
                        if(in_array($fila['id_detalle_reporte'],$ju)){
                            $idDet=$ju[$i];
                            $sql = "UPDATE detalle_reporte SET jueves=1 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                        }else{
                            $idDet=$fila['id_detalle_reporte'];
                            $sql = "UPDATE detalle_reporte SET jueves=0 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                        }
                    }
                }
            };

            if(empty($vi)){
                $sql = "UPDATE detalle_reporte SET viernes=0 WHERE id_reporte='$id'";
                mysqli_query($conexion,$sql);
            }else{
                $sql = "SELECT id_detalle_reporte FROM detalle_reporte WHERE id_reporte='$id'";
                $consulta=mysqli_query($conexion,$sql);
                while($fila = mysqli_fetch_assoc($consulta)){
                    for($i=0;$i<count($vi);$i++){
                        if(in_array($fila['id_detalle_reporte'],$vi)){
                            $idDet=$vi[$i];
                            $sql = "UPDATE detalle_reporte SET viernes=1 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                        }else{
                            $idDet=$fila['id_detalle_reporte'];
                            $sql = "UPDATE detalle_reporte SET viernes=0 WHERE id_reporte='$id' and id_detalle_reporte='$idDet'";
                            $resp=mysqli_query($conexion,$sql);
                        }
                    }
                }
            };

            echo 1;



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