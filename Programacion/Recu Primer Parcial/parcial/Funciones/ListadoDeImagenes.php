<?php
if(isset($_GET['dato']))
{
    if($_GET['dato']=="cargadas")
    {        
        $directorio = opendir("./ImagenesDePizza"); //ruta actual
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
            if (is_dir($archivo))//verificamos si es o no un directorio
            {
            
            }
            else
            {       
                echo "<img src='./ImagenesDePizza/".$archivo."'>";
                  //  echo "Imagen de Pizza: <img src='./ImagenesDePizza".$archivo."'><br>";
            }
        } 
             
    }
    else if($_GET['dato']=="borradas")
    { 
        $directorio = opendir("./backUpFotos"); //ruta actual
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
            if (is_dir($archivo))//verificamos si es o no un directorio
            {
            
            }
            else
            {       
                    echo "Imagen de Pizza: <img src=./backUpFotos/".$archivo."  ><br>";
            }
        } 
    }
    else {
        echo "solo se pueden listar las cargadas o borradas";
    }
   
}
else{
    echo "falta el campo dato en GET";
}
?>