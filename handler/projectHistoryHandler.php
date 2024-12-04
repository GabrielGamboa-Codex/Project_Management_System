<?php
require  __DIR__ . '/../controllers/projectHistoryController.php';
require_once __DIR__ . '/../models/projectModels.php';


//Opciones de los Projecto y usuarios conjutos
if (isset($_POST['action']) && $_POST['action'] == 'printOptionsProject') 
{
    $data = new ProjectModel();
    $data->printOptions();
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
    $controller->search($_POST['projectId'], $_POST['userId'], $_POST['status'], $_POST['dateStart'], $_POST['dateEnd']);
}


?>