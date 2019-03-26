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
    }
    $path="C:/xampp/htdocs/Clase2019/Clase 02/ListaAlumnosJson.txt";
    $pathJson="C:/xampp/htdocs/Clase2019/Clase 02/ListaAlumnos.txt";
     $alumno = new Alumno($nombre,$apellido,$edad,$legajo);
    

    $arrayAlumno= $alumno->LeerAlumno($path);
    //var_dump($arrayAlumno);
    foreach($arrayAlumno as $auxAlumno)
    {
        $auxAlumno->MostrarAlumno();
    }
?>
