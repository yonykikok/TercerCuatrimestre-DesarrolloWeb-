<?php
 include "./Clases/vehiculo.php";  
 include "./Clases/dao.php";   
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
                 
                 $arrayVehiculos=array();
                 if(file_exists($path))
                 {
                     $arrayVehiculos=dao::LeerObjetosJson($path,$vehiculo);
                     if(!dao::verificarExistenciaDelObjeto($arrayVehiculos,$patente,'patente'))
                     {
                        dao::GuardarObjetoJson($path,$vehiculo);
                        echo "Guardamos el vehiculo";
                        
                     }
                     else
                     {
                        echo "El vehiculo con la patente: ".$patente." ya esta en la lista";
                     }
                 }
                 else
                 {
                    dao::GuardarObjetoJson($path,$vehiculo);
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