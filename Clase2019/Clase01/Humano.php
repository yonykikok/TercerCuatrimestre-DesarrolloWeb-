<?php

class Humano
{
    public $nombre;
    public $apellido;
    
    function __construct($Anombre,$Aapellido)
    {
        $this->nombre=$Anombre;
        $this->apellido=$Aapellido;
    }
    
    function RetornarJson()
    {
        return json_encode($this);
    }
}
?>