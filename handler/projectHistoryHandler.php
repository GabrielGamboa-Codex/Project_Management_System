<?php
require  __DIR__ . '/../controllers/projectHistoryController.php';
require __DIR__ . '/../models/projectModels.php';
require __DIR__ . '/../models/userModels.php';


//Imprime las Opciones del select
if (isset($_POST['action']) && $_POST['action'] == 'printProject') 
{
    $data = new ProjectModel;
    $proyect = $data->printProject();
}

//Imprime las Opciones del select
if (isset($_POST['action']) && $_POST['action'] == 'printUser') 
{
    $data = new UserModel;
    $user = $data->printUser();
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