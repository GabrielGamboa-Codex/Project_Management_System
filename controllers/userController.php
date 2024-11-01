<?php
include __DIR__ . '/../models/userModels.php';

class UserController
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
        $users = UserModel::join('teams', 'users.team_id', '=', 'teams.id')
            ->select(
                'users.id as user_id',
                'users.username as user_name',
                'users.email as user_email',
                'users.created_at as user_created',
                'users.updated_at as user_updated',
                'teams.name as team_name',
                'teams.id as team_id'
            )
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
    public function createUser($userName, $email, $pass, $team_id)
    {
        $user = new UserModel();

        //comprueba que los valores existan y guarda la informacion en una variable
        $userExist = UserModel::where('username', $userName)->exists();
        $userEmail = UserModel::where('email', $email)->exists();
        try {
            if ($userExist) 
            {
                http_response_code(200);
                echo json_encode(['status' => 'error1', 'message' => 'The User is already registered.']);
            } elseif ($userEmail) 
            {
                http_response_code(200);
                echo json_encode(['status' => 'error2', 'message' => 'The mail is already registered.']);
            } else 
            {
                $user->createUser($userName, $email, $pass, $team_id);
                http_response_code(200);
                echo json_encode(['status' => 'success']);
            }
            //Pendiente por Revision 
        } catch (PDOException $e) {
            http_response_code(400);
            $error = ['status' => 'ERROR', 'message' => "An error has occurred:" + $e->getMessage()];
            echo json_encode($error);
        }
    }

    //envia los datos al modelo para editar un usuario
    public function editUser($id, $userName, $email, $pass, $team_id)
    {
        $user = new UserModel();
        //comprueba que los valores existan y guarda la informacion en una variable
        $userExist = UserModel::find($id);
        $userFind = UserModel::where('username', $userName)->exists();
        $userEmail = UserModel::where('email', $email)->exists();

        if ($userExist->username != $userName && $userFind) 
        {
            echo json_encode(['status' => 'errorEdit1', 'message' => 'The User is already registered.']);
        } 
        elseif ($userExist->email != $email  && $userEmail) 
        {
            echo json_encode(['status' => 'errorEdit2', 'message' => 'The mail is already registered.']);
        } 
        else 
        {
            $user->editUser($id, $userName, $email, $pass, $team_id);
            echo json_encode(['status' => 'success']);
        }
    }

    //envia los datos al modelo para editar un usuario
    public function deleteUse($id)
    {
        $user = new UserModel();
        $user->deleteUser($id);
    }
}
