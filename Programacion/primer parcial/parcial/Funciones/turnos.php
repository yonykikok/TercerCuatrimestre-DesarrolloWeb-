<?php
include_once "./Clases/turno.php";

$path="./Archivos/turnos.txt";
$arrayVehiculos= array();  
"----------------------------------------------------LISTA Proveedor.txt----------------------------------------------\r\n";

$arrayTurnos=turno::LeerTurnosJson($path);
foreach($arrayTurnos as $auxTurno)
{
    $auxTurno->MostrarTurno();
}
?>