<?php
include_once __DIR__ . '/../models/userModels.php';

class loginController
{
    private $maxAttempts = 3; // Número máximo de intentos fallidos permitidos
    private $lockoutTime = 15 * 60; // 15 minutos de bloqueo

    public function indexLogin()
    {
        include __DIR__ . '/../views/loginView.php';
        return;
    }

    private function getLoginAttempts($email)
    {
        $file = __DIR__ . '/../config/loginAttempts.json';
        //si el archivo existe entonces
        if (file_exists($file)) {
            //va a decodificar el json para convertirlo en un array asosiativo
            $attempts = json_decode(file_get_contents($file), true);
            //si no hay nada entonces va a devolver los valores de intentos por defecto
            return isset($attempts[$email]) ? $attempts[$email] : ['failedAttempts' => 0, 'lastAttemptTime' => 0];
        }
        return ['failedAttempts' => 0, 'lastAttemptTime' => 0];
    }

    private function saveLoginAttempts($email, $data)
    {
        $file = __DIR__ . '/../config/loginAttempts.json';
        //va a decodificar el json para convertirlo en un array asosiativo si el archivo no existe inicia un array vacio
        $attempts = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        //actualiza los datos del email especifico con la data que son los intentos
        $attempts[$email] = $data;
        //codifica el array de intentos actualizado como una cadena JSON y lo guarda en el archivo.
        file_put_contents($file, json_encode($attempts));
    }

    public function login($email, $pass)
    {
        session_start();

        // Obtener intentos de inicio de sesión del archivo JSON
        $attempts = $this->getLoginAttempts($email);

        // Verificar si la cuenta está bloqueada
        if ($attempts['failedAttempts'] >= $this->maxAttempts) {
            if (time() - $attempts['lastAttemptTime'] < $this->lockoutTime) {
                echo json_encode(['status' => 'locked', 'message' => 'Too many failed attempts. Account is locked.']);
                return;
            } else {
                // Restablecer el contador de intentos fallidos después del tiempo de bloqueo
                $attempts['failedAttempts'] = 0;
            }
        }

        // Buscar el usuario por email
        $user = UserModel::where('email', $email)->first();

        if (!$user) {
            echo json_encode(['status' => 'errorEmail', 'message' => 'The email you entered is incorrect or does not exist']);
        } else {
            // Verificar la contraseña
            if (password_verify($pass, $user->password)) {
                // Restablecer el contador de intentos fallidos al iniciar sesión correctamente
                $attempts['failedAttempts'] = 0;
                $attempts['lastAttemptTime'] = 0;
                //Guarda ambos valores en un arreglo e inicializa el mismo en la funcion
                $this->saveLoginAttempts($email, $attempts);

                // Guardar los datos del usuario en la sesión
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;

                echo json_encode(['status' => 'success']);
            } else {
                // Incrementar el contador de intentos fallidos
                $attempts['failedAttempts']++;
                $attempts['lastAttemptTime'] = time();
                 //Guarda ambos valores en un arreglo
                $this->saveLoginAttempts($email, $attempts);

                if ($attempts['failedAttempts'] >= $this->maxAttempts) {
                    echo json_encode(['status' => 'locked', 'message' => 'Too many failed attempts. Account is locked.']);
                } else {
                    echo json_encode(['status' => 'errorPass', 'message' => 'Incorrect password']);
                }
            }
        }
    }

    public function logOut()
    {
        session_start();
        session_unset(); // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión
    }
}


