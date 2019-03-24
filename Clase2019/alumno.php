<?php
include "Persona.php";
class Alumno extends Persona
{
    public $legajo;

    function __construct($Anombre,$Aapellido,$Aedad,$Alegajo)
    {
        parent::__construct($Anombre,$Aapellido,$Aedad);
        $this->legajo=$Alegajo;
     
    }
    
}
?>