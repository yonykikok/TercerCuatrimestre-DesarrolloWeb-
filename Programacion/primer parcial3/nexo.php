<?php
ini_set('max_input_vars', 3000);
$dato = $_SERVER['REQUEST_METHOD'];
if($dato=="POST")
{
    if($_POST["caso"]=="cargarProveedor")
    {
        require_once "./Funciones/cargarProveedor.php";
    }
    else if($_POST["caso"]=="hacerPedido")
    {
        require_once "./Funciones/hacerPedido.php";
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
    if($_GET["caso"]=="consultarProveedor")
    {
        require_once "./Funciones/consultarProveedor.php";
    }
    else if($_GET["caso"]=="proveedores")
    {
        require_once "./Funciones/proveedores.php";
    }
    else if($_GET["caso"]=="listarPedidos")
    {
        require_once "./Funciones/listarPedidos.php";
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
        
        $params=array("marca"=>"samsung","marca"=>"SAMSUNG","modelo"=>"2015","precio"=>"154000","foto"=>"hoosad.png");
        $vehiculo->miConstructorGenerico($params);

       // $vehiculo->MostrarObjeto();
    }
}
?>
