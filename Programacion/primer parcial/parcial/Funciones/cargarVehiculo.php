<?php
 include "./Clases/vehiculo.php";   
     
 if(isset($_POST['patente']))
 {
     if(isset($_POST['marca']))
     {
         if(isset($_POST['modelo']))
         {
             if(isset($_POST['precio']))
             {
                 $patente=$_POST['patente'];
                 $marca=$_POST['marca'];
                 $modelo=$_POST['modelo'];
                 $precio=$_POST['precio'];  
                 $params=array("patente"=>$patente,"marca"=>$marca,"modelo"=>$modelo,"precio"=>$precio);

                 $vehiculo = new vehiculo();   
                 $vehiculo->miConstructor($params);
                 $path="./Archivos/vehiculos.txt";

                 $arrayVehiculo=array();
                 if(file_exists($path))
                 {
                     $arrayVehiculo=vehiculo::LeerVehiculosJson($path);
                 }
                if($vehiculo->GuardarVehiculoJson($path))
                {
                    echo "Guardamos el vehiculo";
                }

             }
             else
             {
                 echo "falta el campo precio en POST";
             }
         }
         else
         {
             echo "falta el campo modelo en POST";
         }
     }
     else
     {
         echo "falta el campo marca en POST";
     }
 }
 else
 {
     echo "falta el campo patente en POST";
 }

?>