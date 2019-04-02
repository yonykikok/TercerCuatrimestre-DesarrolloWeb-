<?php
include_once "./Clases/alumno.php";

$path="./Archivos/ListaAlumnos.txt";
$pathJson="./Archivos/ListaAlumnosJson.json";
$arrayAlumno= array();  
/*echo "----------------------------------------------------LISTA Alumnos.txt----------------------------------------------\r\n";
$arrayAlumno=Alumno::LeerAlumnos($path);
foreach($arrayAlumno as $auxAlumno)
{
    $auxAlumno->MostrarAlumno();
}*/
$arrayAlumno=Alumno::LeerAlumnosJson($pathJson);
echo "----------------------------------------------------LISTA Alumnos.json----------------------------------------------\r\n";
foreach($arrayAlumno as $auxAlumno)
{
    $auxAlumno->MostrarAlumno();
}
?>