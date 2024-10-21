<?php
class userController
{

function __construct()
{
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
}

}



?>