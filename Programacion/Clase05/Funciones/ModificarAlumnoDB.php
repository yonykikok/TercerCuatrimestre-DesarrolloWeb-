<?php
     include_once "./Clases/alumno.php";
     $path="./Archivos/ListaAlumnos.txt";
     $pathJson="./Archivos/ListaAlumnosJson.json";
     $arrayAlumnos=array();
     $newArrayAlumnos=array();
  
     
     $alumnoLeido=json_decode(file_get_contents("php://input"), true);
     if(isset($alumnoLeido))
     {
         $aviso="no se encontro el numero de legajo";
         
             $arrayAlumnos=Alumno::TraerTodoLosAlumnos();
             foreach($arrayAlumnos as $auxAlumno)
             {
                 if($auxAlumno->legajo==$alumnoLeido['legajo'])
                 {          
                     $auxAlumno->ModificarAlumno();           
                     $aviso="se modifico el alumno con el legajo: ".$alumnoLeido['legajo'];
                 }      
             }    
         echo $aviso;//aviso si se modifico o no el alumno.
     }
     else
     {
         echo "no se pudo leer el alumno a modificar(PUT->RAW)";
     }
?>