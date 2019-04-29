<?php

include_once "./Clases/producto.php";
include_once "./Clases/proveedor.php";

$pathPedidos="./Archivos/pedidos.txt";
$pathProveedores="./Archivos/proveedores.txt";
$arrayProductos= array();  

//Leer proveedores
$arrayProveedores=proveedor::LeerProveedoresJson($pathProveedores);
$arrayProductos=producto::LeerProductosJson($pathPedidos);

       
foreach($arrayProductos as $auxProducto)
{   
    foreach($arrayProveedores as $auxProveedor)
    {            
        if($auxProducto->id==$auxProveedor->id)
        {                
            echo "<br>--------------------------<br>";                      
            echo "Proveedor: ".$auxProveedor->nombre."<br>";   
        }  
    }    
    echo "id: ".$auxProducto->id."<br>";     
    echo "Producto: ".$auxProducto->producto."<br>";   
    echo "Cantidad: ".$auxProducto->cantidad;           
}
?>