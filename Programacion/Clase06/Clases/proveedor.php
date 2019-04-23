<?php
class proveedor{

    function RetornarJson()
    {
        return json_encode($this);
    }

    public function GuardarProveedor($path)
    {
        if(file_exists($path))
        {
            $file = fopen($path,"a");
            fwrite($file,$this->id.";".$this->nombre.";".$this->email.";".$this->foto."\r\n");
        }
        else
        {
            $file = fopen($path,"w");
            fwrite($file,$this->id.";".$this->nombre.";".$this->email.";".$this->foto."\r\n");
        }   
        fclose($file);         
    }
    
    function miConstructor($params){
        if(array_key_exists("id",(array)$params))
        {
            $this->id=$params['id'];
        }
        if(array_key_exists("nombre",(array)$params))
        {
            $this->nombre=$params['nombre'];
        }
        
        if(array_key_exists("email",(array)$params))
        {
            $this->email=$params['email'];
        }
        if(array_key_exists("foto",(array)$params))
        {
            $this->foto=$params['foto'];
        }
    }
    public function MostrarProveedor()
    {
            echo "Id: ".$this->id."<br/>";
            echo "Nombre: ".$this->nombre."<br/>";
            echo "Email: ".$this->email."<br/>";
            echo "Foto: ".$this->foto."<br/><br/>";
    }
    public static function LeerProveedoresPorNombre($path)
    {
        $file=fopen($path,"r");
        $arrayProveedores=array();
        $contadorDeCoincidencias=0;
        while(!feof($file)){
            $stringProveedor=explode(";",fgets($file));
            if(feof($file))
            {
                break;
            }
            $id=$stringProveedor[0];
            $nombre=$stringProveedor[1];
            $email=$stringProveedor[2];
            $foto= $stringProveedor[3];

            $params=array("id"=>$id,"nombre"=>$nombre,"email"=>$email,"foto"=>$foto);
            $auxProveedor = new proveedor();    
            $auxProveedor->miConstructor($params);

            echo "<br/>";
            if(strcasecmp ($auxProveedor->nombre,$_GET["nombre"])==0)
            {
                array_push($arrayProveedores,$auxProveedor);
                $contadorDeCoincidencias++;
            }
        }        
        if($contadorDeCoincidencias==0)
        {
            echo "No existe proveedor: ".$_GET["nombre"];
        }
        fclose($file);
        return $arrayProveedores;
    }
    public static function LeerProveedores($path)
    {
        $file=fopen($path,"r");
        $arrayProveedores=array();
        while(!feof($file)){
            $stringProveedor=explode(";",fgets($file));
            if(feof($file))
            {
                break;
            }
            $id=$stringProveedor[0];
            $nombre=$stringProveedor[1];
            $email=$stringProveedor[2];
            $foto= $stringProveedor[3];

            $params=array("id"=>$id,"nombre"=>$nombre,"email"=>$email,"foto"=>$foto);
            $auxProveedor = new proveedor();    
            $auxProveedor->miConstructor($params);

          //  echo "<br/>";
            
                array_push($arrayProveedores,$auxProveedor);
        } 
        fclose($file);
        return $arrayProveedores;
    }
    public static function verificarExistenciaDelProveedor($arrayProveedores,$id)
    {
        $existeIdProveedor=false;
        foreach($arrayProveedores as $auxProveedor)
        {   
            if($auxProveedor->id==$id)
            {
                $existeIdProveedor=true;
                break;
            }
        }
            return $existeIdProveedor;
    }
    
   
    public static function changeImgName($nameImg)
    {
        $arrayNameImg=explode('.',$nameImg);//creo un array y separo
        $arrayNameImg[0]=$_POST['id'];
        $nameImg=$arrayNameImg[0].".".$arrayNameImg[1];
        return $nameImg;
    }

    public static function AddDateTimeImg($nameImg)
    {
        $arrayNameImg=explode('.',$nameImg);//creo un array y separo
        $auxNewName=$arrayNameImg[0].date("-Y-m-d").date("-h-i-sa").".".$arrayNameImg[1];//creo el nuevo nombre de la imagen agregando fecha y hora     
        return $auxNewName;
    }

    public static function CrearImgConMarca($path,$pathLogo,$pathNewImg)
    {
        $marca = imagecreatefrompng($pathLogo);//creamos el sello
        $img = imagecreatefromjpeg($path);//creamos la imagen

        $right =10;
        $bottom = 10;
        $jx = imagesx($marca);
        $jy = imagesY($marca);

        imagecopy($img, $marca, imagesx($img) - $jx - $right, imagesy($img) - $jy - $bottom, 0, 0, imagesx($marca), imagesy($marca));


        move_uploaded_file($path,$pathNewImg);
        imagepng($img, $pathNewImg);//guarda la imagen que creamos con el sello de agua en el pathNewImg
    }
    public function ModificarProveedor($id,$proveedorActual)
    {
        $newArrayProveedores=array();
        $pathProveedores="./Archivos/proveedores.txt";
        $arrayProveedores=proveedor::LeerProveedores($pathProveedores);
        foreach($arrayProveedores as $auxProveedor)
        {
            if($auxProveedor->id==$proveedorActual->id)
            {
                $auxProveedor->nombre=$proveedorActual->nombre;
                $auxProveedor->email=$proveedorActual->email;
                $auxProveedor->foto=$proveedorActual->foto;
                $aviso="se modifico el proveedor con el id: ".$proveedorActual->id;
            }
           array_push($newArrayProveedores,$auxProveedor);    //creo un nuevo array con el proveedor modificado
        }
        unlink("./Archivos/proveedores.txt");//borro el archivo fisico

        foreach($newArrayProveedores as $proveedor)
        {
            $auxProveedor=new proveedor((array)$proveedor);
            $auxProveedor->GuardarProveedor("./Archivos/proveedores.txt");//creamos un nuevo archivo con todos los elementos del "newArray"
        }
    }
}
?>