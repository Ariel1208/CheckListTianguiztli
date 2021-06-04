<?php

    session_start();
    require_once "../clases/conexion.php";

    $tip=$_POST['tipoOperacion'];
    $idUsuario=$_SESSION['ID_US'];

    $c = new conectar();
     $conexion = $c->conexion();

    switch ($tip) {
        case 'crearEncuesta':
            $fecha=$_POST['fecha'];
            $datosPlatillos = json_decode($_POST['array']);
            $fech = date('Y-m-d');
            $fechaActual = date('Y-m-d',strtotime($fech."- 1 day")); 

            if(strtotime($fecha)<strtotime($fechaActual)){
                echo 2;
            }else{

                $sql = "SELECT COUNT(*) AS cantidad FROM encuesta_cocina WHERE fecha_limite='$fecha'";
                $consulta=mysqli_query($conexion,$sql);
                $data = mysqli_fetch_array($consulta);

                if($data['cantidad']==0){

                    $sql = "INSERT INTO encuesta_cocina(fecha_limite) VALUES ('$fecha')";
                    $consulta=mysqli_query($conexion,$sql);
                    $idConsulta = mysqli_insert_id($conexion);
            
                  /*  $sql = "SELECT COUNT(*) AS cantidad FROM platillos_cocina";
                    $consulta=mysqli_query($conexion,$sql);
                    $data = mysqli_fetch_array($consulta);

                    if($data['cantidad']>0){
*/
                      /*  $sql = "SELECT* FROM platillos_cocina a INNER JOIN tipo_platillo b ON a.tipo_platillo=b.id_tipo ";
                        $consulta=mysqli_query($conexion,$sql);
                        */
                        
                        for ($i=0; $i <COUNT($datosPlatillos) ; $i+=2) { 
                            $nom=$datosPlatillos[$i];
                            $tipo=$datosPlatillos[$i+1];
                            $sql = "INSERT INTO detalle_encuesta (id_encuesta,platillo,tipo) VALUES ('$idConsulta','$nom','$tipo')";
                            $consulta=mysqli_query($conexion,$sql);
                            echo mysqli_error($conexion);
                        }
                        echo 1;
                    /* }else{
                        echo 3;
                    }*/
                }else{
                    echo 4;
                }

            }

        break;
        
        default:
            # code...
            break;
    }