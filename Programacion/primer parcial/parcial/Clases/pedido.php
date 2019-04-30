<?php
class pedido{
    
    public $id;
    public $nombre;
    public $tipo;
    public $precio;
    public $demora;

    function RetornarJson()
    {
        return json_encode($this);
    }
    function GuardarPedidoJson($path)
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
        if(array_key_exists("nombre",(array)$params))
        {
            $this->nombre=$params['nombre'];
        }        
        if(array_key_exists("tipo",(array)$params))
        {
            $this->tipo=$params['tipo'];
        }
        if(array_key_exists("precio",(array)$params))
        {
            $this->precio=$params['precio'];
        }
        if(array_key_exists("demora",(array)$params))
        {
            $this->demora=$params['demora'];
        }
    }
    public function MostrarPedido()
    {
            echo "Id: ".$this->id."<br/>";
            echo "nombre: ".$this->nombre."<br/>";
            echo "tipo: ".$this->tipo."<br/>";
            echo "precio: ".$this->precio."<br/>";
            echo "demora: ".$this->demora."<br/>";
    }
    public static function LeerPedidosJson($path)
    {
        $file=fopen($path,"r");
        $arrayPedidos=array();
        while(!feof($file)){            
            $pedidoLeido=json_decode(fgets($file),true);             
            if(feof($file))
            {
                break;
            }
            $pedido = new pedido();  
            $pedido->miConstructor($pedidoLeido);
            array_push($arrayPedidos,$pedido);
        }        
        fclose($file);
        return $arrayPedidos;
    }

    public static function verificarExistenciaDelPedido($arrayPedidos,$id)
    {
        $existeIdPedido=false;
        foreach($arrayPedidos as $auxPedido)
        {   
            if($auxPedido->id==$id)
            {
                $existeIdPedido=true;
                break;
            }
        }
            return $existeIdPedido;
    }
    
}
?>