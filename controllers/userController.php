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
        $user = new UserModel();
        $user->printTable();
    }

    //envia los datos al modelo para crear un usuario
    public function createUser($userName, $email, $pass, $team_id)
    {
        try {
            $user = new UserModel();

            //comprueba que los valores existan y guarda la informacion en una variable
            $userExist = UserModel::where('username', $userName)->exists();
            $userEmail = UserModel::where('email', $email)->exists();
            
            $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/';

            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['status' => 'errorEmail', 'message' => 'The mail is Invalid.']);
            }
            elseif(!preg_match($pattern, $pass))
            {
                if(!preg_match($pattern, $pass))
                {
                    echo json_encode(['status' => 'errorEditPass', 'message' => 'The Password is invalid It must contain at least 8 characters, including one special character, numbers and letters']);
                }
                else
                {
                    echo json_encode(['status' => 'successEditPass', 'message' => 'The Password is Valid']);
                }
            }
            else
            {
                if ($userExist) 
                {
                    echo json_encode(['status' => 'errorUser', 'message' => 'The User is already registered.']);
                } 
                elseif ($userEmail) 
                {
                    echo json_encode(['status' => 'errorEmail', 'message' => 'The mail is already registered.']);
                } 
                else 
                {
                    $user->createUser($userName, $email, $pass, $team_id);
    
                    echo json_encode(['status' => 'success']);
                }
            }   
            
            //Pendiente por Revision 
        } catch (PDOException $e) {
            $error = ['status' => 'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }

    //envia los datos al modelo para editar un usuario
    public function editUser($id, $userName, $email, $pass, $team_id)
    {


        try {
            $user = new UserModel();
            //comprueba que los valores existan y guarda la informacion en una variable
            $userFind = UserModel::where('username', $userName)
                ->where('id', '!=', $id)
                ->exists();

            $userEmail = UserModel::where('email', $email)
                ->where('id', '!=', $id)
                ->exists();
            $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/';

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                echo json_encode(['status' => 'errorEditEmail', 'message' => 'The mail is Invalid.']);
            }
            elseif(!preg_match($pattern, $pass))
            {
                if(!preg_match($pattern, $pass))
                {
                    echo json_encode(['status' => 'errorEditPass', 'message' => 'The Password is invalid It must contain at least 8 characters, including one special character, numbers and letters']);
                }
                else
                {
                    echo json_encode(['status' => 'successEditPass', 'message' => 'The Password is Valid']);
                }
            }
            else
            {
                if ($userFind == true) 
                {
                    echo json_encode(['status' => 'errorEditUser', 'message' => 'The User is already registered.']);
                } 
                elseif ($userEmail == true) 
                {
                    echo json_encode(['status' => 'errorEditEmail', 'message' => 'The mail is already registered.']);
                } 
                else 
                {
                    
                    $user->editUser($id, $userName, $email, $pass, $team_id);
                    echo json_encode(['status' => 'success']);
                }
            }
        } catch (PDOException $e) {
            $error = ['status' => 'ERRORedit', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }


    //envia los datos al modelo para editar un usuario
    public function deleteUse($id)
    {
        try {
            $user = new UserModel();
            $user->deleteUser($id);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            $error = ['status' => 'ERRORdelete', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }
}
