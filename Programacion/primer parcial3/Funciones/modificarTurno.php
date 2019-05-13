<?php
    include_once "./Clases/dao.php";
    include_once "./Clases/turno.php";
    $path="./Archivos/turnos.txt";    
    if(isset($_POST['patente']))
    {              //verificamos que exista el proveedor en el archivo, de lo contrario no se puede modificar
        $turno=new turno();

        if(dao::verificarExistenciaDelObjeto(dao::LeerObjetosJson($path,$turno),$_POST['patente'],'patente'))
        {  
            if(isset($_POST['marca']))
            {
                if(isset($_POST['modelo']))
                {
                    if(isset($_POST['precio']))
                    {
                        if(isset($_POST['fecha']))
                        {
                            if(isset($_POST['tipo']))
                            {
                                $patente=$_POST['patente'];
                                $marca=$_POST['marca'];
                                $modelo=$_POST['modelo'];
                                $precio=$_POST['precio'];
                                $fecha=$_POST['fecha'];
                                $tipo=$_POST['tipo'];

                                $params=array("patente"=>$patente,"marca"=>$marca,"modelo"=>$modelo,"precio"=>$precio,"fecha"=>$fecha,"tipo"=>$tipo);

                                $turnoActual=new turno();
                                $turnoActual->miConstructorGenerico($params);
                                turno::Modificar($path,$turnoActual,'patente',$turno);
                            }
                            else
                            {
                                echo "falta el campo tipo en POST";
                            } 
                        }
                        else
                        {
                            echo "falta el campo fecha en POST";
                        }
                    }
                    else
                    {
                        echo "falta el campo precio en POST";
                    }
                }
                else
                {
                    echo "falta el campo modelo en POST";
                }
            }
            else
            {
                echo "falta el campo marca en POST";
            }
            
        }
        else
        {
            echo "la patente no existe en la lisa de vehiculos";
        }
    }
    else
    {
        echo "falta el campo patente en POST";
    }
