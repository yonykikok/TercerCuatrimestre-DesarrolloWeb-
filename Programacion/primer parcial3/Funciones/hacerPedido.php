<?php

include_once "./Clases/proveedor.php";
include_once "./Clases/pedido.php";
include_once "./Clases/dao.php";
$path="./Archivos/pedidos.txt";   
if(isset($_POST['id']))
 {
     if(isset($_POST['producto']))
     {
         if(isset($_POST['cantidad']))
         {
                    $id=$_POST['id'];
                    $producto=$_POST['producto'];
                    $cantidad=$_POST['cantidad'];

                    $params=array("idProveedor"=>$id,"producto"=>$producto,"cantidad"=>$cantidad);
                    
                    $pedido = new pedido();   
                    $pedido->miConstructorGenerico($params);
                    
                    if(file_exists($path))
                    {
                    
                        $arrayListaObjestos=dao::LeerObjetosJson($path,$pedido); 
                        if(!dao::verificarExistenciaDelObjeto($arrayListaObjestos,$id,'idProveedor'))
                        {
                            dao::GuardarObjetoJson($path,$pedido); 
                            echo "Pedido guardado.";
                        } 
                        else
                        {
                            echo "El id del servicio ya esta cargado";
                        }    
                    
                    }
                    else
                    {                            
                        dao::GuardarObjetoJson($path,$pedido); 
                        echo "Pedido guardado.";
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