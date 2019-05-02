<?php
include_once "./Clases/proveedor.php";
$directorio = opendir("./backUpFotos"); //ruta actual
$idAntes=-1;
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
       
    }
    else
    {
        $arrayNombreDeImagen=explode("-",$archivo);
        $idDeImagen=$arrayNombreDeImagen[0];
        $fechaDeCreacion=$arrayNombreDeImagen[1]."-".$arrayNombreDeImagen[2]."-".$arrayNombreDeImagen[3];
        $horaDeCreacion=$arrayNombreDeImagen[4].":".$arrayNombreDeImagen[5].":".$arrayNombreDeImagen[6];
        $horaFiltrada=explode(".",$horaDeCreacion);
      
        if($idDeImagen!=$idAntes)
        {
            echo "------------------------------------------------------------<br>";
            echo "ID: ".$idDeImagen."<br>";        
            echo "Nombre: ".proveedor::obtenerDatoPorId($idDeImagen,"nombre")."<br>";
            echo "Foto actual: ".proveedor::obtenerDatoPorId($idDeImagen,"foto")."<br>";   
        }
           /*echo "Fecha de creacion: ".$fechaDeCreacion."<br>";
            echo "Hora de creacion: ".$horaFiltrada[0]."<br>";*/
            echo "Imagen BackUp: ".$archivo."<br>";
            $idAntes=$idDeImagen;
    }
}
?>