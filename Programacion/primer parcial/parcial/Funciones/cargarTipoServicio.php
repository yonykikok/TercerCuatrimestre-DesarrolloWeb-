<?php

include_once "./Clases/vehiculo.php";
include_once "./Clases/pedido.php";
$path="./Archivos/vehiculos.txt";
$arrayVehiculos=vehiculo::LeerVehiculosJson($path);
if(isset($_POST['id']))
 {
     if(isset($_POST['nombre']))
     {
         if(isset($_POST['tipo']))
         {
            if(isset($_POST['precio']))
            {
                if(isset($_POST['demora']))
                {
                    $id=$_POST['id'];
                    $nombre=$_POST['nombre'];
                    $tipo=$_POST['tipo'];
                    $precio=$_POST['precio'];
                    $demora=$_POST['demora'];

                    $params=array("id"=>$id,"nombre"=>$nombre,"tipo"=>$tipo,"precio"=>$precio,"demora"=>$demora);

                    $pedido = new pedido();   
                    $pedido->miConstructor($params);
                    $path="./Archivos/tiposServicio.txt";        
                    
                    if($_POST['tipo']=="10.000km" ||$_POST['tipo']=="20.000km" ||$_POST['tipo']=="50.000km")
                    {
                        $pedido->GuardarPedidoJson($path); 
                        echo "Pedido guardado.";
                    }else
                    {
                        echo "ERROR en el tipo de servicio".$_POST['tipo'];
                    }
                   
                }
                else
                {
                    echo "falta el campo demora en POST";
                }
            }        
            else
            {
                echo "falta el campo precio en POST";
            }
         }
         else
         {
             echo "falta el campo tipo en POST";
         }
     }
     else
     {
         echo "falta el campo nombre en POST";
     }
 }
 else
 {
     echo "falta el campo id en POST";
 }
?>