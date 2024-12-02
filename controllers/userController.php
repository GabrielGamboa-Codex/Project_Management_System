<?php
include __DIR__ . '/../models/userModels.php';

class UserController
{
    public function indexUser()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/userView.php';
        return;
    }

    //Funcion para guardar los datos en un arreglo e imprimirlo
    public function printTable($draw, $start, $length, $searchValue)
    {
        $user = new UserModel();
        $user->printTable($draw, $start, $length, $searchValue);
    }

    //envia los datos al modelo para crear un usuario
    public function createUser($userName, $email, $pass, $teamId)
    {
        try {
            $user = new UserModel();

            //comprueba que los valores existan y guarda la informacion en una variable
            $userExist = UserModel::where('username', $userName)->exists();
            $userEmail = UserModel::where('email', $email)->exists();
            
            $patternPass = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/';
            $patternUser = '/^[a-zA-Z0-9\s]{4,}$/';

            if (!preg_match($patternUser, $userName)) 
            {
                echo json_encode(['status' => 'errorUser', 'message' => 'The field cannot be empty and must contain at least 4 characters.']);
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['status' => 'errorEmail', 'message' => 'The Email field must not be empty and must contain the @ and example gmail.com.']);
            }
            if (empty($teamId)) 
            {
                echo json_encode(['status' => 'errorSelect', 'message' => 'The Select Team cannot be empty.']);
            }
            elseif(!preg_match($patternPass, $pass))
            {
                if(!preg_match($patternPass, $pass))
                {
                    echo json_encode(['status' => 'errorPass', 'message' => 'The Password is invalid It must contain at least 8 characters, including one special character, numbers and letters']);
                    
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
                    $user->createUser($userName, $email, $pass, $teamId);
    
                    echo json_encode(['status' => 'success']);
                }
            }   
            
            //Pendiente por Revision 
        } catch (PDOException $e) {
            $error = ['status' => 'error', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }

    //envia los datos al modelo para editar un usuario
    public function editUser($id, $userName, $email, $pass, $teamId)
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
            $patternPass = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/';
            $patternUser = '/^[a-zA-Z0-9\s]{4,}$/';

            if (!preg_match($patternUser, $userName)) 
            {
                echo json_encode(['status' => 'errorEditUser', 'message' => 'The field cannot be empty and must contain at least 4 characters.']);
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                echo json_encode(['status' => 'errorEditEmail', 'message' => 'The Email field must not be empty and must contain the @ and example gmail.com.']);
            }
            elseif(!empty($pass) && !preg_match($patternPass, $pass))
            {
                if(!preg_match($patternPass, $pass))
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
                    
                    $user->editUser($id, $userName, $email, $pass, $teamId);
                    echo json_encode(['status' => 'success']);
                }
            }
        } catch (PDOException $e) {
            $error = ['status' => 'errorEdit', 'message' => "An error has occurred:" . $e->getMessage()];
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
            $error = ['status' => 'errorDelete', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }
}
