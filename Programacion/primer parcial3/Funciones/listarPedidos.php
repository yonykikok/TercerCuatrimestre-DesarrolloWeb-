<?php
include_once "./Clases/pedido.php";
include_once "./Clases/proveedor.php";
include_once "./Clases/dao.php";

$path="./Archivos/pedidos.txt";
$path2="./Archivos/proveedores.txt";
"----------------------------------------------------LISTA----------------------------------------------\r\n";
$tipoDeDato=new pedido();
$tipoDeDato2=new proveedor();
$arrayObjetos=dao::LeerObjetosJson($path,$tipoDeDato);
$arrayObjetos2=dao::LeerObjetosJson($path2,$tipoDeDato2);
foreach($arrayObjetos as $auxObjeto)
{
    foreach($arrayObjetos2 as $auxObjeto2)
    {
        if($auxObjeto->idProveedor==$auxObjeto2->id)
        {
            echo "Nombre: ".$auxObjeto2->nombre;
        }
    }
    echo "<br>";
    $auxObjeto->MostrarObjeto();
    echo "-----------------------<br>";
}
?>