<?php
include_once "./Clases/turno.php";
include_once "./Clases/vehiculo.php";
include_once "./Clases/pedido.php";
include_once "./Clases/dao.php";

$path="./Archivos/turnos.txt";
$arrayVehiculos= array();  
"----------------------------------------------------LISTA Proveedor.txt----------------------------------------------\r\n";
$dato=$_GET['dato'];
$turno= new turno();
$arrayTurnos=dao::LeerObjetosPorDatosJson($path,$dato,$turno);
//$arrayTurnos=turno::LeerTurnosPorDatoParametroJson($path,);
echo "<br>";
foreach($arrayTurnos as $auxTurno)
{
    $auxTurno->MostrarTurno();
    echo "--------------------------<br>";
}
?>