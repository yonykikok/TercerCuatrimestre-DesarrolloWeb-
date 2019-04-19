<?php
include_once "./Clases/alumno.php";

/*$path="./Archivos/ListaAlumnos.txt";
$pathJson="./Archivos/ListaAlumnosJson.json";
$arrayAlumno= array();  

$arrayAlumno=Alumno::LeerAlumnosJson($pathJson);*/
//echo "----------------------------------------------------LISTA Alumnos.json----------------------------------------------\r\n";
/*$variable=Alumno::insertarHeaderDeTabla();
foreach($arrayAlumno as $auxAlumno)
{
    $variable.=$auxAlumno->obtenerFilaAlumno();
}
$variable.=Alumno::insertarPieDeTabla();
echo $variable;*/

//-------- BASE DE DATOS
 foreach(Alumno::TraerTodoLosAlumnos() as $auxAlumno)
 {
     //var_dump($auxAlumno);
     Alumno::MostrarAlumno($auxAlumno);
 }
?>