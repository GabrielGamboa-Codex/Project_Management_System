<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/projectHistoryModels.php';

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{

    protected $table = 'projects';

    public function printProject()
    {
        $projectArr = array();
        $projects = ProjectModel::all();

        foreach ($projects as $project) 
        {
            // Verificar si el status es true
            if ($project->status == true) {
                $projectArr[] = array(
                    "id" => $project->id,
                    "name" => $project->name,
                );
            }
        }
        //indexas el arreglo con el string data
        echo json_encode($projectArr);
    }

    public function printOptionsProject()
    {
        $projectArr = array();
    
        // Obtener todos los proyectos con sus respectivos usuarios si el proyecto no tiene un usuario
        //asociado no lo imprime el proyecto
        $projects = ProjectModel::join('teams', 'projects.team_id', '=', 'teams.id')
            ->join('users', 'users.team_id', '=', 'teams.id')
            ->select(
                'projects.id as projectId',
                'projects.name as projectName',
                'projects.status as projectStatus',
                'users.id as userId',
                'users.username as userName',
                'users.status as userStatus',
                'teams.id as teamId'
            )
            ->where('projects.status', true)
            ->where('users.status', true)
            ->get();
    
        // Agrupar usuarios por proyecto
        foreach ($projects as $project) {
            if (!isset($projectArr[$project->projectId])) {
                $projectArr[$project->projectId] = array(
                    "id" => $project->projectId,
                    "name" => $project->projectName,
                    "users" => array()
                );
            }
    
            // Agregar usuarios al proyecto correspondiente
            $projectArr[$project->projectId]['users'][] = array(
                "id" => $project->userId,
                "username" => $project->userName
            );
        }
    
        // Convertir el arreglo a JSON y mostrarlo
        echo json_encode(array_values($projectArr)); // usar array_values para reindexar el arreglo
    }
    


    public function printTable()
    {
        try {
            $projectArr = array();
            $projects = ProjectModel::join('teams', 'projects.team_id', '=', 'teams.id')
                ->select(
                    'projects.id as projectId',
                    'projects.name as projectName',
                    'projects.description',
                    'projects.created_at',
                    'projects.updated_at',
                    'projects.status',
                    'teams.name',
                    'teams.id'
                )
                 ->where('projects.status', true)
                 ->get();
    
            foreach ($projects as $project) {
                $projectArr[] = array(
                    "id" => $project->projectId,
                    "name" => $project->projectName,
                    "description" => $project->description,
                    "team_id" => $project->id,
                    "team" => $project->name,
                    "created_at" => $project->created_at,
                    "updated_at" => $project->updated_at,
                    "status"=> $project->status,
                );
            }
            //indexas el arreglo con el string data
            echo json_encode(array("data" => $projectArr));
        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
       
    }

     //funcion de crear Projectos
     public function createProject($projectName, $description, $teamId)
     {
         try {
            session_start();
             $date = date('Y-m-d H:i:s');
             $action = "Create";
            //Guardado en la tabla project
             $project = new ProjectModel();
             $created = $date;
             $updated = $date;
             $project->name  = $projectName;
             $project->description = $description;
             $project->team_id = $teamId;
             $project->created_at = $created;
             $project->updated_at = $updated;
             $project->status = true;
             $project->save();

            //  // Obtener el ID del proyecto guardado 
             $projectId = $project->id;
             $userId = $_SESSION['user_id'];
            //  //Guardamos la accion en la tabla project_history el registro
             $projectHistory = new ProjectHistoryModel();
             $projectHistory->project_id = $projectId;
             $projectHistory->action = $action;
             $projectHistory->user_id = $userId;
             $projectHistory->timestamp = $date;
             $projectHistory->save();

         } catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }
 
     //funcion de editar Projectos
     public function editProject($id, $projectName, $description, $teamId)
     {
         try {
             session_start();
             $project = new ProjectModel();
             $project = ProjectModel::find($id);
             $date = date('Y-m-d H:i:s');
             $action = "Edit";
 
             $updated = $date;
             $project->name  = $projectName;
             $project->description = $description;
             $project->team_id = $teamId;
             $project->updated_at = $updated;
             $project->status = true;
             $project->save();
            
              //Guardamos la accion en la tabla project_history el registro
              $userId = $_SESSION['user_id'];
              $projectHistory = new ProjectHistoryModel();
              $projectHistory->project_id = $id;
              $projectHistory->action = $action;
              $projectHistory->user_id = $userId;
              $projectHistory->timestamp = $date;
              $projectHistory->save();

         } catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }
 
     //funcion de eliminar Projectos
     public function deleteProject($id)
     {
         try {
             session_start();
             $action = "Delete";
             $project = new ProjectModel();
             $project = ProjectModel::find($id);
             $date = date('Y-m-d H:i:s');
             $project->status = false;
             $project->save();
             
             //Guardamos la accion en la tabla project_history el registro
             $userId = $_SESSION['user_id'];
             $projectHistory = new ProjectHistoryModel();
             $projectHistory->project_id = $id;
             $projectHistory->action = $action;
             $projectHistory->user_id = $userId;
             $projectHistory->timestamp = $date;
             $projectHistory->save();

         } catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }
 }
