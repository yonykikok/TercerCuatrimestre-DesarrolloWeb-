<?php
include_once "./Clases/vehiculo.php";

$path="./Archivos/vehiculos.txt";
$arrayVehiculos= array();  
"----------------------------------------------------LISTA Proveedor.txt----------------------------------------------\r\n";

$arrayVehiculos=vehiculo::LeervehiculosPorDatoJson($path);
foreach($arrayVehiculos as $auxVehiculo)
{
    $auxVehiculo->MostrarVehiculo();
}
?>