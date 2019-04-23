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

                 $arrayProveedor=proveedor::LeerProveedores($path);
                 $existeIdProveedor=0;
                 foreach($arrayProveedor as $auxProveedor)
                 {   
                    if($auxProveedor->id==$_POST['id'])
                    {
                        echo "el proveedor con el id: ".$_POST['id']." ya existe";
                        $existeIdProveedor=1;
                        break;
                    }
                }
                if($existeIdProveedor==0)
                {
                    $proveedor->GuardarProveedor($path); 
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