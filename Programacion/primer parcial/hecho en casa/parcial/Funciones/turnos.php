<?php
include_once "./Clases/turno.php";
include_once "./Clases/dao.php";

$path="./Archivos/turnos.txt";
$arrayVehiculos= array();  
"----------------------------------------------------LISTA Proveedor.txt----------------------------------------------\r\n";
$turno=new turno();
$arrayTurnos=dao::LeerObjetosJson($path,$turno);
echo "<br>";
foreach($arrayTurnos as $auxTurno)
{
    $auxTurno->MostrarTurno();
    echo "--------------------------<br>";
}
?>