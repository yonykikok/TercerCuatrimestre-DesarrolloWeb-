<?php
//include_once "alumno.php";
//include_once "CrearAlumno.php";
/*
//var_dump($nombre);//nos permite ver el objeto y ver si contiene un error
//$miArray =array("Martin"=>"25","Juan"=>"35","Julieta"=>"18");//array asociativo clave valor
$miArray =array();
$miArray["nombre"]="Juan";
$miArray["edad"]=18;
//var_dump($miArray);
//------declaracion de un objeto standar.
$myObj = new stdclass();
$myObj->nombre="Juan";
$myObj->edad=18;
//---------------------------------------
//var_dump($myObj);
$Alumno= new Alumno("Juan","Martinez",18,"37755135","Marco Avellaneda 3835");
$alumno2=new Alumno("Martin","Gonzales",18,"40132526");
//var_dump($Alumno);
echo $Alumno->RetornarJson();
echo $alumno2->RetornarJson();

echo "</br>";
echo "</br> <h3>Nombre: $Alumno->nombre</br>$Alumno->apellido </br>Edad: $Alumno->edad</br>Dni: $Alumno->dni</br>Direccion: $Alumno->direccion</h3>";//escribo
echo "</br> <h3>Nombre: $alumno2->nombre</br>$alumno2->apellido </br>Edad: $alumno2->edad</br>Dni: $alumno2->dni</br>Direccion: $alumno2->direccion</h3>";//escribo
*/
//include "CrearAlumno.php";
//include_once "alumno.php";
/*$nombre;
$apellido;
$edad;
$legajo;
$alumno = new alumno($nombre,$apellido,$edad,$legajo);
echo $alumno;*/
include_once "CrearAlumno.php";
echo "Hola";
?>