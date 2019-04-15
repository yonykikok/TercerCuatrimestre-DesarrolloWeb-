<?php
include_once "./Clases/alumno.php";

$path="./Archivos/ListaAlumnos.txt";
$pathJson="./Archivos/ListaAlumnosJson.json";
$arrayAlumno= array();  

$arrayAlumno=Alumno::LeerAlumnosJson($pathJson);
echo "----------------------------------------------------LISTA Alumnos.json----------------------------------------------\r\n";
$variable=Alumno::insertarHeaderDeTabla();
foreach($arrayAlumno as $auxAlumno)
{
    /*$auxAlumno->MostrarAlumno();*/
    //echo $auxAlumno->RetornarJson();
    $variable.=$auxAlumno->obtenerFilaAlumno();
}
$variable.=Alumno::insertarPieDeTabla();
echo $variable;
/*echo Alumno::insertarHeaderDeTabla();*/

?>