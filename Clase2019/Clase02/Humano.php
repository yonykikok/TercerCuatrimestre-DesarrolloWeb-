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
        $file;
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
    function MostrarAlumno()
    {
            echo "Nombre: ".$this->nombre."<br/>";
            echo "Apellido: ".$this->apellido."<br/>";
            echo "Edad: ".$this->edad."<br/>";
            echo "Legajo: ".$this->legajo."<br/><br/>";
    }
    function LeerAlumno($path)
    {
        $file=fopen($path,"r");
        $arrayAlumnos=array();
        while(!feof($file)){

            $stringAlumno=explode(";",fgets($file));
            if($stringAlumno=="")
            {
                break;
            }
            $auxAlumno = new Alumno($stringAlumno[0],$stringAlumno[1],$stringAlumno[2],$stringAlumno[3]);
           var_dump($auxAlumno);
           echo "<br/>";
            array_push($arrayAlumnos,$auxAlumno);
        }        
        fclose($file);
        return $arrayAlumnos;
    }
    function GuardarAlumnoJson($path)
    {
        $file;
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
}
?>