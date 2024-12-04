<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/projectHistoryModels.php';

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

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

    public function search($projectId, $userId, $status, $startDate, $endDate)
    {
        $search = new ProjectHistoryModel;
        $search->search($projectId, $userId, $status, $startDate, $endDate);
    }
}    
