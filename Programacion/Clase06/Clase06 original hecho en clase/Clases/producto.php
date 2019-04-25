<?php
class producto{
    
    public function GuardarProducto($path)
    {
        if(file_exists($path))
        {
            $file = fopen($path,"a");
            fwrite($file,$this->id.";".$this->producto.";".$this->cantidad."\r\n");
        }
        else
        {
            $file = fopen($path,"w");
            fwrite($file,$this->id.";".$this->producto.";".$this->cantidad."\r\n");
        }   
        fclose($file);         
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
    
    public static function LeerProductos($path)
    {
        $file=fopen($path,"r");
        $arrayProductos=array();
        while(!feof($file)){
            $stringProducto=explode(";",fgets($file));
            if(feof($file))
            {
                break;
            }
            $id=$stringProducto[0];
            $producto=$stringProducto[1];
            $cantidad=$stringProducto[2];

            $params=array("id"=>$id,"producto"=>$producto,"cantidad"=>$cantidad);
            $auxProducto = new producto();    
            $auxProducto->miConstructor($params);

            echo "<br/>";
            
                array_push($arrayProductos,$auxProducto);
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