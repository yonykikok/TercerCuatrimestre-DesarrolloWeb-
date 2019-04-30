<?php

include_once "./Clases/vehiculo.php";
include_once "./Clases/turno.php";
include_once "./Clases/pedido.php";
$path="./Archivos/vehiculos.txt";
$pathTipos="./Archivos/tiposServicio.txt";
$pathTurnos="./Archivos/turnos.txt";
if(isset($_GET['fecha']))
 {
     if(isset($_GET['patente']))
     {                       
         $fecha=$_GET['fecha'];
         $patente=$_GET['patente'];
         $tipoInput=$_GET['tipo'];
         $arrayVehiculos=vehiculo::LeervehiculosPorDatoParametroJson($path,$patente);
         $arrayPedidos=pedido::LeerPedidosJson($pathTipos);

        foreach($arrayVehiculos as $auxVehiculo)
        {
            if($auxVehiculo->patente==$patente)
            {
                $marca=$auxVehiculo->marca;
                $precio=$auxVehiculo->precio;
                $modelo=$auxVehiculo->modelo;
                foreach($arrayPedidos as $auxPedido)
                {
                    if($auxPedido->tipo==$tipoInput)
                    {
                        $params=array("fecha"=>$fecha,"patente"=>$patente,"marca"=>$marca,"modelo"=>$modelo,"precio"=>$precio,"tipo"=>$tipoInput);
                        $turno = new turno();   
                        $turno->miConstructor($params);
                        $path="./Archivos/turnos.txt"; 
                        $turno->GuardarTurnoJson($path); 
                    }
                }         
                
                echo "Turno guardado.";                
            }
              
        }
          
     }
     else
     {
         echo "falta el campo patente en POST";
     }
 }
 else
 {
     echo "falta el campo fecha en POST";
 }
?>