<?php

include 'rb.php';
//Conexion a la Base De Datos
try {
    $conexion = R::setup('mysql:host=localhost;dbname=db_project_management_system', 'root', '');
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
            $bean->username = $name;
            $bean->email = $email;
            $bean->password= $pass;
            $bean->team_id= $team;
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

// Leer y actualizar LA PAGINA y buscar los datos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $resultados = R::find('users');
            foreach ($resultados as $resultado) {
                //trae el id de la fila a buscar
                echo '<tr id="fila-' . $resultado->id . '">';
                echo '<td>' . $resultado->id . '</td>';
                //las clases para encontrar las filas
                echo '<td>' . $resultado->username . '</td>';
                echo '<td>' . $resultado->email . '</td>';
                echo '<td>' . $resultado->team_id . '</td>';
                echo '<td>' . $resultado->created_at . '</td>';
                echo '<td>' . $resultado->updated_at . '</td>';
                echo '<td><button type="submit" id="btn-actualizar" class="btn btn-warning btn-actualizar" data-bs-toggle="modal" data-bs-target="#modalTarea" data-id="' . $resultado->id . '">Editar Tarea <i class="bi bi-pencil-square"></i></button></td>';
                echo '<td><button data-bs-toggle="modal" data-bs-target="#modalEliminar" class="btn btn-danger eliminar" data-id="' . $resultado->id . '">Eliminar <i class="bi bi-trash"></i></button></td>';
                echo '</tr>';
            }
        }
    
