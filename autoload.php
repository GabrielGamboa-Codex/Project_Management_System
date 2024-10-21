<?php

//Obtiene el nombre de la Clase
spl_autoload_register(function($class){
    // se guarda la ruta de la clase
    //Obtiene el directorio actual del archivo que se esta ejecutando con el DIR
    $archive=__DIR__."/".$class.".php";
    //evitar problemas con servidores linux
    $archive=str_replace("\\", "/", $archive);
    //si el arhivo existe o no
    if(is_file($archive))
    {
            require_once $archive;
    }
});


?>