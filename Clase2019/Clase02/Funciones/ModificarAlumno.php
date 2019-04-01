<?php
    include_once "./Clases/alumno.php";

    $path="./Archivos/ListaAlumnos.txt";
    $pathJson="./Archivos/ListaAlumnosJson.json";
    $arrayAlumnos=array();
    $newArrayAlumnos=array();
    echo "HASTA ACA BIEN"
    if(isset($_GET['Legajo']))
    {
        if(isset($_GET['Nombre']))
        {
            if(isset($_GET['Apellido']))
            {
                if(isset($_GET['Edad']))
                {
                    $nombre=$_GET['Nombre'];
                    $apellido=$_GET['Apellido'];
                    $edad=$_GET['Edad'];                   

                    $arrayAlumnos=Alumno::LeerAlumnosJson($pathJson);
                    $aviso="no se encontro el numero de legajo";
                    foreach($arrayAlumnos as $auxAlumno)
                    {
                        if($auxAlumno->legajo==$_GET['Legajo'])
                        {
                            $auxAlumno->nombre=$nombre;
                            $auxAlumno->apellido=$apellido;
                            $auxAlumno->edad=$edad;
                            $aviso="se modifico el alumno con el legajo: ".$_GET['Legajo'];
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
                    echo "falta el campo Edad en POST (PUT)";
                }
            } 
            else
            {
                echo "falta el campo Apellido en POST (PUT)";
            }
        } 
        else
        {
            echo "falta el campo Nombre en POST (PUT)";
        }
    }  
    else
    {
        echo "falta el campo Legajo en POST (PUT)";
    }




?>