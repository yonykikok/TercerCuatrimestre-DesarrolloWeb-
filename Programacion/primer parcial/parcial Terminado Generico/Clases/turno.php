<?php
class turno{
    
    public $fecha;
    public $patente;
    public $marca;
    public $precio;
    public $modelo;
    public $tipo;

    function RetornarJson()
    {
        return json_encode($this);
    }
    function GuardarTurnoJson($path)
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
        if(array_key_exists("fecha",(array)$params))
        {
            $this->fecha=$params['fecha'];
        }
        if(array_key_exists("patente",(array)$params))
        {
            $this->patente=$params['patente'];
        }        
        if(array_key_exists("marca",(array)$params))
        {
            $this->marca=$params['marca'];
        }
        if(array_key_exists("precio",(array)$params))
        {
            $this->precio=$params['precio'];
        }
        if(array_key_exists("modelo",(array)$params))
        {
            $this->modelo=$params['modelo'];
        }
        if(array_key_exists("tipo",(array)$params))
        {
            $this->tipo=$params['tipo'];
        }
    }
    public function MostrarTurno()
    {    
        echo "fecha: ".$this->fecha."<br/>";
        echo "patente: ".$this->patente."<br/>";
        echo "marca: ".$this->marca."<br/>";
        echo "modelo: ".$this->modelo."<br/>";
        echo "precio: ".$this->precio."<br/>";
        echo "tipoDeServicio: ".$this->tipo."<br/>";
    }
    public static function LeerTurnosJson($path)
    {
        $file=fopen($path,"r");
        $arrayTurnos=array();
        while(!feof($file)){            
            $turnoLeido=json_decode(fgets($file),true);             
            if(feof($file))
            {
                break;
            }
            $turno = new turno();  
            $turno->miConstructor($turnoLeido);
            array_push($arrayTurnos,$turno);
        }        
        fclose($file);
        return $arrayTurnos;
    }

    public static function verificarExistenciaDelPedido($arrayTurnos,$patente)
    {
        $existeIdTurno=false;
        foreach($arrayTurnos as $auxPedido)
        {   
            if($auxPedido->patente==$patente)
            {
                $existeIdTurno=true;
                break;
            }
        }
            return $existeIdTurno;
    }
    public static function LeerTurnosPorDatoParametroJson($path,$dato)
    {
        $arrayVehiculos=array();        
        $contadorDeCoincidencias=0;
        foreach(turno::LeerTurnosJson($path) as $auxAlumno)
        {
            $auxVehiculo = new turno();    
            $auxVehiculo->miConstructor((array)$auxAlumno);
            if(isset($dato))
            {
                if(strcasecmp ($auxVehiculo->patente,$dato)==0)
                {
                    array_push($arrayVehiculos,$auxVehiculo);
                    $contadorDeCoincidencias++;
                }
                else if(strcasecmp ($auxVehiculo->marca,$dato)==0)
                {
                    array_push($arrayVehiculos,$auxVehiculo);
                    $contadorDeCoincidencias++;
                }               
                else if(strcasecmp ($auxVehiculo->modelo,$dato)==0)
                {
                    array_push($arrayVehiculos,$auxVehiculo);
                    $contadorDeCoincidencias++;
                }
                              
                else if(strcasecmp ($auxVehiculo->fecha,$dato)==0)
                {
                    array_push($arrayVehiculos,$auxVehiculo);
                    $contadorDeCoincidencias++;
                }
                              
                else if(strcasecmp ($auxVehiculo->tipo,$dato)==0)
                {
                    array_push($arrayVehiculos,$auxVehiculo);
                    $contadorDeCoincidencias++;
                }
            }
                
        }                
        if($contadorDeCoincidencias==0)
        {
            if(isset($dato))
            {
                echo "No hay coincidencias con: ".$dato;
            }          
        }
        return $arrayVehiculos;
        
    }
}
?>