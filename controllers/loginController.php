<?php
include_once __DIR__ . '/../models/userModels.php';
class loginController
{
    public function indexLogin()
    {
        include __DIR__ . '/../views/loginView.php';
        return;
    }

    public function login($email, $pass)
    {
        
        session_start();
            // Buscar el usuario por email
            $user = new UserModel;
            $user = UserModel::where('email', $email)->first();
        
            if (!$user) 
            {
                echo json_encode(['status' => 'errorEmail', 'message' => 'The email you entered is incorrect or does not exist']);
            } 
            else
            {
                // Verificar la contraseña
                if (password_verify($pass, $user->password)) 
                {
                    // Guardar los datos del usuario en la sesión
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['username'] = $user->username;
                    echo json_encode(['status' => 'success', 'message' => 'Login successful']);
                    header('Location: userView.php');
                    exit();
                } else {
                    echo json_encode(['status' => 'errorPass', 'message' => 'Incorrect password']);
                }
            }
         
        
    }
 }


?>