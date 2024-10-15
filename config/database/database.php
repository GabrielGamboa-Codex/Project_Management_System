<?php

include 'rb.php';
//Conexion a la Base De Datos
try {
    $conexion = R::setup('mysql:host=localhost;dbname=db_project_management_system', 'root', '');
    echo "Me Conecte Becerro";
} catch (PDOException $e) {
    echo $e . "No me conecte";
}

// Crear o actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $team = $_POST['team'];
    $date = date('Y-m-d H:i:s');


    if ($id) {
        $bean = R::load('users', $id);
    } else {
        $bean = R::dispense('users');
    }


    if (isset($id)) {

        if (isset($bean->created_at)) {
            //Actualizar
            $bean->username = $nombre;
            $bean->email = $estatus;
            $bean->password= $descripcion;
            $beam->team_id= $team;
            $bean->updated_at = $date;
        } else {
            //Crear
            $bean->username = $name;
            $bean->email = $email;
            $bean->password= $pass;
            $bean->team_id= $team;
            $bean->updated_at = $date;
            $bean->created_at = $date;
        }


        R::store($bean);
    }

}