<?php
require  __DIR__ . '/../controllers/projectController.php';
require __DIR__ . '/../models/teamModels.php';

//llama al controlador para imprimir la tabla
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    $conn = new ProjectController;
    $show = $conn->printTable();
}
//llama al controlador para  crear un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'createProject') 
{
    $projectName = $_POST['name'];
    $description = $_POST['description'];
    $teamId = $_POST['team_id'];

    $controller = new ProjectController;
    $up = $controller->createProject($projectName, $description, $teamId);
}

//llama al controlador para editar un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'editProject') 
{
    $id = $_POST['id'];
    $projectName = $_POST['name'];
    $description = $_POST['description'];
    $teamId = $_POST['team_id'];

    $controller = new ProjectController;
    $controller->editProject($id, $projectName, $description, $teamId);
}

//llama al controlador para Eliminar un usuario
if (isset($_POST['action']) && $_POST['action'] == 'deleteProject') 
{
    $id = $_POST['id'];

    $controller = new ProjectController;
    $controller->deleteProject($id);
}

if (isset($_POST['action']) && $_POST['action'] == 'printOptions') 
{
    $data = new TeamModel;
    $teams = $data->printOptions();
}