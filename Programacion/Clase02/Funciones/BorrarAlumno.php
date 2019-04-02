<?php

include "./Clases/alumno.php";


    $path="./Archivos/ListaAlumnos.txt";
    $pathJson="./Archivos/ListaAlumnosJson.json";
    $arrayAlumnos=array();
    $newArrayAlumnos=array();
    $arrayAlumnos=Alumno::LeerAlumnosJson($pathJson);
    $aviso="no se encontro el numero de legajo";
    $AlumnoAeliminar=json_decode(file_get_contents("php://input"), true);//leo el json del raw y lo manejo como si fuera un alumno indexado
    if(isset($AlumnoAeliminar))
    {
        
        foreach($arrayAlumnos as $auxAlumno)
        {
            if($auxAlumno->legajo==$AlumnoAeliminar['legajo'])
            {
                $aviso="se borro el alumno con el legajo: ".$AlumnoAeliminar['legajo'];
            }
            else
            {
                array_push($newArrayAlumnos,$auxAlumno);    //creo un nuevo array excluyendo al que vamos a eliminar.        
            }
        }    
        
        unlink("./Archivos/ListaAlumnosJson.json");//borro el archivo fisico

        foreach($newArrayAlumnos as $alumno)
        {
            $auxAlumno=new Alumno($alumno->nombre,$alumno->apellido,$alumno->edad,$alumno->legajo);
            $auxAlumno->GuardarAlumnoJson("./Archivos/ListaAlumnosJson.json");//creamos un nuevo archivo con todos los elementos del "newArrayAlumnos"
        }
        echo $aviso;//aviso si se borro o no el alumno.
    }
    else
    {
        echo "no se pudo leer el alumno a eliminar.(DELETE->RAW)";
    }


?>