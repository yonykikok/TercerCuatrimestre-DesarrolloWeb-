<?php
 include "./Clases/proveedor.php";   
     
 if(isset($_POST['id']))
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
                 $params=array("id"=>$id,"nombre"=>$nombre,"email"=>$email,"foto"=>$foto);

                 $proveedor = new proveedor();   
                 $proveedor->miConstructor($params);
                 $path="./Archivos/proveedores.txt";

                 $arrayProveedor=array();
                 if(file_exists($path)){

                     $arrayProveedor=proveedor::LeerProveedoresJson($path);
                    }
                if($proveedor->GuardarProveedorJson($path))
                {
                    echo "Guardamos el proveedor";
                }

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
     echo "falta el campo id en POST";
 }

?>