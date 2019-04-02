<?php

include "./Clases/alumno.php";

if(isset($_GET['Legajo']))
{
    $path="./Archivos/ListaAlumnos.txt";
    $pathJson="./Archivos/ListaAlumnosJson.json";
    $arrayAlumnos=array();
    $newArrayAlumnos=array();
    $arrayAlumnos=Alumno::LeerAlumnosJson($pathJson);
    $aviso="no se encontro el numero de legajo";
    foreach($arrayAlumnos as $auxAlumno)
    {
        if($auxAlumno->legajo==$_GET['Legajo'])
        {
            $aviso="se borro el alumno con el legajo: ".$_GET['Legajo'];
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
    echo "falta el campo Legajo en Get (DELETE)";
}



?>