<?php 
   include_once ("../lib/utils.php");

   class Conexion extends PDO { 
      
      public function __construct() {
         //Sobreescribo el método constructor de la clase PDO.

         $file = 'config.ini';

         if (!$setting = parse_ini_file($file, true)) {
             throw new exception ('No se puede abrir el archivo ' . $file . '.');
         }

         $driver = $setting["database"]["driver"]; 
         $host = $setting["database"]["host"]; 
         $dbname = $setting["database"]["schema"];
         $username = $setting["database"]["username"];
         $password = $setting["database"]["password"];

         try{
            parent::__construct($driver.':host='.$host.';dbname='.$dbname, $username, $password);
         }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
         }
      } 
   } 
?>