<?php
    include_once "./Clases/alumno.php";

    $path="./Archivos/ListaAlumnos.txt";
    $pathJson="./Archivos/ListaAlumnosJson.json";
    $arrayAlumnos=array();
    $newArrayAlumnos=array();
 
    
    $alumnoLeido=json_decode(file_get_contents("php://input"), true);

    if(isset($alumnoLeido))
    {

        $arrayAlumnos=Alumno::LeerAlumnosJson($pathJson);
        $aviso="no se encontro el numero de legajo";
        foreach($arrayAlumnos as $auxAlumno)
    {
        if($auxAlumno->legajo==$alumnoLeido['legajo'])
        {
            $auxAlumno->nombre=$alumnoLeido['nombre'];
            $auxAlumno->apellido=$alumnoLeido['apellido'];
            $auxAlumno->edad=$alumnoLeido['edad'];
            $aviso="se modifico el alumno con el legajo: ".$alumnoLeido['legajo'];
        }
        array_push($newArrayAlumnos,$auxAlumno);    //creo un nuevo array con el alumno modificado       
        
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
        echo "no se pudo leer el alumno a modificar(PUT->RAW)"
    }




?>