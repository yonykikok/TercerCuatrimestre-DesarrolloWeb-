<?php
include "Humano.php";
class Persona extends Humano
{
    public $edad;

    function __construct($Anombre,$Aapellido,$Aedad)
    {        
        parent::__construct($Anombre,$Aapellido);
        $this->edad=$Aedad;
    }
}
?>