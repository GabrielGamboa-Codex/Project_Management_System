<?php
require  __DIR__ . '/../controllers/teamController.php';
//llama al controlador para imprimir la tabla
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    // Capturar parámetros de DataTables
    //draw es un contador utilizado por DataTables para sincronizar las solicitudes y respuestas.
    $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
    //start indica el índice del primer registro a devolver.
    $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
    //length indica el número de registros a devolver.
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
    //Es el termino de busqueda intruduccido por el usuario en el datatable
    $searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

    $conn = new TeamController;
    $show = $conn->printTable($draw, $start, $length, $searchValue);
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