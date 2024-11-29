<?php
require  __DIR__ . '/../controllers/userController.php';
require __DIR__ . '/../models/teamModels.php';

//llama al controlador para imprimir la tabla
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    $conn = new UserController;
    $show = $conn->printTable();
}
//llama al controlador para  crear un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'createUser') 
{
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $teamId = $_POST['team_id'];

    $controller = new UserController;
    $up = $controller->createUser($userName, $email, $pass, $teamId);
}

//llama al controlador para editar un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'editUser') 
{
    $id = $_POST['id'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $teamId = $_POST['teamId'];

    $controller = new UserController;
    $edit = $controller->editUser($id, $userName, $email, $pass, $teamId);
}

//llama al controlador para Eliminar un usuario
if (isset($_POST['action']) && $_POST['action'] == 'deleteUser') 
{
    $id = $_POST['id'];

    $controller = new UserController;
    $edit = $controller->deleteUse($id);
}

//Imprime las Opciones del select
if (isset($_POST['action']) && $_POST['action'] == 'printOptions') 
{
    $data = new TeamModel;
    $teams = $data->printOptions();
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
