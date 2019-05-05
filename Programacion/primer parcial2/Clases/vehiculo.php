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
    
    function miConstructorGenerico($params)
    {
        $keys = array_keys((array)$this);
        foreach($keys as $key)
        {
            if(array_key_exists($key,(array)$params))
            {
                $this->$key=$params[$key];
            }
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
            $claseDelObjeto->miConstructorGenerico((array)$auxObjeto);
            dao::GuardarObjetoJson($pathObjetoTxt,$claseDelObjeto);//creamos un nuevo archivo con todos los elementos del "newArray"
        }
    }
    
}
?>