<?php
require  __DIR__ . '/../controllers/projectController.php';
require __DIR__ . '/../models/teamModels.php';

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
    
    $conn = new ProjectController;
    $show = $conn->printTable($draw, $start, $length, $searchValue);
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

    // Realizar el slice del array extra una porcion de ese array para mostrarlo tomando el indice($offset) y cuantos elementos quiero extraer($limit)
    $data = array_slice($teams, $offset, $limit);

    echo json_encode($data);
}





