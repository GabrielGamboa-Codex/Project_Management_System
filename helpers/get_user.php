<?php
use models\User;

$database = new Database();
$db = $database->getConnection();
//escribir por un metodo action en el ajax para que ejecute acciones espeficas
$usuario = new User($db);
$stmt = $usuario->leerUsuarios();
//Esto va en el controlador
$usuarios_arr = array();
foreach ($stmt as $usuario) {
    $usuarios_arr[] = array(
        "id" => $usuario->id,
        "username" => $usuario->username,
        "email" => $usuario->email,
        "team_id" => $usuario->team_id,
        "created_at" => $usuario->created_at,
        "updated_at" => $usuario->updated_at,
    );  
}

echo json_encode(array("data" => $usuarios_arr))

?>