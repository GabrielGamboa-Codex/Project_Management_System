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
if (isset($_POST['action']) && $_POST['action'] == 'printTable') {
    $controller = new ProjectHistoryController();

    //Recoje los datos del datable
    $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
    $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
    $searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

    //Recoje los Datos de la Modal
    $projectId = isset($_POST['projectId']) ? $_POST['projectId'] : null;
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    $startDate = isset($_POST['dateStart']) ? $_POST['dateStart'] : null;
    $endDate = isset($_POST['dateEnd']) ? $_POST['dateEnd'] : null;

    $controller->printTable($draw, $start, $length, $searchValue, $projectId, $userId, $status, $startDate, $endDate);
}



?>