<?php

include_once "./Clases/producto.php";
include_once "./Clases/proveedor.php";

$pathPedidos="./Archivos/pedidos.txt";
$pathProveedores="./Archivos/proveedores.txt";
$arrayProductos= array();  

//Leer proveedores
$arrayProveedores=proveedor::LeerProveedores($pathProveedores);
$arrayProductos=producto::LeerProductos($pathPedidos);

if(producto::verificarExistenciaDelProducto($arrayProductos,$_GET["id"]))
{        
    foreach($arrayProductos as $auxProducto)
    {
        echo "id: ".$auxProducto->id."<br>";     
        echo "Producto: ".$auxProducto->producto."<br>";   
        echo "Cantidad: ".$auxProducto->cantidad; 
        foreach($arrayProveedores as $auxProveedor)
        {            
            if($auxProducto->id==$auxProveedor->id)
            {                                         
             echo "Proveedor: ".$auxProveedor->nombre."<br>";   
            }  
        }        
        echo "-----------<br>";        
    }
}
?>