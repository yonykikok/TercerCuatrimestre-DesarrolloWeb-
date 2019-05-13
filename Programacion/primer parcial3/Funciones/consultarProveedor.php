<?php
include_once "./Clases/proveedor.php";
include_once "./Clases/dao.php";

$path="./Archivos/proveedores.txt";
"----------------------------------------------------LISTA----------------------------------------------\r\n";
$tipoDeDato=new proveedor();
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