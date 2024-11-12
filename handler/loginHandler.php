<?php
require  __DIR__ . '/../controllers/loginController.php';

if (isset($_POST['action']) && $_POST['action'] == 'login') 
{
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $code = $_POST['code'];
    $method = new loginController;
    
    if(empty($code))
    {
        $method->login($email,  $pass);
    }
    else
    {
        $method->verify($code);
    }
    
}


?>