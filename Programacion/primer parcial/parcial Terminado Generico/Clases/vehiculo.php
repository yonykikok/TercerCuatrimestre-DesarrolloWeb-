<?php
class vehiculo{

    public $patente;
    public $marca;
    public $modelo;
    public $precio;
    public $foto;
    
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
        if(array_key_exists("foto",(array)$params))
        {
            $this->foto=$params['foto'];
        }
    }
    /**
     * muestro el objeto por pantalla
     */
    public function MostrarObjeto()
    {
            $keys = array_keys((array)$this);//creo un array con todos las keys del objeto
            foreach($keys as $key)
            {
                echo ucwords($key).": ".$this->$key."<br/>";//propiedad "clave : valor" ucwords lo usamos para poner mayuscula la primera Letra de cada "clave"
            }
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
    /**
     * Modifica el objeto de una lista, que se encuantra dentro de un archivo, lo busca por un campo en especifico y modifica sus campos si lo encuentra
     * @param string $pathObjetoTxt direccion de donde se encuentra el archivo.
     * @param string $strCampoABuscar es el campo del objeto que se va a buscar y comparar contra el objetoActual(que contiene los datos actualizados)
     * @param object $objetoActual es el objeto que le pasamos con los campos actualizados.
     * @param string $claseDelObjeto instancia del objeto que vamos a trabajar(empleado,persona,vehiculo,etc).
     */
    public static function Modificar($pathObjetoTxt,$objetoActual,$strCampoABuscar,$claseDelObjeto)
    {
        $newArrayObjetos=array();
        $keys = array_keys((array)$claseDelObjeto);//creo un array con todos las keys del objeto

        //$vehiculo=new $claseDelObjeto();
        $arrayObjetos=dao::LeerObjetosJson($pathObjetoTxt,$claseDelObjeto);
        foreach($arrayObjetos as $auxObjeto)
        {            
            if(strcasecmp($auxObjeto->$strCampoABuscar,$objetoActual->$strCampoABuscar)==0)
            {
                foreach($keys as $key)
                {
                    $auxObjeto->$key=$objetoActual->$key;
                }
                echo "<br>se modifico el ". get_class($claseDelObjeto) ." con el campo '".$strCampoABuscar."' : ".$objetoActual->$strCampoABuscar;
            }
           array_push($newArrayObjetos,$auxObjeto);    //creo un nuevo array con el proveedor modificado
        }
        unlink($pathObjetoTxt);//borro el archivo fisico

        foreach($newArrayObjetos as $auxObjeto)
        {
            //$vehiculo=new $claseDelObjeto();
            $claseDelObjeto->miConstructor((array)$auxObjeto);
            dao::GuardarObjetoJson($pathObjetoTxt,$claseDelObjeto);//creamos un nuevo archivo con todos los elementos del "newArray"
        }
    }
    
}
?>