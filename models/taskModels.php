<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{

    protected $table = 'Tasks';

    public function printTable()
    {
        try {
            $taskArr = array();
            $tasks = TaskModel::join('projects', 'tasks.project_id', '=', 'projects.id')
                ->join('users', 'tasks.assigned_user_id', '=', 'users.id')
                ->select(
                    'tasks.id as taskId',
                    'projects.id as projectId',
                    'projects.name as projectName',
                    'tasks.description',
                    'tasks.due_date',
                    'tasks.priority',
                    'tasks.completed',
                    'users.id as userId',
                    'users.username as userName',
                    'tasks.created_at',
                    'tasks.updated_at',
                    'tasks.status',
                )
                ->where('tasks.status', true)
                ->get();

    
            foreach ($tasks as $task) {
                $taskArr[] = array(
                    "id" => $task->taskId,
                    "project_id" => $task->projectName,
                    "description" => $task->description,
                    "due_date" => $task->due_date,
                    "priority" => $task->priority,
                    "completed" => $task->completed,
                    "assigned_user_id" => $task->userName,
                    "created_at" => $task->created_at,
                    "updated_at" => $task->updated_at,
                    "status"=> $task->status,
                );
            }
            //indexas el arreglo con el string data
            echo json_encode(array("data" => $taskArr));
        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
       
    }

    //funcion de crear Tareas
    public function createTask($projectId, $description, $dueDate, $priority, $completed, $userId)
    {
        try {
            $date = date('Y-m-d H:i:s');
            $task = new TaskModel();
            $created = $date;
            $updated = $date;
            $task->project_id = $projectId;
            $task->description = $description;
            $task->due_date = $dueDate;
            $task->priority = $priority;
            $task->completed = $completed;
            $task->assigned_user_id = $userId;
            $task->created_at = $created;
            $task->updated_at = $updated;
            $task->status = true;
            $task->save();

        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }

    //funcion de editar Tareas
    public function editTask($id, $projectId, $description, $dueDate, $priority, $completed, $userId)
    {
        try {
            $task = new TaskModel();
            $task = TaskModel::find($id);
            $date = date('Y-m-d H:i:s');

            $updated = $date;
            $task->project_id = $projectId;
            $task->description = $description;
            $task->due_date = $dueDate;
            $task->priority = $priority;
            $task->completed = $completed;
            $task->assigned_user_id = $userId;
            $task->updated_at = $updated;
            $task->status = true;
            $task->save();
           

        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }

    //funcion de eliminar Tareas
    public function deleteProject($id)
    {
        try {
        
            $project = new TaskModel();
            $project = TaskModel::find($id);
            $project->status = false;
            $project->save();

        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }
}


 