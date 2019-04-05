<?php
include "Persona.php";
class Alumno extends Persona
{
    public $legajo;
    public $imagen;

    function __construct($params)
    {       
        if(array_key_exists("legajo",(array)$params))
        {
            $this->legajo=$params['legajo'];
        }
        if(array_key_exists("imagen",(array)$params))
        {
            $this->imagen=$params['imagen'];
        }        
        parent::__construct($params);
    }
    
}
?>