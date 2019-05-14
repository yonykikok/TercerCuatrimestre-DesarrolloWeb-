<?php
include_once "./Clases/pizza.php";
include_once "./Clases/dao.php";

$path="./Archivos/pizza.txt";
"----------------------------------------------------LISTA----------------------------------------------\r\n";
$tipoDeDato=new pizza();
if(isset($_GET["dato"]))
{
    $dato=$_GET["dato"];
    $arrayObjetos=dao::LeerObjetosPorUnDatosJson($path,$_GET["dato"],$tipoDeDato);
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