<?php
require '../controllers/userController.php';

if(isset($_POST['action']) && $_POST['action'] == 'printTable')
{
    $conn = new userController;
    $show =$conn->printTable();
}

if(isset($_POST['action']) && $_POST['action'] == 'createUser')
{
    $username = $_POST['username']; 
    $email = $_POST['email'];;
    $pass = $_POST['pass'];;
    $team_id = $_POST['team_id'];;

    $controller = new userController;
    $up = $controller->userCreate($username,$email,$pass,$team_id);
}


?>