<?php
include "Persona.php";
class Alumno extends Persona
{
    public $legajo;

    public function __construct($nombre,$apellido,$edad,$legajo)
    {
        $this->legajo=$legajo;
    }
    function RetornarJson()
    {
        return json_encode($this);
    }
}
?>