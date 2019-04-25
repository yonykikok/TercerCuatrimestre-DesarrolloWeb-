<?php
include_once "./Clases/proveedor.php";

$path="./Archivos/proveedores.txt";
$arrayProveedor= array();  
"----------------------------------------------------LISTA Proveedor.txt----------------------------------------------\r\n";
$arrayProveedor=proveedor::LeerProveedoresJson($path);
foreach($arrayProveedor as $auxProveedor)
{
    $auxProveedor->MostrarProveedor();
}
?>