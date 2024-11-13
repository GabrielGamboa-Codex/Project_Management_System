<?php
require __DIR__ . '/../models/projectModels.php';
require __DIR__ . '/../models/userModels.php';

if (isset($_POST['action']) && $_POST['action'] == 'printOptionsUser') 
{
    $data = new UserModel;
    $data->printOptionsUser();
}

if (isset($_POST['action']) && $_POST['action'] == 'printOptionsProject') 
{
    $data = new ProjectModel;
    $teams = $data->printOptionsProject();
}





?>