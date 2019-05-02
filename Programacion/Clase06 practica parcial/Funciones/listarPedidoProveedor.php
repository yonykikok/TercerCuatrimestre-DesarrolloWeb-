<?php

include_once "./Clases/producto.php";
include_once "./Clases/proveedor.php";

$pathPedidos="./Archivos/pedidos.txt";
$pathProveedores="./Archivos/proveedores.txt";
$arrayProductos= array();  

//Leer proveedores
$arrayProveedores=proveedor::LeerProveedoresJson($pathProveedores);
$arrayProductos=producto::LeerProductosJson($pathPedidos);
if(proveedor::verificarExistenciaDelProveedor($arrayProveedores,$_GET["id"]))
{        
    foreach($arrayProveedores as $auxProveedor)
    {
               
        if($auxProveedor->id==$_GET["id"])
        {
            echo "<br>--------------------------<br>";    
            echo "Proveedor: ".$auxProveedor->nombre."<br>";   
            echo "id: ".$auxProveedor->id."<br>";     
            foreach($arrayProductos as $auxProducto)
            {            
                if($auxProducto->id==$auxProveedor->id)
                {                                         
                    echo "Producto: ".$auxProducto->producto."<br>";   
                    echo "Cantidad: ".$auxProducto->cantidad."<br>"; 
                    echo "-----------<br>";        
                }  
            }
              
        }
        
    }
}
?>