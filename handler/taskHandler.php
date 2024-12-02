<?php
require __DIR__ . '/../models/projectModels.php';
require __DIR__ . '/../controllers/taskController.php';


// Opciones de los Projectos
if (isset($_POST['action']) && $_POST['action'] == 'printOptionsProject') 
{
    $projectsModel = new ProjectModel();
    $projects = $projectsModel->printOptionsProject(); // Asigna el valor devuelto a $projects

    // Filtrar los resultados basados en el término de búsqueda
    if (isset($_POST['q'])) {
        $q = $_POST['q'];
        $projects = array_filter($projects, function($project) use ($q) {
            // stripos: Busca la posición de la primera aparición del término de búsqueda $q en el nombre del proyecto, ignorando mayúsculas y minúsculas.
            return stripos($project['name'], $q) !== false;
            // Si es falso significa que no se encontró
        });
    }

    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $limit = 5; // Número de resultados por página
    $offset = ($page - 1) * $limit;

    // Realizar el slice del array para mostrar una porción del mismo
    $data = array_slice($projects, $offset, $limit);

    echo json_encode($data);
}


//Imprimir Tabla Tareas
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

    $data = new TaskController;
    $data->printTable($draw, $start, $length, $searchValue);
}

//llama al controlador para  crear un Tarea
if (isset($_POST['action']) && $_POST['action'] == 'createTask') 
{
    
    $projectId = $_POST['projectId'];
    $description = $_POST['description'];
    $dueDate = $_POST['date'];
    $priority = $_POST['priority'];
    $completed = $_POST['completed'];
    $userId = $_POST['assigner'];

    $controller = new TaskController;
    $up = $controller->createTask($projectId, $description, $dueDate, $priority, $completed, $userId);
}

//llama al controlador para editar un Tarea
if (isset($_POST['action']) && $_POST['action'] == 'editTask') 
{
    $id = $_POST['id'];
    $projectId = $_POST['projectId'];
    $description = $_POST['description'];
    $dueDate = $_POST['date'];
    $priority = $_POST['priority'];
    $completed = $_POST['completed'];
    $userId = $_POST['assigner'];

    $controller = new TaskController;
    $controller->editTask($id, $projectId, $description, $dueDate, $priority, $completed, $userId);
}

//llama al controlador para Eliminar un Tarea
if (isset($_POST['action']) && $_POST['action'] == 'deleteTask') 
{
    $id = $_POST['id'];

    $controller = new TaskController;
    $controller->deleteTask($id);
}

?>