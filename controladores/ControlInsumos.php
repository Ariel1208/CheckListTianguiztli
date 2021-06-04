<?php

    session_start();
    require_once "../clases/conexion.php";

    $tip=$_POST['tipoOperacion'];
    $idUsuario=$_SESSION['ID_US'];

    switch($tip){
        case 'agregarReporteInsumosEntrada':
            $data=json_decode($_POST['data']);
            $valid=1;
            
            $c = new conectar();
            $conexion = $c->conexion();
            
            $sql = "INSERT INTO reportes_insumos (id_tipo) VALUES (1)";
            $respuesta = mysqli_query($conexion,$sql);
            $idConsulta = mysqli_insert_id($conexion);

            if($respuesta==1){
                for($i = 0;$i<count($data);$i+=2){

                    $producto=$data[$i];
                    $canti=$data[$i+1];
                  
                    $sql = "INSERT INTO detalle_reporte_insumos (producto,cantidad,id_reporte) VALUES ('$producto','$canti','$idConsulta')";
                    $respuesta = mysqli_query($conexion,$sql);
                    mysqli_error($conexion);

                }
            }

            echo $respuesta;
        break;
        case 'agregarReporteInsumosSalida':
            $data=json_decode($_POST['data']);
            $valid=1;
            
            $c = new conectar();
            $conexion = $c->conexion();
            
            $sql = "INSERT INTO reportes_insumos (id_tipo) VALUES (2)";
            $respuesta = mysqli_query($conexion,$sql);
            $idConsulta = mysqli_insert_id($conexion);

            if($respuesta==1){
                for($i = 0;$i<count($data);$i+=2){

                    $producto=$data[$i];
                    $canti=$data[$i+1];
                  
                    $sql = "INSERT INTO detalle_reporte_insumos (producto,cantidad,id_reporte) VALUES ('$producto','$canti','$idConsulta')";
                    $respuesta = mysqli_query($conexion,$sql);
                    mysqli_error($conexion);

                }
            }

            echo $respuesta;
        break;
        case 'reducirInventarioInsumos':
            $data=json_decode($_POST['data']);
            $valid=1;

            $c = new conectar();
            $conexion = $c->conexion();
            $respuesta=0;
            for($i = 0;$i<count($data);$i+=2){

                $producto=$data[$i];
                $canti=$data[$i+1];
                
                $sql = "UPDATE inventario_cocina SET cantidad=cantidad-'$canti' WHERE id_producto='$producto'";
                $respuesta = mysqli_query($conexion,$sql);
                mysqli_error($conexion);

            }


            echo $respuesta;
        break;
        case 'aumentarInventarioInsumos':
            $data=json_decode($_POST['data']);
            $valid=1;

            $c = new conectar();
            $conexion = $c->conexion();
            $respuesta=0;
            for($i = 0;$i<count($data);$i+=2){

                $producto=$data[$i];
                $canti=$data[$i+1];
                
                $sql = "UPDATE inventario_cocina SET cantidad=cantidad+'$canti' WHERE id_producto='$producto'";
                $respuesta = mysqli_query($conexion,$sql);
                mysqli_error($conexion);

            }


            echo $respuesta;
        break;
    }