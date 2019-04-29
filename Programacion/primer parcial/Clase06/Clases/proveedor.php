<?php
class proveedor{

    public $id;
    public $nombre;
    public $email;
    public $foto;
    
    function RetornarJson()
    {
        return json_encode($this);
    }

    function GuardarProveedorJson($path)
    {
        $retorno=false;
        if(file_exists($path))
        {            
          $file = fopen($path,"a");
          $listaProveedores=proveedor::LeerProveedoresJson($path);
         
            if(!proveedor::verificarExistenciaDelProveedor($listaProveedores,$this->id))
            {
                fwrite($file,$this->RetornarJson()."\r\n");
                $retorno=true;
            }
            else
            {                
                echo "el proveedor con el id: ".$_POST['id']." ya existe";
            }            
        }
        else
        {
            $file = fopen($path,"w");
            fwrite($file,$this->RetornarJson()."\r\n");
            $retorno=true;
        }   
        fclose($file);  
        return $retorno;       
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

    public static function LeerProveedoresPorNombreJson($path)
    {
        $arrayProveedores=array();        
        $contadorDeCoincidencias=0;
        foreach(proveedor::LeerProveedoresJson($path) as $auxAlumno)
        {
            $auxProveedor = new proveedor();    
            $auxProveedor->miConstructor((array)$auxAlumno);
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
        return $arrayProveedores;
        
    }
    public static function LeerProveedoresJson($path)
    {
        $file=fopen($path,"r");
        $arrayProveedores=array();
        while(!feof($file)){            
            $proveedorLeido=json_decode(fgets($file),true);             
            if(feof($file))
            {
                break;
            }
            $proveedor = new proveedor();  
            $proveedor->miConstructor($proveedorLeido);
            array_push($arrayProveedores,$proveedor);
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
    public static function ModificarProveedor($id,$proveedorActual)
    {
        $newArrayProveedores=array();
        $pathProveedores="./Archivos/proveedores.txt";
        $arrayProveedores=proveedor::LeerProveedoresJson($pathProveedores);
        foreach($arrayProveedores as $auxProveedor)
        {            
            if($auxProveedor->id==$proveedorActual->id)
            {
                $auxProveedor->nombre=$proveedorActual->nombre;
                $auxProveedor->email=$proveedorActual->email;
                $auxProveedor->foto=$proveedorActual->foto;
                echo "<br>se modifico el proveedor con el id: ".$proveedorActual->id;
            }
           array_push($newArrayProveedores,$auxProveedor);    //creo un nuevo array con el proveedor modificado
        }
        unlink($pathProveedores);//borro el archivo fisico

        foreach($newArrayProveedores as $auxProveedor)
        {
            $proveedor=new proveedor();
            $proveedor->miConstructor((array)$auxProveedor);
            $proveedor->GuardarProveedorJson($pathProveedores);//creamos un nuevo archivo con todos los elementos del "newArray"
        }
    }
    
    public static function obtenerDatoPorId($id,$dato){
        $path="./Archivos/proveedores.txt";
        $retorno=-1;
        foreach(proveedor::LeerProveedoresJson($path) as $proveedor)
        {
            if($proveedor->id==$id)
            {
                $retorno=$proveedor->$dato;
            }
        }
        return $retorno;
    }
}
?>