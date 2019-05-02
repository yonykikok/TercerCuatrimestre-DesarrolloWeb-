<?php
include_once "./Clases/turno.php";
include_once "./Clases/dao.php";

$path="./Archivos/turnos.txt";
$arrayVehiculos= array();  
$turno=new turno();
$arrayTurnos=dao::LeerObjetosJson($path,$turno);
$miTabla=dao::insertarHeaderDeTabla($turno);
foreach($arrayTurnos as $auxTurno)
{
    $miTabla.=dao::insertarFilaObjeto($auxTurno);
}
$miTabla.=dao::insertarPieDeTabla();

echo $miTabla;//muestro la tabla terminada
?>