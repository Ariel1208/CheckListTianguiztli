<?php
     session_start();
     require_once "../clases/conexion.php";
 
     $tip=$_POST['tipoOperacion'];
     $idUsuario=$_SESSION['ID_US'];
 
     $c = new conectar();
     $conexion = $c->conexion();
     
    switch ($tip) {
        case 'publicarMenu':
            $listaComida=json_decode($_POST['listaComida']);
            $listaDesayuno=json_decode($_POST['listaDesayuno']);
            $fecha=$_POST['fecha'];
            $fech = date('Y-m-d');
            $fechaActual = date('Y-m-d',strtotime($fech."- 1 day")); 


            if(strtotime($fecha)<strtotime($fechaActual)){
                echo 2;
            }else{

                $sql = "SELECT COUNT(*)AS cantidad FROM menu_cocina WHERE fecha_seguimiento='$fecha'";
                $consulta=mysqli_query($conexion,$sql);
                $data = mysqli_fetch_array($consulta);

                if($data['cantidad']<1){
                    $sql = "INSERT INTO menu_cocina (fecha_seguimiento) VALUES ('$fecha')";
                    $consulta=mysqli_query($conexion,$sql);
                    $idConsulta=mysqli_insert_id($conexion);

                    if($listaComida[0] != "sin"){
                        for ($i=0; $i < COUNT($listaComida); $i++) { 
                            $idpla=$listaComida[$i];
                            $sql = "INSERT INTO detalle_menu_cocina (id_platillo,id_menu,tipo) VALUES ('$idpla','$idConsulta','2')";
                            $consulta=mysqli_query($conexion,$sql);
                            echo mysqli_error($conexion);

                        }
                    }

                    if($listaDesayuno[0] != "sin"){
                        for ($i=0; $i < COUNT($listaDesayuno); $i++) { 
                            $idpla=$listaDesayuno[$i];
                            $sql = "INSERT INTO detalle_menu_cocina (id_platillo,id_menu,tipo) VALUES ('$idpla','$idConsulta','1')";
                            $consulta=mysqli_query($conexion,$sql);
                            echo mysqli_error($conexion);
                        }
                    }
                    echo 1;
                }else{
                    echo 3;
                }
            }
            

            break;
            case 'editarMenu':
                $idMenu=$_POST['id'];
                $listaComida=json_decode($_POST['listaComida']);
                $listaDesayuno=json_decode($_POST['listaDesayuno']);
                $fecha=$_POST['fecha'];
                $fech = date('Y-m-d');
                $fechaActual = date('Y-m-d',strtotime($fech."- 1 day")); 

                if(strtotime($fecha)<strtotime($fechaActual)){
                    echo 2;
                }else{
    
                    $sql = "SELECT COUNT(*)AS cantidad FROM menu_cocina WHERE fecha_seguimiento='$fecha' and id_menu != '$idMenu'";
                    $consulta=mysqli_query($conexion,$sql);
                    $data = mysqli_fetch_array($consulta);
    
                    if($data['cantidad']<1){
                        $sql = "UPDATE menu_cocina SET fecha_seguimiento='$fecha' WHERE id_menu='$idMenu'";
                        $consulta=mysqli_query($conexion,$sql);

                        $sql = "DELETE FROM detalle_menu_cocina WHERE id_menu='$idMenu'";
                        $consulta=mysqli_query($conexion,$sql);
                        echo mysqli_error($conexion);
    
                        if($listaComida[0] != "sin"){
                            for ($i=0; $i < COUNT($listaComida); $i++) { 
                                $idpla=$listaComida[$i];
                                $sql = "INSERT INTO detalle_menu_cocina (id_platillo,id_menu,tipo) VALUES ('$idpla','$idMenu','2')";
                                $consulta=mysqli_query($conexion,$sql);
                                echo mysqli_error($conexion);
    
                            }
                        }
    
                        if($listaDesayuno[0] != "sin"){
                            for ($i=0; $i < COUNT($listaDesayuno); $i++) { 
                                $idpla=$listaDesayuno[$i];
                                $sql = "INSERT INTO detalle_menu_cocina (id_platillo,id_menu,tipo) VALUES ('$idpla','$idMenu','1')";
                                $consulta=mysqli_query($conexion,$sql);
                                echo mysqli_error($conexion);
                            }
                        }
                        echo 1;
                    }else{
                        echo 3;
                    }
                }
            break;
        default:
            # code...
            break;
    }