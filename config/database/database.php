<?php

include 'rb.php';
//Conexion a la Base De Datos
try {
    $conexion = R::setup('mysql:host=localhost;dbname=db_project_management_system', 'root', '');
} catch (PDOException $e) {
    echo $e . "No me conecte";
}



    
