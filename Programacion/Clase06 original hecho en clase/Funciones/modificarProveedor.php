<?php
    include_once "./Clases/proveedor.php";
    $path="./Archivos/proveedores.txt";
        
    if(isset($_POST['id']))
    {        
        if(proveedor::verificarExistenciaDelProveedor(proveedor::LeerProveedores($path),$_POST['id']))
        {            
            if(isset($_POST['nombre']))
            {
                if(isset($_POST['email']))
                {
                    if(isset($_FILES['foto']))
                    { 
                        $id=$_POST['id'];
                        $nombre=$_POST['nombre'];
                        $email=$_POST['email'];
                        $foto=$_FILES['foto']['name'];  
                        
                        if(isset($_FILES['foto']))
                        {
                            $pathImagen=$_FILES['foto']['tmp_name'];
                            $pathLogo=$_FILES['logo']['tmp_name'];
                            $nameImg=$_FILES['foto']['name'];
                            
                            $nameImg=proveedor::changeImgName($nameImg);
                            $pathNewImg="./Fotos/".$nameImg;
                            
                            if(file_exists($pathNewImg))
                            {      
                                $auxNewName=proveedor::AddDateTimeImg($nameImg);
                                $pathBackUpImg="./backUpFotos/".$auxNewName;
                                
                                if(rename($pathNewImg,$pathBackUpImg))//mueve la foto vieja a otra carpeta (backup)
                                {
                                    proveedor::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);    
                                    echo "foto Actualizada";
                                }
                                else
                                { 
                                    echo "No se pudo crear la foto";
                                }
                            }
                            else
                            {
                                proveedor::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);                    
                                echo "Subio la foto";
                                
                            }  
                            $params["foto"]=$pathNewImg;   //agrego un elemento(foto) mas al array de parametros para la instacia de Proveedor.                       
                        }            
                        else
                        {          
                            proveedor::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);    
                            echo "Subio la foto";                            
                        }  
                        $params=array("id"=>$id,"nombre"=>$nombre,"email"=>$email,"foto"=>$foto);

                        $proveedorActual=new proveedor();
                        $proveedorActual->miConstructor($params);
                        var_dump($proveedorActual);

                    }
                    else
                    {
                        echo "falta el foto en POST";
                    }
                }
                else
                {
                    echo "falta el campo email en POST";
                }
            }
            else
            {
                echo "falta el campo nombre en POST";
            }
            
        }
        else
        {
            echo "el ID NO EXISTE";
        }
    }
    else
    {
        echo "falta el campo id en POST";
    }

             
?>