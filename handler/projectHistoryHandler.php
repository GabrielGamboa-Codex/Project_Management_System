<?php

require  __DIR__ . '/../controllers/projectHistoryController.php';

//llama al controlador para imprimir la tabla
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    $conn = new ProjectHistoryController;
    $show = $conn->printTable();
}



?>