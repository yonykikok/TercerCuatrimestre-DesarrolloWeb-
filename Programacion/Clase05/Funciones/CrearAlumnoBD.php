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
                    if(isset($_FILES['img']))
                    {
                        $pathImagen=$_FILES['img']['tmp_name'];
                        $pathLogo=$_FILES['logo']['tmp_name'];
                        $nameImg=$_FILES['img']['name'];
                        
                        $nameImg=Alumno::changeImgName($nameImg);
                        $pathNewImg="./Fotos/".$nameImg;

                        $params["imagen"]=$pathNewImg; 
                    }      
                    $alumno = new Alumno();  
                    $alumno->miConstructor($params);
                    $alumno->InsertarAlumno();  
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