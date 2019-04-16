<?php
ini_set('max_input_vars', 3000);

echo "<h1>Multitask</h1>";

$dato = $_SERVER['REQUEST_METHOD'];
if($dato=="PUT")
{
    require_once "./Funciones/ModificarAlumnoDB.php";
}
else if($dato=="POST")
{
    require_once "./Funciones/CrearAlumnoBD.php";
}
else if($dato=="GET")
{
    require_once "./Funciones/ListarAlumnos.php";
}
else if($dato=="DELETE")
{
    require_once "./Funciones/BorrarAlumno.php";
}
?>
