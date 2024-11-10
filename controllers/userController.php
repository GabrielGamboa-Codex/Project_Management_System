<?php
include __DIR__ . '/../models/userModels.php';

class UserController
{
     
    public function indexUser()
    { 
            include 'views/header.php'; 
            include 'views/userView.php'; 
        
    }

    //Funcion para guardar los datos en un arreglo e imprimirlo
    public function printTable()
    {
        $user = new UserModel();
        $user->printTable();
    }

    //envia los datos al modelo para crear un usuario
    public function createUser($userName, $email, $pass, $teamId)
    {
        try {
            $user = new UserModel();

            //comprueba que los valores existan y guarda la informacion en una variable
            $userExist = UserModel::where('username', $userName)->exists();
            $userEmail = UserModel::where('email', $email)->exists();
            
            $patternEmail = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/';
            $patternUser = '/^[a-zA-Z0-9\s]{4,}$/';

            if (!preg_match($patternUser, $userName)) 
            {
                echo json_encode(['status' => 'errorUser', 'message' => 'The field cannot be empty and must contain at least 4 characters.']);
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['status' => 'errorEmail', 'message' => 'The Email field must not be empty and must contain the @ and example gmail.com.']);
            }
            elseif(!preg_match($patternEmail, $pass))
            {
                if(!preg_match($patternEmail, $pass))
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
            $error = ['status' => 'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
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
            $patternEmail = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/';
            $patternUser = '/^[a-zA-Z0-9]{4,}$/';

            if (!preg_match($patternUser, $userName)) 
            {
                echo json_encode(['status' => 'errorEditUser', 'message' => 'The field cannot be empty and must contain at least 4 characters.']);
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                echo json_encode(['status' => 'errorEditEmail', 'message' => 'The Email field must not be empty and must contain the @ and example gmail.com.']);
            }
            elseif(!empty($pass) && !preg_match($patternEmail, $pass))
            {
                if(!preg_match($patternEmail, $pass))
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
