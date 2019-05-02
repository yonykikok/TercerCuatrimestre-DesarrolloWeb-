<?php

include_once "./Clases/proveedor.php";
include_once "./Clases/producto.php";
$path="./Archivos/proveedores.txt";
$arrayProveedores=proveedor::LeerProveedoresJson($path);
if(isset($_POST['id']))
 {
     if(isset($_POST['producto']))
     {
         if(isset($_POST['cantidad']))
         {
                 $id=$_POST['id'];
                 $producto=$_POST['producto'];
                 $cantidad=$_POST['cantidad'];

                 $params=array("id"=>$id,"producto"=>$producto,"cantidad"=>$cantidad);

                 $producto = new producto();   
                 $producto->miConstructor($params);
                 $path="./Archivos/pedidos.txt";        
                
                
                if(proveedor::verificarExistenciaDelProveedor($arrayProveedores,$producto->id))
                {
                    $producto->GuardarProductoJson($path); 
                }
                else{
                    echo "ERROR, el proveedor no existe.";
                }

         }
         else
         {
             echo "falta el campo cantidad en POST";
         }
     }
     else
     {
         echo "falta el campo producto en POST";
     }
 }
 else
 {
     echo "falta el campo id en POST";
 }
?>