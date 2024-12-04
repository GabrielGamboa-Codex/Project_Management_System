<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;

class ProjectHistoryModel extends Model
{ 

    protected $table = 'project_history';

    // Deshabilitar timestamps automáticos como created_at updated_at
    public $timestamps = false; 
    
       

        public function printTable($draw, $start, $length, $searchValue, $projectId, $userId , $status , $startDate , $endDate ) {
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
    
                // Filtros según los parámetros recibidos
                // Filtro por proyecto
                if (!empty($projectId)) {
                    $query->where('project_history.project_id', $projectId);
                }
                // Filtro por usuario
                if (!empty($userId)) {
                    $query->where('project_history.user_id', $userId);
                }
                // Filtro por estatus
                if (!empty($status)) {
                    $query->where('project_history.action', $status);
                }
                // Filtro por un parametro de fecha
                if (!empty($startDate) && !empty($endDate)) {
                    $query->whereBetween('project_history.timestamp', [$startDate, $endDate]);
                } elseif (!empty($startDate)) {
                    $query->where('project_history.timestamp', '>=', $startDate);
                } elseif (!empty($endDate)) {
                    $query->where('project_history.timestamp', '<=', $endDate);
                }

    
                $totalRecords = $query->count();
                $data = $query->skip($start)->take($length)->get();
    
                $projectHistoryArr = [];
                foreach ($data as $history) {
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
    
                $response = [
                    "draw" => $draw,
                    "recordsTotal" => $totalRecords,
                    "recordsFiltered" => $totalRecords,
                    "data" => $projectHistoryArr
                ];
    
                echo json_encode($response);
    
            } catch (PDOException $e) {
                $error = ['status' => 'ERROR', 'message' => "An error has occurred: " . $e->getMessage()];
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

}
    
