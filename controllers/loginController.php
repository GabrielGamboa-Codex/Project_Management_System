<?php

include_once __DIR__ . '/../models/userModels.php';
require __DIR__ . '/../vendor/autoload.php';
use SendGrid\Mail\Mail;

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
        if (file_exists($file)) {
            $attempts = json_decode(file_get_contents($file), true);
            return isset($attempts[$email]) ? $attempts[$email] : ['failedAttempts' => 0, 'lastAttemptTime' => 0];
        }
        return ['failedAttempts' => 0, 'lastAttemptTime' => 0];
    }

    private function saveLoginAttempts($email, $data)
    {
        $file = __DIR__ . '/../config/loginAttempts.json';
        $attempts = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $attempts[$email] = $data;
        file_put_contents($file, json_encode($attempts));
    }

    public function login($email, $pass)
    {
        session_start();

        $attempts = $this->getLoginAttempts($email);

        if ($attempts['failedAttempts'] >= $this->maxAttempts) {
            if (time() - $attempts['lastAttemptTime'] < $this->lockoutTime) {
                echo json_encode(['status' => 'locked', 'message' => 'Too many failed attempts. Account is locked.']);
                return;
            } else {
                $attempts['failedAttempts'] = 0;
            }
        }

        $user = UserModel::where('email', $email)->first();

        if (!$user) {
            echo json_encode(['status' => 'errorEmail', 'message' => 'The email you entered is incorrect or does not exist']);
        } else {
            if (password_verify($pass, $user->password)) {
                $attempts['failedAttempts'] = 0;
                $attempts['lastAttemptTime'] = 0;
                $this->saveLoginAttempts($email, $attempts);
                $_SESSION['user_id'] = $user ->id;
                $_SESSION['username'] = $user->username;
                $code = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $_SESSION['verification_code'] = $code;
                $_SESSION['code_expiry'] = time() + 300;


               // Preparar el correo electrónico 
               $userEmail = $user->email; $subject = "Tu código de verificación"; 
               $message = "Hola {$user->username},\n\nTu código de verificación es: $code\n\nGracias,\nEquipo de Proyect System Management"; 
               $email = new Mail(); $email->setFrom("no-reply@yourdomain.com", "Proyect System Management"); // Usar una dirección verificada 
               $email->setSubject($subject); $email->addTo($userEmail);

                $email = new Mail();
                $email->setFrom("foxygamboafnaf2003@gmail.com", "Proyect System Management");
                $email->setSubject($subject);
                $email->addTo($userEmail);
                $email->addContent("text/plain", $message);

                $sendgrid = new \SendGrid('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');
                
                try {
                    $response = $sendgrid->send($email);
                    if ($response->statusCode() == 202) {
                        echo json_encode(['status' => 'success', 'message' => 'A numeric code has been sent to your email. You have a total of 5 minutes to enter it.']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Failed to send email.']);
                    }
                } catch (Exception $e) {
                    echo json_encode(['status' => 'error', 'message' => 'Caught exception: '. $e->getMessage()]);
                }

            } else {
                $attempts['failedAttempts']++;
                $attempts['lastAttemptTime'] = time();
                $this->saveLoginAttempts($email, $attempts);

                if ($attempts['failedAttempts'] >= $this->maxAttempts) {
                    echo json_encode(['status' => 'locked', 'message' => 'Too many failed attempts. Account is locked.']);
                } else {
                    echo json_encode(['status' => 'errorPass', 'message' => 'Incorrect password']);
                }
            }
        }
    }

    public function verify($code)
    {
        session_start();
        
        $storedCode = $_SESSION['verification_code'];
        $expiryTime = $_SESSION['code_expiry'];

        if (time() > $expiryTime) {
            echo json_encode(['status' => 'expired', 'message' => 'The code has expired. Please request a new one reloading the page.']);
        } elseif ($code === $storedCode) {
            echo json_encode(['status' => 'successTotal', 'message' => 'You have been successfully authenticated.']);
        } else {
            echo json_encode(['status' => 'errorCode', 'message' => 'Incorrect verification code.']);
        }
    }

    public function logOut()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}
