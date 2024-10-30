<?php
include __DIR__ .'/../models/userModels.php';

class userController
{
    public function index() 
    {
        include __DIR__ . '/../views/header.php';   
        include __DIR__ . '/../views/userView.php';                                 
        return;
    }

    //Funcion para guardar los datos en un arreglo e imprimirlo
    public function printTable()
    {
        $user_arr = array();
        $users = userModel::join('teams', 'users.team_id', '=', 'teams.id')
        ->select('users.id as user_id', 'users.username as user_name',
         'users.email as user_email','users.created_at as user_created',
         'users.updated_at as user_updated', 'teams.name as team_name', 'teams.id as team_id')
        ->get();
        
        foreach ($users as $user) {
            $user_arr[] = array(
                "id" => $user->user_id,
                "username" => $user->user_name,
                "email" => $user->user_email,
                "team_id" => $user->team_id,
                "team" => $user->team_name,
                "created_at" => $user->user_created,
                "updated_at" => $user->user_updated
                );
            }
            //indexas el arreglo con el string data
            echo json_encode(array("data" => $user_arr));
    }

    //envia los datos al modelo para crear un usuario
    public function userCreate($username,$email,$pass,$team_id)
    {
         $user = new userModel();
         $user->createUser($username,$email,$pass,$team_id);
    }

    //envia los datos al modelo para editar un usuario
    public function userEdit($id,$username,$email,$pass,$team_id)
    {   
        $user = new userModel();
        $user->editUser($id,$username,$email,$pass,$team_id);
    }

    //envia los datos al modelo para editar un usuario
    public function userDelete($id)
    {
        $user = new userModel();
        $user->deleteUser($id);
    }

}


?>