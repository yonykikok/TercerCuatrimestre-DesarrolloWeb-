<?php
    include_once "./Clases/dao.php";
    include_once "./Clases/vehiculo.php";
    $path="./Archivos/vehiculos.txt";
              
    if(isset($_POST['patente']))
    {              //verificamos que exista el proveedor en el archivo, de lo contrario no se puede modificar
        $vehiculo=new vehiculo();

        if(dao::verificarExistenciaDelObjeto(dao::LeerObjetosJson($path,$vehiculo),$_POST['patente'],'patente'))
        {  
            if(isset($_POST['marca']))
            {
                if(isset($_POST['modelo']))
                {
                    if(isset($_POST['precio']))
                    {
                        if(isset($_FILES['foto']))
                        {
                            $patente=$_POST['patente'];
                            $marca=$_POST['marca'];
                            $modelo=$_POST['modelo'];
                            $precio=$_POST['precio'];

                            $foto=$_FILES['foto']['name'];  
                            
                            if(isset($_FILES['foto']))
                            {
                                $pathImagen=$_FILES['foto']['tmp_name'];                                
                                if(isset($_FILES['logo']))//opcional por si cargamos un logo
                                {
                                    $pathLogo=$_FILES['logo']['tmp_name'];
                                }
                                else
                                {
                                    $pathLogo="./FotosPng/utn.png";//logo por default
                                }
                                $nameImg=$_FILES['foto']['name'];
                                
                                $nameImg=dao::changeImgName($nameImg);
                                $pathNewImg="./Fotos/".$nameImg;
                                
                                if(file_exists($pathNewImg))
                                {      
                                    $auxNewName=dao::AddDateTimeImg($nameImg);
                                    $pathBackUpImg="./backUpFotos/".$auxNewName;
                                    
                                    if(rename($pathNewImg,$pathBackUpImg))//mueve la foto vieja a otra carpeta (backup)
                                    {
                                        dao::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);    
                                        echo "foto Actualizada";
                                    }
                                    else
                                    { 
                                        echo "No se pudo crear la foto";
                                    }
                                }
                                else
                                {
                                    dao::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);                    
                                    echo "Subio la foto";
                                    
                                }  
                                $params["foto"]=$pathNewImg;   //agrego un elemento(foto) mas al array de parametros para la instacia de Proveedor.  
                            }            
                            else
                            {          
                                dao::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);    
                                echo "Subio la foto";                            
                            }  
                            $params=array("patente"=>$patente,"marca"=>$marca,"modelo"=>$modelo,"precio"=>$precio,"foto"=>$pathNewImg);

                            $vehiculoActual=new vehiculo();
                            $vehiculoActual->miConstructor($params);
                            vehiculo::Modificar($path,$vehiculoActual,'patente',$vehiculo);
                        }
                        else
                        {
                            echo "falta el foto en POST";
                        }
                    }
                    else
                    {
                        echo "falta el campo precio en POST";
                    }
                }
                else
                {
                    echo "falta el campo modelo en POST";
                }
            }
            else
            {
                echo "falta el campo marca en POST";
            }
            
        }
        else
        {
            echo "la patente no existe en la lisa de vehiculos";
        }
    }
    else
    {
        echo "falta el campo patente en POST";
    }
