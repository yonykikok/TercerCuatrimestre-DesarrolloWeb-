<?php
 include "./Clases/pizza.php";  
 include "./Clases/venta.php";  
 include "./Clases/dao.php";   

     if(isset($_POST['sabor']))
     {
         if(isset($_POST['email']))
         {
            if(isset($_POST['tipo']))
            {
                if(isset($_POST['cantidad']))
                {               
                    $sabor=$_POST['sabor'];
                    $email=$_POST['email'];
                    $tipo=$_POST['tipo'];
                    $cantidad=$_POST['cantidad'];
                    $venta = new venta();    
                    $pizza = new pizza();                   
                                        
                    $path="./Archivos/pizza.txt";
                    $pathVenta="./Archivos/venta.txt";
                    
                    $arrayPizzas=array();
                    if(file_exists($path))
                    {
                        $arrayPizzas=dao::LeerObjetosJson($path,$pizza);
                        
                        $id=0;  
                        $bandera=0;
                        $pizzaVendida=dao::obtenerPizza($arrayPizzas,$tipo,$sabor,'tipo','sabor');
                        if($pizzaVendida!= null)
                        {
                       /* if(dao::verificarExistenciaDelObjetoDobleDato($arrayPizzas,$tipo,$sabor,'tipo','sabor'))
                        { */     
                            if($pizzaVendida->cantidad<$cantidad)
                            {
                                echo "no hay tanto stock disponible";
                            }
                            else{
                                
                            $arrayVentas=array();
                            if(file_exists($pathVenta))
                            {
                             $arrayVentas=dao::LeerObjetosJson($pathVenta,$venta);
                             do
                             {
                                 if(!dao::verificarExistenciaDelObjeto($arrayVentas,$id,'id'))
                                 {                                        
                                     $params=array("id"=>$id,"sabor"=>$sabor,"email"=>$email,"tipo"=>$tipo,"cantidad"=>$cantidad);
                                     $venta->miConstructorGenerico($params);
                                     dao::GuardarObjetoJson($pathVenta,$venta);
                                     echo "Guardamos la venta";  
                                     $pizzaVendida->cantidad=$pizzaVendida->cantidad - $cantidad;
                                     venta::Modificar($path,$pizzaVendida,'id',$pizza);
                                     $bandera++;                                  
                                 }
                                 else
                                 {
                                     $id++;
                                 }
                             }while($bandera==0); 
                             
                            }
                            else
                            {                            
                                $id=0;                           
                                $params=array("id"=>$id,"sabor"=>$sabor,"email"=>$email,"tipo"=>$tipo,"cantidad"=>$cantidad);
                                $venta->miConstructorGenerico($params);
                                dao::GuardarObjetoJson($pathVenta,$venta);
                                echo "Guardamos la venta";   
                            }
                            
                        }
                                                        
                        }     
                        else
                        {
                            echo "no tenemos disponible ese tipo y sabor";
                        }         
                    
                    }
                    else
                    {                            
                        echo "no hay pizzas en el archivo";
                    }
                }
                else
                {
                    echo "falta el campo cantidad en POST";
                }
            }
            else
            {
                echo "falta el campo tipo en POST";
            }
         }
         else
         {
             echo "falta el campo email en POST";
         }
     }
     else
     {
         echo "falta el campo sabor en POST";
     }

?>
