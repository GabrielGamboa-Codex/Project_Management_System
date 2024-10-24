<?php
include "../models/userModels.php";
class userController extends userModel
{
    //Funcion para guardar los datos en un arreglo e imprimirlo
    public function printTable()
    {
        $users = userModel::all();
;
        $user_arr = array();
        foreach ($users as $user) {
            $user_arr[] = array(
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "team_id" => $user->team_id,
                "created_at" => $user->created_at,
                "updated_at" => $user->updated_at
                );
            }
            //indexas el arreglo con el string data
            echo json_encode(array("data" => $user_arr));
    }

    //envia los datos al modelo para crear un usuario
    public function userCreate($username,$email,$pass,$team_id)
    {
         $this->createUser($username,$email,$pass,$team_id);
    }

    //envia los datos al modelo para editar un usuario
    public function userEdit($id,$username,$email,$pass,$team_id)
    {
         $this->editUser($id,$username,$email,$pass,$team_id);
    }

    //envia los datos al modelo para editar un usuario
    public function userDelete($id)
    {
         $this->deleteUser($id);
    }

}


?>