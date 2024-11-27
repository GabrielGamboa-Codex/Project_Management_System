<?php
require  __DIR__ . '/../controllers/projectController.php';
require __DIR__ . '/../models/teamModels.php';

//llama al controlador para imprimir la tabla
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    $conn = new ProjectController;
    $show = $conn->printTable();
}
//llama al controlador para  crear un Projecto
if (isset($_POST['action']) && $_POST['action'] == 'createProject') 
{
    $projectName = $_POST['name'];
    $description = $_POST['description'];
    $teamId = $_POST['teamId'];

    $controller = new ProjectController;
    $up = $controller->createProject($projectName, $description, $teamId);
}

//llama al controlador para editar un Projecto
if (isset($_POST['action']) && $_POST['action'] == 'editProject') 
{
    $id = $_POST['id'];
    $projectName = $_POST['name'];
    $description = $_POST['description'];
    $teamId = $_POST['teamId'];

    $controller = new ProjectController;
    $controller->editProject($id, $projectName, $description, $teamId);
}

//llama al controlador para Eliminar un Projecto
if (isset($_POST['action']) && $_POST['action'] == 'deleteProject') 
{
    $id = $_POST['id'];

    $controller = new ProjectController;
    $controller->deleteProject($id);
}

if (isset($_POST['action']) && $_POST['action'] == 'printOptions') {
    $model = new TeamModel;
    $teams = $model->printOptions();

    // Filtrar los resultados basados en el término de búsqueda
    //Verifica si el parametro q esta definido en la solicitud post
    if (isset($_POST['q'])) {
        $q = $_POST['q'];
        $teams = array_filter($teams, function($team) use ($q) {
         //stripos($team['name'], $q): Busca la posición de la primera aparición del término de 
         //búsqueda $q en el nombre del equipo $team['name'], ignorando mayúsculas y minúsculas.   
            return stripos($team['name'], $q) !== false;
            //si es falso significa que no se encontro
        });
    }

    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $limit = 5; // Número de resultados por página
    $offset = ($page - 1) * $limit;

    // Realizar el slice del array
    $data = array_slice($teams, $offset, $limit);

    echo json_encode($data);
}





