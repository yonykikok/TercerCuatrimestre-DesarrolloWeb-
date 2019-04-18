<?php

class Humano
{
    public $nombre;
    public $apellido;
    public $id;
    /*
    function __construct($params)
    {
        if(array_key_exists("nombre",(array)$params))
        {
            $this->nombre=$params['nombre'];
        }
        if(array_key_exists("apellido",(array)$params))
        {
            $this->apellido=$params['apellido'];
        }
    }
    */
    function RetornarJson()
    {
        return json_encode($this);
    }

    public function GuardarAlumno($path)
    {
        if(file_exists($path))
        {
           $file = fopen($path,"a");
           fwrite($file,$this->nombre."=>".$this->apellido."=>".$this->edad."=>".$this->legajo."\r\n");
        }
        else
        {
            $file = fopen($path,"w");
            fwrite($file,$this->nombre."=>".$this->apellido."=>".$this->edad."=>".$this->legajo."\r\n");
        }   
        fclose($file);         
    }
    /**
     * Verifica Si El Alumno esta en la lista del array pasado como parametro
     * 
     * se utiliza para verificar la existencia de un alumno en el array 
     * @access public
     * @param string $listaAlumnos el array de alumnos a revisar
     * @return bool true si el alumno ya se encuentra en el array, false si no esta ese alumno
     */
    public static function VerificarExistenciaDeAlumno($listaAlumnos,$thisAlumno)
    {
        $bandera=false;
        foreach($listaAlumnos as &$auxAlumnoLeido)
        {
          if($auxAlumnoLeido->legajo == $thisAlumno->legajo)
            {   
                //var_dump($thisAlumno->RetornarJson());
                $bandera=true;
                break;
            }    
        }
        return $bandera;
    }
    /**
     * Guarda el alumno en un archivo Json 
     * se usa para guardar un alumno en un archivo, si existe verifica que no este agregado y lo agrega, sino lo crea.
     * @access public
     * @param string $path es la direccion de donde se va a dejar el archivo
     * @return bool true si se pudo agregar, false si no.
     */
    function GuardarAlumnoJson($path)
    {
        $retorno=false;
        if(file_exists($path))
        {            
          $file = fopen($path,"a");
          $listaAlumnos=Alumno::LeerAlumnosJson($path);
         
            if(!Alumno::VerificarExistenciaDeAlumno($listaAlumnos,$this))
            {
                //echo "alumno agregado con exito\r\n";
                fwrite($file,$this->RetornarJson()."\r\n");
                $retorno=true;
            }
            else
            {
                echo "El alumno ya esta en la lista\r\n";
            }            
        }
        else
        {
            $file = fopen($path,"w");
            fwrite($file,$this->RetornarJson()."\r\n");
            echo "alumno agregado con exito\r\n";
            $retorno=true;
        }   
        fclose($file);  
        return $retorno;       
    }
    static function insertarHeaderDeTabla(){
       
        $retornoHeader="<table border='2px'>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Legajo</th>
            <th>Imagen</th>
        </tr>";
        return $retornoHeader;
    }
    static function insertarPieDeTabla(){
        $retornoPie="</table>";
        return $retornoPie;
    }
    
    function obtenerFilaAlumno()
    {
            $retornoFila="<tr>
            <td>".$this->nombre."</td>
            <td>".$this->apellido."</td>
            <td>".$this->edad."</td>
            <td>".$this->legajo."</td> 
            <td><img src='".$this->imagen."' alt='foto_alumno' height=50 width=50 border=2>"."</td>
            </tr>";            
            return $retornoFila;
    }
    function MostrarAlumnos()
    {
            echo "<br/>Nombre: ".$this->nombre."<br/>";
            echo "Apellido: ".$this->apellido."<br/>";
            echo "Edad: ".$this->edad."<br/>";
            echo "Legajo: ".$this->legajo."<br/>";
            echo "Imagen: ".$this->imagen."<br/>";
    }
     public static function LeerAlumnos($path)
    {
        $file=fopen($path,"r");
        $arrayAlumnos=array();
        while(!feof($file)){
            $stringAlumno=explode(";",fgets($file));
            if(feof($file))
            {
                break;
            }
            $auxAlumno = new Alumno($stringAlumno[0],$stringAlumno[1],$stringAlumno[2],$stringAlumno[3]);        
            echo "<br/>";
            array_push($arrayAlumnos,$auxAlumno);
        }        
        fclose($file);
        return $arrayAlumnos;
    }
    public static function LeerAlumnosJson($path)
    {
        $file=fopen($path,"r");
        $arrayAlumnos=array();
        while(!feof($file)){            
            $alumnoLeido=json_decode(fgets($file),true);             
            if(feof($file))
            {
                break;
            }
            $auxAlumno = new Alumno($alumnoLeido);  
            array_push($arrayAlumnos,$auxAlumno);
        }        
        fclose($file);
        return $arrayAlumnos;
    }
    
    /**
     * Crea una imagen con Marca de agua
     * 
     * esta funcion se usa para poner una imagen como marca de agua como sello de propiedad.
     * @access public
     * @param string $path es la direccion donde se encuentra la imagen original a la cual se le pondra el logo
     * @param string $pathLogo es la direccion donde se encuentra el logo que se le pondra arriba de la imagen original
     * @param string $pathNewImg es donde se guardara la imagen final con el sello de agua.
     */
    public static function CrearImgConMarca($path,$pathLogo,$pathNewImg)
    {
        $marca = imagecreatefrompng($pathLogo);//creamos el sello
        $img = imagecreatefromjpeg($path);//creamos la imagen

        $right =10;
        $bottom = 10;
        $jx = imagesx($marca);
        $jy = imagesY($marca);

        imagecopy($img, $marca, imagesx($img) - $jx - $right, imagesy($img) - $jy - $bottom, 0, 0, imagesx($marca), imagesy($marca));


        move_uploaded_file($path,$pathNewImg);
        imagepng($img, $pathNewImg);//guarda la imagen que creamos con el sello de agua en el pathNewImg
    }
    /**
     * cambia el nombre de la imagen 
     * 
     * esta funcion se usa poner el nombre y legajo del alumno, como nombre de la imagen propia.
     * @access public
     * @param string $nameImg nombre de la imagen
     * @return string nombre de la imagen actual ejemplo: "jonathan1025.jpeg"
     */
    public static function changeImgName($nameImg)
    {
        $arrayNameImg=explode('.',$nameImg);//creo un array y separo
        $arrayNameImg[0]=$_POST['Nombre'].$_POST['Legajo'];
        $nameImg=$arrayNameImg[0].".".$arrayNameImg[1];
        return $nameImg;
    }
    /**
     * agrega la fecha y hora actual al nombre de la imagen
     * 
     * esta funcion se usa para agregar fecha y hora a la imagen.
     * @access public
     * @param string $nameimg nombre de la imagen
     * @return string nombre de la imagen actual Ejemplo:"Jonathan1025-2019-4-3-24-59-00.jpeg"
     */
    public static function AddDateTimeImg($nameImg)
    {
        $arrayNameImg=explode('.',$nameImg);//creo un array y separo
        $auxNewName=$arrayNameImg[0].date("-Y-m-d").date("-h-i-sa").".".$arrayNameImg[1];//creo el nuevo nombre de la imagen agregando fecha y hora     
        return $auxNewName;
    }


    
}
?>