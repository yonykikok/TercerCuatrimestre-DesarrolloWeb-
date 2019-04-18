<?php
     include_once "./Clases/alumno.php";
     $arrayAlumnoLeido=json_decode(file_get_contents("php://input"), true);
     if(isset($arrayAlumnoLeido))
     {
         $aviso="no se encontro el numero de legajo";         
             $arrayAlumnos=Alumno::TraerTodoLosAlumnos();
             foreach($arrayAlumnos as $auxAlumno)
             {
                 if($auxAlumno->legajo==$arrayAlumnoLeido['legajo'])
                 {   
                     $alumnoLeido= new Alumno();                
                     $alumnoLeido->miConstructor($arrayAlumnoLeido);
                   //  var_dump($alumnoLeido);
                    $auxAlumno->ModificarAlumno($alumnoLeido);
                    $aviso="se modifico el alumno con el legajo: ".$arrayAlumnoLeido['legajo'];
                 }      
             }    
         echo $aviso;//aviso si se modifico o no el alumno.
     }
     else
     {
         echo "no se pudo leer el alumno a modificar(PUT->RAW)";
     }
?>