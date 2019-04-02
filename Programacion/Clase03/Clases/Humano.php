<?php

class Humano
{
    public $nombre;
    public $apellido;
    
    function __construct($Anombre,$Aapellido)
    {
        $this->nombre=$Anombre;
        $this->apellido=$Aapellido;
    }
    
    function RetornarJson()
    {
        return json_encode($this);
    }

    public function GuardarAlumno($path)
    {
        if(file_exists($path))
        {
           $file = fopen($path,"a");
           fwrite($file,$this->nombre.";".$this->apellido.";".$this->edad.";".$this->legajo."\r\n");
        }
        else
        {
            $file = fopen($path,"w");
            fwrite($file,$this->nombre.";".$this->apellido.";".$this->edad.";".$this->legajo."\r\n");
        }   
        fclose($file);         
    }
    function GuardarAlumnoJson($path)
    {
        if(file_exists($path))
        {
           $file = fopen($path,"a");
           fwrite($file,$this->RetornarJson()."\r\n");
        }
        else
        {
            $file = fopen($path,"w");
            fwrite($file,$this->RetornarJson()."\r\n");
        }   
        fclose($file);         
    }
    function MostrarAlumno()
    {
            echo "Nombre: ".$this->nombre."<br/>";
            echo "Apellido: ".$this->apellido."<br/>";
            echo "Edad: ".$this->edad."<br/>";
            echo "Legajo: ".$this->legajo."<br/><br/>";
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
            $alumnoLeido=json_decode(fgets($file));      
            if(feof($file))
            {
                break;
            }
            $auxAlumno = new Alumno($alumnoLeido->nombre,$alumnoLeido->apellido,$alumnoLeido->edad,$alumnoLeido->legajo);       
            
            echo "<br/>";
            array_push($arrayAlumnos,$auxAlumno);
        }        
        fclose($file);
        return $arrayAlumnos;
    }
    
    public static function CrearImgConMarca($path,$pathLogo,$pathNewImg)
    {
        $marca = imagecreatefrompng($pathLogo);//creamos el sello
        $img = imagecreatefromjpeg($path);//creamos la imagen

        $right =10;//posiscion en px
        $bottom = 10;
        $jx = imagesx($marca);
        $jy = imagesY($marca);

        imagecopy($img, $marca, imagesx($img) - $jx - $right, imagesy($img) - $jy - $bottom, 0, 0, imagesx($marca), imagesy($marca));


        move_uploaded_file($path,$pathNewImg);
        imagepng($img, $pathNewImg);//guarda la imagen que creamos con el sello de agua en el pathNewImg
    }
}
?>