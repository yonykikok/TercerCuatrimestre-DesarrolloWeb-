<?php
include "Humano.php";
class Persona extends Humano
{
    public $edad;

    function __construct($params)
    {             
        if (is_array($params) && array_key_exists('edad',$params))
        {
            $this->edad=$params['edad'];
        }
        parent::__construct($params);
    }
}
?>