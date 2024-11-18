<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;

class ProjectHistoryModel extends Model
{ 

    protected $table = 'project_history';

    // Deshabilitar timestamps automáticos 
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
}
    
