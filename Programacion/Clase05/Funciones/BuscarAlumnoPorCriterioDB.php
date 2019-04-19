<?php
    include_once "./Clases/alumno.php";
    $arrayAlumnoLeido=json_decode(file_get_contents("php://input"), true);//el true, hace que me lo devuelva como array de lo contrario lo devuevle como obj de 'stdClass'
    if(isset($arrayAlumnoLeido))
    {        
        $arrayAlumnos=Alumno::TraerTodoLosAlumnos();
        $contador=0;
        foreach($arrayAlumnos as $auxAlumno)
        {
           $contador=$aviso=$auxAlumno->BuscarAlumnoPorCriterio($arrayAlumnoLeido,$arrayAlumnoLeido['criterio'],$auxAlumno, $contador);
        }    
        if($contador>=1)
        {
            echo "se encontraron ".$contador." coincidencias al filtrar por: ".$arrayAlumnoLeido['criterio'];
        }
        else{
            echo "no hay coincidencias con la busqueda";
        }
    }
    else
    {
        echo "no se pudo leer el alumno a modificar(PUT->RAW)";
    }     


?>