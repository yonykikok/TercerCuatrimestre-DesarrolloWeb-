<?php
ini_set('max_input_vars', 3000);
//var_dump($_FILES);

$path=$_FILES['img']['tmp_name'];
$pathLogo=$_FILES['logo']['tmp_name'];
var_dump($path);

$nameImg=$_FILES['img']['name'];
$arrayNameImg=explode('.',$nameImg);//creo un array y separo
$arrayNameImg[0]=$_POST['Nombre'].$_POST['Legajo'];
$nameImg=$arrayNameImg[0].".".$arrayNameImg[1];
$pathNewImg="./Fotos/".$nameImg;

if(file_exists($pathNewImg))
{  
    $arrayNameImg=explode('.',$nameImg);//creo un array y separo
    $auxNewName=$arrayNameImg[0].date("-Y-m-d").date("-h-i-sa").".".$arrayNameImg[1];//creo el nuevo nombre de la imagen agregando fecha y hora
    $pathBackUpImg="./FotosBackUp/".$auxNewName;
    $pathBackUpImg;
    rename($pathNewImg,$pathBackUpImg);//mueve la imagen vieja a otra carpeta (backup)
    move_uploaded_file($path,$pathNewImg);//toma la foto del postman y la guarda en el newPathImg
    
    echo "EXISTE LA IMAGEN";
}
else
{
    include "./Clases/alumno.php";
    Alumno::CrearImgConMarca($path,$pathLogo,$pathNewImg);
            
        
    echo "Subio la imagen";

   
}


/*echo "<h1>Multitask</h1>";

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
}*/
?>
