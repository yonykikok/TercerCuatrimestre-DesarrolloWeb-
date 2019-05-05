<?php
ini_set('max_input_vars', 3000);
$dato = $_SERVER['REQUEST_METHOD'];
if($dato=="POST")
{
    if($_POST["caso"]=="cargarVehiculo")
    {
        require_once "./Funciones/cargarVehiculo.php";
    }
    else if($_POST["caso"]=="cargarTipoServicio")
    {
        require_once "./Funciones/cargarTipoServicio.php";
    }
    else if($_POST["caso"]=="modificarVehiculo")
    {
        require_once "./Funciones/modificarVehiculo.php";   
    }
    else if($_POST["caso"]=="modificarTurno")
    {
        require_once "./Funciones/modificarTurno.php";   
    }
    
}
else if($dato=="GET")
{
    if($_GET["caso"]=="consultarVehiculo")
    {
        require_once "./Funciones/consultarVehiculo.php";
    }
    else if($_GET["caso"]=="sacarTurno")
    {
        require_once "./Funciones/sacarTurno.php";
    }
    else if($_GET["caso"]=="turnos")
    {
        require_once "./Funciones/turnos.php";
    }    
    else if($_GET["caso"]=="inscripciones")
    {
        require_once "./Funciones/inscripciones.php";
    }   
    else if($_GET["caso"]=="vehiculos")
    {
        require_once "./Funciones/vehiculos.php";
    }
    else if($_GET["caso"]=="hola")
    {
    include_once "./Funciones/vehiculos.php";
        $vehiculo= new vehiculo();
        
        $params=array("patente"=>"SASD542","marca"=>"SAMSUNG","modelo"=>"2015","precio"=>"154000","foto"=>"hoosad.png");
        $vehiculo->miConstructorGenerico($params);

        $vehiculo->MostrarObjeto();
    }
}
?>
