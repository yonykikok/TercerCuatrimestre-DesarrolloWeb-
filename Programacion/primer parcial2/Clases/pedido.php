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

   
    
}
?>