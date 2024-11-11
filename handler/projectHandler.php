<?php

require_once  __DIR__ . '/../controllers/projectController.php';
require_once __DIR__ . '/../models/teamModels.php';

//llama al controlador para imprimir la tabla
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    $conn = new ProjectController;
    $show = $conn->printTable();
}
///Llama para cargar el select
if (isset($_POST['action']) && $_POST['action'] == 'printOptions') 
{
    $data = new TeamModel;
    $teams = $data->printOptions();
}

//llama al controlador para  crear un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'createProject') 
{
    $ProjectName = $_POST['name'];
    $description = $_POST['description'];
    $teamId = $_POST['team_id'];

    $controller = new ProjectController;
    $up = $controller->createProject($ProjectName, $description, $teamId);
}

//llama al controlador para editar un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'editProject') 
{
    $id = $_POST['id'];
    $projectName = $_POST['name'];
    $description = $_POST['description'];
    $teamId = $_POST['team_id'];

    $controller = new ProjectController;
    $edit = $controller->editProject($id, $projectName, $description, $teamId);
}

//llama al controlador para Eliminar un usuario
if (isset($_POST['action']) && $_POST['action'] == 'deleteProject') 
{
    $id = $_POST['id'];

    $controller = new ProjectController;
    $edit = $controller->deleteUse($id);
}

