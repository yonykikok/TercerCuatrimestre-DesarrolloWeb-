<?php
 include "./Clases/proveedor.php";  
 include "./Clases/dao.php";   
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
                 $proveedor = new proveedor();   
                
                 $arraNombre=array("nombre"=>$nombre,"id"=>$id);
                 $proveedor->cargarFoto($arraNombre);// hacer que sea mas generico

                 $params=array("id"=>$id,"nombre"=>$nombre,"email"=>$email,"foto"=>$foto);
                
                 $proveedor->miConstructorGenerico($params);
                 $path="./Archivos/proveedores.txt";
                 
                 $arrayProveedores=array();
                 if(file_exists($path))
                 {
                     $arrayProveedores=dao::LeerObjetosJson($path,$proveedor);
                     if(!dao::verificarExistenciaDelObjeto($arrayProveedores,$id,'id'))
                     {
                        dao::GuardarObjetoJson($path,$proveedor);
                        echo "Guardamos el proveedor";
                        
                     }
                     else
                     {
                        echo "El proveedor con el id: ".$id." ya esta en la lista";
                     }
                 }
                 else
                 {
                    dao::GuardarObjetoJson($path,$proveedor);
                    echo "Guardamos el proveedor";
                 }
             }
             else
             {
                 echo "falta el campo foto en POST";
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