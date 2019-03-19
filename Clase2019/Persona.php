<?php
include "Humano.php";
class Persona extends Humano
{
    public $dni;

    public function __construct($nombre,$edad,$dni)
    {
        $this->dni=$dni;
    }
    function RetornarJson()
    {
        return json_decode($this);
    }
}
?>