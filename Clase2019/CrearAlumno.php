<?php

    include "alumno.php";
    var_dump($_POST);   
     $nombre=$_POST['Nombre'];
     $apellido=$_POST['Apellido'];
     $edad=$_POST['Edad'];
     $legajo=$_POST['Legajo'];

     echo "</br>ALUMNO";
     $alumno = new Alumno($nombre,$apellido,$edad,$legajo);
     echo $alumno->RetornarJson();

?>