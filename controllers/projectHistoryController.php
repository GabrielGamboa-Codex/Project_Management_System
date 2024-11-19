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

    public function search($projectId, $userId, $status, $date)
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

            // Usar 'orWhere' para buscar coincidencias parciales en cada campo
            if (!empty($projectId)) {
                $query->orWhere('projects.id', 'LIKE', '%' . $projectId . '%');
            }

            if (!empty($userId)) {
                $query->orWhere('users.id', 'LIKE', '%' . $userId . '%');
            }

            if (!empty($status)) {
                $statusArray = explode(',', $status);
                $query->orWhereIn('project_history.action', $statusArray);
            }

            if (!empty($date)) {
                $query->orWhereDate('project_history.timestamp', $date);
            }

            $results = $query->get();

            $projectHistoryArr = [];

            foreach ($results as $history) {
                $projectHistoryArr[] = array(
                    "id" => $history->id,
                    "projectId" => $history->projectId,
                    "projectName" =>  $history->projectName,
                    "action" => $history->action,
                    "userId" => $history->userId,
                    "userName" => $history->userName,
                    "timestamp" => $history->timestamp,
                );
            }

            echo json_encode(['status' => 'success', 'data' => $projectHistoryArr]);
        } catch (PDOException $e) {
            //instacio al cliente como procesar la respuesta en este caso un json
            header('Content-Type: application/json'); 
            $error = ['status' => 'error', 'message' => $e->getMessage()]; 
            echo json_encode($error);
        }
    }
}
