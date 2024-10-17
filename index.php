<?php
include "controller/controller.database.php";
include "config/database/rb.php";
//FRONTCONTROLLER ;
//Si no hay ningun controllador devolver al controlador de la vistas
//Sirve para manejar el envio de informacion del controlador por la URL
if(!isset($_GET['c'])){
    require_once "controller/start.controller.php";
    $controller = new StartController();
    //Me va a llamar a el metodo de un objeto que yo le indique y luego su metodo
    call_user_func(array($controller,"Start"));
}
else{
     
    $controller = $_GET['c'];
    require_once "controller/$controller.controller.php";
    //ucwords pasa el primer caracter de la variable a Mayusculas
    $controller = ucwords($controller)."Controller"; 
    //hago instancia del controlador
    $controller = new $controller;
    //cargue una visa de inicio
    $action = isset($_GET['a']) ? $_GET['a'] : "Start";
    call_user_func(array($controller,$action));
}

?> 