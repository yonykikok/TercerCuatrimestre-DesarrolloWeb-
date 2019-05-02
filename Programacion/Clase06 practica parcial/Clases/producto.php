<?php
class producto{
    
    public $id;
    public $producto;
    public $cantidad;

    function RetornarJson()
    {
        return json_encode($this);
    }
    function GuardarProductoJson($path)
    {
        $retorno=false;
        if(file_exists($path))
        {            
            $file = fopen($path,"a"); 
            fwrite($file,$this->RetornarJson()."\r\n");
            $retorno=true;                   
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
    function miConstructor($params)
    {
        if(array_key_exists("id",(array)$params))
        {
            $this->id=$params['id'];
        }
        if(array_key_exists("producto",(array)$params))
        {
            $this->producto=$params['producto'];
        }
        
        if(array_key_exists("cantidad",(array)$params))
        {
            $this->cantidad=$params['cantidad'];
        }
    }
    public function MostrarProducto()
    {
            echo "Id: ".$this->id."<br/>";
            echo "Producto: ".$this->producto."<br/>";
            echo "Cantidad: ".$this->cantidad."<br/>";
    }
    public static function LeerProductosJson($path)
    {
        $file=fopen($path,"r");
        $arrayProductos=array();
        while(!feof($file)){            
            $productoLeido=json_decode(fgets($file),true);             
            if(feof($file))
            {
                break;
            }
            $producto = new producto();  
            $producto->miConstructor($productoLeido);
            array_push($arrayProductos,$producto);
        }        
        fclose($file);
        return $arrayProductos;
    }

    public static function verificarExistenciaDelProducto($arrayProductos,$id)
    {
        $existeIdProducto=false;
        foreach($arrayProductos as $auxProducto)
        {   
            if($auxProducto->id==$id)
            {
                $existeIdProducto=true;
                break;
            }
        }
            return $existeIdProducto;
    }
    
}
?>