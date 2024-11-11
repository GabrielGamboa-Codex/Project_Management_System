<?php
require  __DIR__ . '/../controllers/loginController.php';

if (isset($_POST['action']) && $_POST['action'] == 'login') 
{
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $method = new loginController;
    $method->login($email,  $pass);
}


?>