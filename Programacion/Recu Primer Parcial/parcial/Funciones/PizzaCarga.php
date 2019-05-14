<?php
 include "./Clases/pizza.php";  
 include "./Clases/dao.php";   
 if(isset($_POST['sabor']))
 {
     if(isset($_POST['precio']))
     {
         if(isset($_POST['tipo']))
         {
            if(isset($_POST['cantidad']))
            {
                if(strcasecmp($_POST['sabor'],"muzza")==0 ||strcasecmp( $_POST['sabor'],"jamon")==0||strcasecmp( $_POST['sabor'],"especial")==0)
                {

                    if (strcasecmp( $_POST['tipo'],"molde")==0|| strcasecmp( $_POST['tipo'],"piedra")==0)
                    {                        
                        if(isset($_FILES['foto']))
                        {          
                            $sabor=$_POST['sabor'];
                            $precio=$_POST['precio'];
                            $tipo=$_POST['tipo'];
                            $cantidad=$_POST['cantidad'];                            
                            $foto=$_FILES['foto']['name'];  
                    

                            $pizza = new pizza(); 
                            
                            $path="./Archivos/Pizza.txt";
                            
                            $arrayPizzas=array();
                            if(file_exists($path))
                            {
                                $arrayPizzas=dao::LeerObjetosJson($path,$pizza);
                                
                                $id=0;  
                                $bandera=0;
                                do
                                {
                                    if(!dao::verificarExistenciaDelObjeto($arrayPizzas,$id,'id'))
                                    {                                                                            
                                        $arrayNombre=array("sabor"=>$sabor,date("Y-m-d"));
                                        $pizza->cargarFoto($arrayNombre);// hacer que sea mas generico
                                        $params=array("sabor"=>$sabor,"precio"=>$precio,"tipo"=>$tipo,"cantidad"=>$cantidad,"id"=>$id,"foto"=>$foto);
                                        $pizza->miConstructorGenerico($params);
                                        dao::GuardarObjetoJson($path,$pizza);
                                        echo "Guardamos la pizza";      
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
                                $arrayNombre=array("id"=>$id);
                                $pizza->cargarFoto($arrayNombre);// hacer que sea mas generico
                                $params=array("sabor"=>$sabor,"precio"=>$precio,"tipo"=>$tipo,"cantidad"=>$cantidad,"id"=>$id,"foto"=>$foto);
                                $pizza->miConstructorGenerico($params);
                                dao::GuardarObjetoJson($path,$pizza);
                                echo "Guardamos el pizza";
                            }
                    }
                    else
                    {
                        echo "falta el campo foto en POST";
                    }  
                    }
                    else
                    {                    
                        echo "los tipos disponibles son molde o piedra";
                    }
                }
                else
                {
                    echo "los sabores disponibles son jamon, muzza o especial";
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
        echo "falta el campo precio en POST";
    } 
}
else
{
    echo "falta el campo sabor en POST";
}

?>