<?php
require  __DIR__ . '/../controllers/teamController.php';
//llama al controlador para imprimir la tabla
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    $conn = new TeamController;
    $show = $conn->printTable();
}

//llama al controlador para  crear un Team
if (isset($_POST['action']) && $_POST['action'] == 'createTeam') 
{
    $teamName = $_POST['name'];

    $controller = new TeamController;
    $up = $controller->createTeam($teamName);
}

//llama al controlador para editar un Team
if (isset($_POST['action']) && $_POST['action'] == 'editTeam') 
{
    $id = $_POST['id'];
    $teamName = $_POST['name'];

    $controller = new TeamController;
    $controller->editTeam($id, $teamName);
}

//llama al controlador para Eliminar un Team
if (isset($_POST['action']) && $_POST['action'] == 'deleteTeam') 
{
    $id = $_POST['id'];

    $controller = new TeamController;
    $controller->deleteTeam($id);
}