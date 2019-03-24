<?php

    include "alumno.php";
    if(isset($_POST['Nombre']))
    {
        if(isset($_POST['Legajo']))
        {
            if(isset($_POST['Apellido']))
            {
                if(isset($_POST['Edad']))
                {
                    $nombre=$_POST['Nombre'];
                    $apellido=$_POST['Apellido'];
                    $edad=$_POST['Edad'];
                    $legajo=$_POST['Legajo'];
                    var_dump($_POST);
                }
            }
        }
    }
    else
    {
        $nombre=$_GET['Nombre'];
        $apellido=$_GET['Apellido'];
        $edad=$_GET['Edad'];
        $legajo=$_GET['Legajo'];
        var_dump($_GET);
    }
   
     $alumno = new Alumno($nombre,$apellido,$edad,$legajo);
    //var_dump($alumno);
     echo $alumno->RetornarJson();
?>
