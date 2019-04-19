<?php
include "./Clases/alumno.php";
    
    $arrayAlumnos=array();
    
    $aviso="no se encontro el numero de legajo";
    $AlumnoAeliminar=json_decode(file_get_contents("php://input"), true);//leo el json del raw y lo manejo como si fuera un alumno indexado
    if(isset($AlumnoAeliminar))
    {        
        $arrayAlumnos=Alumno::TraerTodoLosAlumnos();
        foreach($arrayAlumnos as $auxAlumno)
        {
            if($auxAlumno->legajo==$AlumnoAeliminar['legajo'])
            {
                $auxAlumno->BorrarAlumno();
                $aviso="se borro el alumno con el legajo: ".$AlumnoAeliminar['legajo'];
            }
        }   
        echo $aviso;//aviso si se borro o no el alumno.
    }
    else
    {
        echo "no se pudo leer el alumno a eliminar.(DELETE->RAW)";
    }
?>