<?php
include_once "./Clases/turno.php";
include_once "./Clases/vehiculo.php";
include_once "./Clases/pedido.php";

$path="./Archivos/turnos.txt";
$arrayVehiculos= array();  
"----------------------------------------------------LISTA Proveedor.txt----------------------------------------------\r\n";

$arrayTurnos=turno::LeerTurnosPorDatoParametroJson($path,$_GET['dato']);
foreach($arrayTurnos as $auxTurno)
{
    $auxTurno->MostrarTurno();
}
?>