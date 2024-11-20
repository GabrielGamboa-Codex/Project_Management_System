<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;

class ProjectHistoryModel extends Model
{ 

    protected $table = 'project_history';

    // Deshabilitar timestamps automáticos como created_at updated_at
    public $timestamps = false; 
    
       
    public function printTable()
    {
        try {
            $projectHistoryArr = array();
    
            // Obtener todos los proyectos con sus respectivos usuarios si el proyecto no tiene un usuario
            //asociado no lo imprime el proyecto
            $projectHistory = ProjectHistoryModel::join('projects', 'project_history.project_id', '=', 'projects.id')
            ->join('users', 'project_history.user_id', '=', 'users.id')
            ->select(
                'project_history.id',
                'projects.id as projectId',
                'projects.name as projectName',
                'project_history.action',
                'users.id as  userId',
                'users.username as userName',
                'project_history.timestamp',
            )
            ->get();
    
            foreach ($projectHistory as $history) {
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
    
            //indexas el arreglo con el string data
            echo json_encode(array("data" => $projectHistoryArr)); // usar array_values para reindexar el arreglo
        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
        
    }

    public function saveHistorial($project_id, $action)
    {
        $date = date('Y-m-d H:i:s');
        session_start();
        //Guardamos la accion en la tabla project_history el registro
        $userId = $_SESSION['user_id'];
        $projectHistory = new ProjectHistoryModel();
        $projectHistory->project_id = $project_id;
        $projectHistory->action = $action;
        $projectHistory->user_id = $userId;
         $projectHistory->timestamp = $date;
        $projectHistory->save();
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
    
