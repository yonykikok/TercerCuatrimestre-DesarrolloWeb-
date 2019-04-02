<?php

    include "./Clases/alumno.php";
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
                    
                    $alumno = new Alumno($nombre,$apellido,$edad,$legajo);   

                    $path="./Archivos/ListaAlumnos.txt";
                    $pathJson="./Archivos/ListaAlumnosJson.json";
                    $alumno->GuardarAlumnoJson($pathJson);
                    $alumno->GuardarAlumno($path);
                    echo "Alumno agregado con exito"; 
                }
                else
                {
                    echo "falta el campo Edad en POST";
                }
            }
            else
            {
                echo "falta el campo Apellido en POST";
            }
        }
        else
        {
            echo "falta el campo Legajo en POST";
        }
    }
    else
    {
        echo "falta el campo Nombre en POST";
    }
 
?>
