<?php
    include_once "./Clases/alumno.php";
    $path="./Archivos/ListaAlumnos.txt";
    $pathJson="./Archivos/ListaAlumnosJson.json";
    $arrayAlumnos=array();
    $newArrayAlumnos=array();


    $alumnoLeido=json_decode(file_get_contents("php://input"), true);
  //  var_dump($alumnoLeido);
    if(isset($alumnoLeido))
    {
        $aviso="no se encontro el numero de legajo";
        if(file_exists($pathJson))
        {
            $arrayAlumnos=Alumno::LeerAlumnosJson($pathJson);
            foreach($arrayAlumnos as $auxAlumno)
            {
                if($auxAlumno->legajo==$alumnoLeido['legajo'])
                {
                    $auxAlumno->nombre=$alumnoLeido['nombre'];
                    $auxAlumno->apellido=$alumnoLeido['apellido'];
                    $auxAlumno->edad=$alumnoLeido['edad'];
                    $aviso="se modifico el alumno con el legajo: ".$alumnoLeido['legajo'];
                   // var_dump($auxAlumno);
                }
               array_push($newArrayAlumnos,$auxAlumno);    //creo un nuevo array con el alumno modificado
            }
            unlink("./Archivos/ListaAlumnosJson.json");//borro el archivo fisico

            foreach($newArrayAlumnos as $alumno)
            {
                $auxAlumno=new Alumno((array)$alumno);
                $auxAlumno->GuardarAlumnoJson("./Archivos/ListaAlumnosJson.json");//creamos un nuevo archivo con todos los elementos del "newArrayAlumnos"
            }
        }
        else
        {

        }
        echo $aviso;//aviso si se borro o no el alumno.
    }
    else
    {
        echo "no se pudo leer el alumno a modificar(PUT->RAW)";
    }
?>
