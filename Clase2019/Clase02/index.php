<?php
echo "<h1>Multitask</h1>";
$dato = $_SERVER['REQUEST_METHOD'];
if($dato=="POST")
{
    require_once "./Funciones/CrearAlumno.php";
}
else if($dato=="GET")
{
    require_once "./Funciones/ListarAlumnos.php";
}
else if($dato=="DELETE")
{
    require_once "./Funciones/BorrarAlumno.php";
}
else if($dato=="PUT")
{
    require_once "./Funciones/ModificarAlumno.php";
}
?>
