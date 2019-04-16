<?php

    include "./Clases/alumno.php";   
     
    if(isset($_POST['Nombre']))
    {
        if(isset($_POST['Legajo']))
        {
            if(isset($_POST['Apellido']))
            {
                if(isset($_POST['Edad']))
                {
                    $nombre=$_POST['Nombre'];
                    $apellido=$_POST['Apellido'];
                    $edad=$_POST['Edad'];
                    $legajo=$_POST['Legajo'];
                    
                    $params=array("nombre"=>$nombre,"apellido"=>$apellido,"edad"=>$edad,"legajo"=>$legajo);
                    
                    $pathJson="./Archivos/ListaAlumnosJson.json";
                    var_dump(isset($_FILES['img']));
                    if(isset($_FILES['img']))
                    {
                        $pathImagen=$_FILES['img']['tmp_name'];
                        $pathLogo=$_FILES['logo']['tmp_name'];
                        $nameImg=$_FILES['img']['name'];
                        
                        $nameImg=Alumno::changeImgName($nameImg);
                        $pathNewImg="./Fotos/".$nameImg;
                        
                        if(file_exists($pathNewImg))
                        {      
                            $auxNewName=Alumno::AddDateTimeImg($nameImg);
                            $pathBackUpImg="./FotosBackUp/".$auxNewName;
                            
                            if(rename($pathNewImg,$pathBackUpImg))//mueve la imagen vieja a otra carpeta (backup)
                            {
                                Alumno::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);    
                                echo "Imagen Actualizada";
                            }
                            else
                            { 
                                echo "No se pudo crear la imagen";
                            }
                        }
                        else
                        {
                            Alumno::CrearImgConMarca($pathImagen,$pathLogo,$pathNewImg);                    
                            echo "Subio la imagen";
                            
                        }  
                        $params["imagen"]=$pathNewImg;   //agrego un elemento(imagen) mas al array de parametros para la instacia de Alumno.                       
                    }            

                    $alumno = new Alumno($params);  
                    $alumno->GuardarAlumnoJson($pathJson);   
                }
                else
                {
                    echo "falta el campo Edad en POST";
                }
            }
            else
            {
                echo "falta el campo Apellido en POST";
            }
        }
        else
        {
            echo "falta el campo Legajo en POST";
        }
    }
    else
    {
        echo "falta el campo Nombre en POST";
    }
 
?>
