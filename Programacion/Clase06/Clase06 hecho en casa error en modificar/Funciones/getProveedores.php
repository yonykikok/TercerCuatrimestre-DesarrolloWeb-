<?php
include_once "./Clases/proveedor.php";

$path="./Archivos/proveedores.txt";
$arrayProveedor= array();  
"----------------------------------------------------LISTA Proveedor.txt----------------------------------------------\r\n";
$arrayProveedor=proveedor::LeerProveedores($path);
foreach($arrayProveedor as $auxProveedor)
{
    $auxProveedor->MostrarProveedor();
}
?>