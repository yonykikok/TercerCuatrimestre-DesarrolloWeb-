<?php
class vehiculo{

    public $patente;
    public $marca;
    public $modelo;
    public $precio;
    
    function RetornarJson()
    {
        return json_encode($this);
    }

    function GuardarVehiculoJson($path)
    {
        $retorno=false;
        if(file_exists($path))
        {            
          $file = fopen($path,"a");
          $listaVehiculos=vehiculo::LeerVehiculosJson($path);
         
            if(!vehiculo::verificarExistenciaDelVehiculo($listaVehiculos,$this->patente))
            {
                fwrite($file,$this->RetornarJson()."\r\n");
                $retorno=true;
            }
            else
            {                
                echo "el vehiculo con la patente: ".$_POST['patente']." ya existe";
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
        if(array_key_exists("patente",(array)$params))
        {
            $this->patente=$params['patente'];
        }
        if(array_key_exists("marca",(array)$params))
        {
            $this->marca=$params['marca'];
        }
        
        if(array_key_exists("modelo",(array)$params))
        {
            $this->modelo=$params['modelo'];
        }
        if(array_key_exists("precio",(array)$params))
        {
            $this->precio=$params['precio'];
        }
    }
    public function MostrarVehiculo()
    {
            echo "Patente: ".$this->patente."<br/>";
            echo "Marca: ".$this->marca."<br/>";
            echo "Modelo: ".$this->modelo."<br/>";
            echo "Precio: ".$this->precio."<br/><br/>";
    }
    public static function LeervehiculosPorCriterioJson($path)
    {
        $arrayVehiculos=array();        
        $contadorDeCoincidencias=0;
        foreach(vehiculo::LeerVehiculosJson($path) as $auxVehiculo)
        {
            $auxVehiculo = new vehiculo();    
            $auxVehiculo->miConstructor((array)$auxVehiculo);
            if(strcasecmp ($auxVehiculo->marca,$_GET["marca"])==0 )
            {
                array_push($arrayVehiculos,$auxVehiculo);
                $contadorDeCoincidencias++;
            }
        }                
        if($contadorDeCoincidencias==0)
        {
            echo "No hay coincidencias";
        }
        return $arrayVehiculos;
        
    }
    public static function LeervehiculosPorDatoJson($path)
    {
        $arrayVehiculos=array();        
        $contadorDeCoincidencias=0;
        foreach(vehiculo::LeerVehiculosJson($path) as $auxAlumno)
        {
            $auxVehiculo = new vehiculo();    
            $auxVehiculo->miConstructor((array)$auxAlumno);
            if(isset($_GET['dato']))
            {
                if(strcasecmp ($auxVehiculo->patente,$_GET["dato"])==0)
                {
                    array_push($arrayVehiculos,$auxVehiculo);
                    $contadorDeCoincidencias++;
                }
                else if(strcasecmp ($auxVehiculo->marca,$_GET["dato"])==0)
                {
                    array_push($arrayVehiculos,$auxVehiculo);
                    $contadorDeCoincidencias++;
                }               
                else if(strcasecmp ($auxVehiculo->modelo,$_GET["dato"])==0)
                {
                    array_push($arrayVehiculos,$auxVehiculo);
                    $contadorDeCoincidencias++;
                }
            }
                
        }                
        if($contadorDeCoincidencias==0)
        {
            if(isset($_GET['dato']))
            {
                echo "No hay coincidencias con: ".$_GET["dato"];
            }          
        }
        return $arrayVehiculos;
        
    }
    public static function LeerVehiculosJson($path)
    {
        $file=fopen($path,"r");
        $arrayVehiculos=array();
        while(!feof($file)){            
            $vehiculoLeido=json_decode(fgets($file),true);             
            if(feof($file))
            {
                break;
            }
            $vehiculo = new vehiculo();  
            $vehiculo->miConstructor($vehiculoLeido);
            array_push($arrayVehiculos,$vehiculo);
        }        
        fclose($file);
        return $arrayVehiculos;
    }
    public static function verificarExistenciaDelVehiculo($arrayVehiculos,$patente)
    {
        $existeIdVehiculo=false;
        foreach($arrayVehiculos as $auxVehiculo)
        {   
            if($auxVehiculo->patente==$patente)
            {
                $existeIdVehiculo=true;
                break;
            }
        }
            return $existeIdVehiculo;
    }
    


    public static function LeervehiculosPorDatoParametroJson($path,$dato)
    {
        $arrayVehiculos=array();        
        $contadorDeCoincidencias=0;
        foreach(vehiculo::LeerVehiculosJson($path) as $auxAlumno)
        {
            $auxVehiculo = new vehiculo();    
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