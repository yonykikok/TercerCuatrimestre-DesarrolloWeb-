<?php

include_once "./Clases/vehiculo.php";
include_once "./Clases/turno.php";
include_once "./Clases/pedido.php";
include_once "./Clases/dao.php";
$pathVehiculos="./Archivos/vehiculos.txt";
$pathTiposDeServicio="./Archivos/tiposServicio.txt";
$pathTurnos="./Archivos/turnos.txt";
if(isset($_GET['fecha']))
 {
     if(isset($_GET['patente']))
     {                       
        $fecha=$_GET['fecha'];
        $patente=$_GET['patente'];
        $tipoInput=$_GET['tipo'];   
        $pedido=new pedido();
        $vehiculo=new vehiculo();
        $turno=new turno();
        $arrayPedidos=dao::LeerObjetosPorDatosJson($pathTiposDeServicio,$tipoInput,$pedido);//hago una lista solo con los objetos que me importan
        $arrayVehiculos=dao::LeerObjetosPorDatosJson($pathVehiculos,$patente,$vehiculo);//hago una lista solo con los objetos que me importan
        $seCreoTurno=false;

         foreach($arrayVehiculos as $auxVeiculo)
         {
             if(strcasecmp($auxVeiculo->patente,$patente)==0)
             {
                 foreach($arrayPedidos as $auxPedido)
                 {
                    if(strcasecmp($auxPedido->tipo,$tipoInput)==0)
                    {    
                        $params=array("patente"=>$patente,"marca"=>$auxVeiculo->marca,"modelo"=>$auxVeiculo->modelo,"precio"=>$auxVeiculo->precio,"fecha"=>$fecha,"tipo"=>$tipoInput);
                        $turno->miConstructorGenerico($params);
                        $seCreoTurno=true;//aviso que se pudo crear el turno.
                        break;
                    }                    
                }
            }
         }
         if($seCreoTurno)
         {
             if(file_exists($pathTurnos))
             {
                $arrayTurnos=dao::LeerObjetosJson($pathTurnos,$turno);
                if(!dao::verificarExistenciaDelObjetoDobleCriterio($arrayTurnos,$patente,$tipoInput,'patente','tipo'))
                {
                    dao::GuardarObjetoJson($pathTurnos,$turno);
                    echo "Se Guardo El Turno";
                }
                else
                {
                    echo "El turno ya existe";
                }
            }
            else
            {
                dao::GuardarObjetoJson($pathTurnos,$turno);
                echo "Se Guardo El Turno";
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