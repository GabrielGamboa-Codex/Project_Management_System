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
        try {
            $query = ProjectHistoryModel::join('projects', 'project_history.project_id', '=', 'projects.id')
                ->join('users', 'project_history.user_id', '=', 'users.id')
                ->select(
                    'project_history.id',
                    'projects.id as projectId',
                    'projects.name as projectName',
                    'project_history.action',
                    'users.id as userId',
                    'users.username as userName',
                    'project_history.timestamp'
                );
    
            // Filtrar por projectId
            if (!empty($projectId)) {
                $query->where('projects.id', 'LIKE', '%' . $projectId . '%');
            }
    
            // Filtrar por userId
            if (!empty($userId)) {
                $query->where('users.id', 'LIKE', '%' . $userId . '%');
            }
    
            // Filtrar por status
            if (!empty($status)) {
                $query->where('project_history.action', $status);
            }
    
            // Filtrar por rango de fechas
            if (!empty($startDate) && !empty($endDate)) {
                $query->whereBetween('project_history.timestamp', [$startDate, $endDate]);
            } elseif (!empty($startDate)) {
                $query->where('project_history.timestamp', '>=', $startDate);
            } elseif (!empty($endDate)) {
                $query->where('project_history.timestamp', '<=', $endDate);
            }
            
            //obtener los resultados
            $results = $query->get();
    
            //inicializa un arreglo
            $projectHistoryArr = [];
    
            foreach ($results as $history) {
                $projectHistoryArr[] = array(
                    "id" => $history->id,
                    "projectId" => $history->projectId,
                    "projectName" => $history->projectName,
                    "action" => $history->action,
                    "userId" => $history->userId,
                    "userName" => $history->userName,
                    "timestamp" => $history->timestamp,
                );
            }
    
            echo json_encode(['status' => 'success', 'data' => $projectHistoryArr]);
        } catch (PDOException $e) {
            header('Content-Type: application/json'); 
            $error = ['status' => 'error', 'message' => $e->getMessage()]; 
            echo json_encode($error);
        }
    }
}    
