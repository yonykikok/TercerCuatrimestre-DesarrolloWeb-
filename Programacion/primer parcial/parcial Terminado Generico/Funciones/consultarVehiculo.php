<?php
include_once "./Clases/vehiculo.php";
include_once "./Clases/dao.php";

$path="./Archivos/vehiculos.txt";
$arrayVehiculos= array();  
"----------------------------------------------------LISTA----------------------------------------------\r\n";
$tipoDeDato=new vehiculo();
if(isset($_GET["dato"]))
{
    $dato=$_GET["dato"];
    $arrayObjetos=dao::LeerObjetosPorDatosJson($path,$_GET["dato"],$tipoDeDato);
    foreach($arrayObjetos as $auxObjeto)
    {
        echo "<br>";
        $auxObjeto->MostrarObjeto();
    }
}
else
{
    echo "falta el campo dato en GET";
}
?>