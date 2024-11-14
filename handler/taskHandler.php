<?php
require __DIR__ . '/../models/projectModels.php';
require __DIR__ . '/../controllers/taskController.php';


//Opciones de los Projectos
if (isset($_POST['action']) && $_POST['action'] == 'printOptionsProject') 
{
    $data = new ProjectModel();
    $data->printOptionsProject();
}

//Imprimir Tabla Tareas
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    $data = new TaskController;
    $data->printTable();
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