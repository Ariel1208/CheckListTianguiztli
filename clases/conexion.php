<?php 
    class conectar{
        public function conexion(){
            $servidor="us-cdbr-east-04.cleardb.com";
            $usuario="b9d56c03a4a64a";
            $password="d065901f";
            $base="heroku_75dca23ebd2db75";
            
            $conexion =mysqli_connect(
                $servidor,
                $usuario,
                $password,
                $base
            );
            $conexion->set_charset('utf8mb4');
            return $conexion;
        }
    }