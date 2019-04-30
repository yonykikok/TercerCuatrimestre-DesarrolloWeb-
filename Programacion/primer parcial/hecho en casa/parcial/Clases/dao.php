<?php

    class dao{

        public static function LeerObjetosJson($path,$clase)
        {
            $file=fopen($path,"r");
            $arrayListaObjetos=array();
            while(!feof($file)){            
                $objetoLeido=json_decode(fgets($file),true);             
                if(feof($file))
                {
                    break;
                }
                $objeto = new $clase();  
                $objeto->miConstructor($objetoLeido);
                array_push($arrayListaObjetos,$objeto);
            }        
            fclose($file);
            return $arrayListaObjetos;
        }
  
        public static function verificarExistenciaDelObjetoDobleCriterio($arrayObjetos,$datoABuscarUno,$datoABuscarDos,$campoDelObjetoUno,$campoDelObjetoDos)
        {
            $existeObjeto=false;
            foreach($arrayObjetos as $auxObjeto)
            {         
                if(strcasecmp($auxObjeto->$campoDelObjetoUno,$datoABuscarUno)==0 && strcasecmp($auxObjeto->$campoDelObjetoDos,$datoABuscarDos)==0)      
                {
                    $existeObjeto=true;
                    break;
                }
            }
                return $existeObjeto;
        }


        public static function verificarExistenciaDelObjeto($arrayObjetos,$datoABuscar,$campoDelObjeto)
        {
            $existeObjeto=false;
            foreach($arrayObjetos as $auxObjeto)
            {   
                if($auxObjeto->$campoDelObjeto==$datoABuscar)//id -> dato
                {
                    $existeObjeto=true;
                    break;
                }
            }
                return $existeObjeto;
        }

        public static function GuardarObjetoJson($path,$objetoAGuardar)
        {
            $retorno=false;
            if(file_exists($path))
            {            
              $file = fopen($path,"a");  
              fwrite($file,$objetoAGuardar->RetornarJson()."\r\n");
              $retorno=true;      
                
            }
            else
            {
                $file = fopen($path,"w");
                fwrite($file,$objetoAGuardar->RetornarJson()."\r\n");
                $retorno=true;
            }   
            fclose($file);  
            return $retorno;       
        }
        /**
         * Trae una lista de objetos filtrados por un dato en especifico comparando contra todos los campos del objeto(leidos de un archivo).   
         * @param string $path es la direccion donde esta el archivo a ser leido.
         * @param string $dato es el dato que se tiene que buscar.
         * @param object $clase del objeto es la clase del tipo de objeto que estamos trabajando Ejemplo: Alumno, Proveedor, Vehiculos etc.
         * @return array devuelve una lista de objetos 
         */
        public static function LeerObjetosPorDatosJson($path,$dato,$claseDelObjeto)
        {
            $arrayObjetos=array();        //lista de objetos filtrada
            $contadorDeCoincidencias=0;// contador de coincidencias encontradas.
            $keys = array_keys((array)$claseDelObjeto);//creo un array con todos las keys del objeto
            $auxObjeto = new $claseDelObjeto();    //insatancio un abjeto de esa clase
            if(isset($dato))
            {
                $arrayListaObjetos=dao::LeerObjetosJson($path,$auxObjeto);//leo todos los objetos antes de filtrar
                foreach($arrayListaObjetos as $objetoDeLista)
                {
                    $auxObjeto->miConstructor((array)$objetoDeLista);//
                    foreach($keys as $key)//recorro todos los campos del objeto para buscar coincidencias
                    {
                        if(strcasecmp ($auxObjeto->$key,$dato)==0)//si hay coincidencia.
                        {
                            array_push($arrayObjetos,$objetoDeLista);//agrego a la lista filtrada el objeto
                            $contadorDeCoincidencias++;
                        }
                    }
                }
                    
            }                
            if($contadorDeCoincidencias==0)
            {
                if(isset($dato))
                {
                    echo "No hay coincidencias con: ".$dato;
                }          
            }
            return $arrayObjetos;
            
        }
}
