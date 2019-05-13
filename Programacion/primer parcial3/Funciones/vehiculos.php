<?php

    include_once "./Clases/dao.php";
    include_once "./Clases/vehiculo.php";
    
    $path="./Archivos/vehiculos.txt";
    $vehiculo=new vehiculo();
    $listaVehiculos=dao::LeerObjetosJson($path,$vehiculo);

    echo "<br>";
    $miTabla=dao::insertarHeaderDeTabla($vehiculo);
    foreach($listaVehiculos as $vehiculo){  
   
        $miTabla.=dao::insertarFilaObjeto($vehiculo);
    }
    $miTabla.=dao::insertarPieDeTabla();
    echo $miTabla;//muestro la tabla terminada

?>