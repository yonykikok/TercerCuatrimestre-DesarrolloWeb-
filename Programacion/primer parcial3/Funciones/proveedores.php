<?php
include_once "./Clases/proveedor.php";
include_once "./Clases/dao.php";

$path="./Archivos/proveedores.txt";
"----------------------------------------------------LISTA----------------------------------------------\r\n";
$tipoDeDato=new proveedor();

    $arrayObjetos=dao::LeerObjetosJson($path,$tipoDeDato);
    foreach($arrayObjetos as $auxObjeto)
    {
        echo "<br>";
        $auxObjeto->MostrarObjeto();
    }

?>