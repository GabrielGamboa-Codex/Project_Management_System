<?php
require  __DIR__ . '/../controllers/projectHistoryController.php';
require __DIR__ . '/../models/projectModels.php';
require __DIR__ . '/../models/userModels.php';


//Opciones de los Projecto y usuarios conjutos
if (isset($_POST['action']) && $_POST['action'] == 'printOptionsProject') 
{
    $data = new ProjectModel();
    $data->printProject();
}


//Imprimir datos de la tabla
if  (isset($_POST['action']) && $_POST['action'] == 'printTable')
{
    $conn = new ProjectHistoryController;
    $show = $conn->printTable();

} 

//Hacer la busqueda de la tabla
if(isset($_POST['action']) && $_POST['action'] == 'search')
{
    $controller = new ProjectHistoryController();
    $controller->search($_POST['projectId'], $_POST['userId'], $_POST['status'], $_POST['date']);
}


?>