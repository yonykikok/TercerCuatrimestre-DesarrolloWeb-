<?php
ini_set('max_input_vars', 3000);
$dato = $_SERVER['REQUEST_METHOD'];
if($dato=="POST")
{
    if($_POST["caso"]=="PizzaCarga")
    {
        require_once "./Funciones/PizzaCarga.php";
    }
    else if($_POST["caso"]=="AltaVenta")
    {
        require_once "./Funciones/AltaVenta.php";
    }
    
}
else if($dato=="GET")
{
    if($_GET["caso"]=="PizzaConsultar")
    {
        require_once "./Funciones/PizzaConsultar.php";
    }
    else if($_GET["caso"]=="ListadoDeImagenes")
    {
        require_once "./Funciones/ListadoDeImagenes.php";
    }
    else if($_GET["caso"]=="ListadoDePizza")
    {
        require_once "./Funciones/ListadoDePizza.php";
    }
}
else if($dato=="DELETE")
{
    if(["caso"]=="BorrarItem")
    {
        require_once "./Funciones/BorrarItem.php";
    }
   
}
?>
