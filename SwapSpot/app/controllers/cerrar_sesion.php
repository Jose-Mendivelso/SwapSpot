<?php

    session_start(); //Se asegura que la sesion este activa
    session_destroy(); //Destruye la sesion actual y la informacion guardada en variables de sesion
    header("location: ../../public/index.php");//
    exit(); //Detiene la ejecucion del codigo
    
?>