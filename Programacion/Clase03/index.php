<?php
ini_set('max_input_vars', 3000);
/*
include "./Clases/alumno.php";


$pathImagen=$_FILES['img']['tmp_name'];
$pathLogo=$_FILES['logo']['tmp_name'];
$nameImg=$_FILES['img']['name'];

$nameImg=Alumno::changeImgName($nameImg);
$pathNewImg="./Fotos/".$nameImg;

if(file_exists($pathNewImg))
{      
    $auxNewName=Alumno::AddDateTimeImg($nameImg);
    $pathBackUpImg="./FotosBackUp/".$auxNewName;
   
    if(rename($pathNewImg,$pathBackUpImg))//mueve la imagen vieja a otra carpeta (backup)
    {
        Alumno::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);    
        echo "Imagen Actualizada";
    }
    else
    { 
        echo "No se pudo crear la imagen";
    }
}
else
{
    Alumno::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);                    
    echo "Subio la imagen";
   
}
*/

echo "<h1>Multitask</h1>";

$dato = $_SERVER['REQUEST_METHOD'];
if($dato=="PUT")
{
    require_once "./Funciones/ModificarAlumno.php";
}
else if($dato=="POST")
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
?>
