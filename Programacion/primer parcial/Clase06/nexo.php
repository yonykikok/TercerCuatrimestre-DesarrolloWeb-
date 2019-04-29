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
    else if($_POST["caso"]=="modificarProveedor")
    {
        require_once "./Funciones/modificarProveedor.php";
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
        require_once "./Funciones/getProveedores.php";
    }
    else if($_GET["caso"]=="listarPedidoProveedor")
    {
        require_once "./Funciones/listarPedidoProveedor.php";
    }
    else if($_GET["caso"]=="listarPedidos")
    {
        require_once "./Funciones/listarPedidos.php";
    }
    else if($_GET["caso"]=="fotosBack")
    {
        require_once "./Funciones/fotosBack.php";
    }
}
?>
