<?php

require_once __DIR__ . '/../models/projectHistoryModels.php';

class ProjectHistoryController
{
     
    public function indexProjectHistory()
    { 
            include 'views/header.php'; 
            include 'views/projectHistoryView.php'; 
        
    }

    //Funcion para guardar los datos en un arreglo e imprimirlo
    public function printTable()
    {
        $project = new ProjectHistoryModel();
        $project->printTable();
    }


}


?>