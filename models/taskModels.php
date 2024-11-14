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
                    'tasks.due_date as dueDate',
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
                    "project_id" => $task->projectId,
                    "project" => $task->projectName,
                    "description" => $task->description,
                    "due_date" => $task->dueDate,
                    "priority" => $task->priority,
                    //Se utiliza un valor ternario si es 1 osea true se asigna completed si es 0 false Pending
                    "completed" => $task->completed ? 'Completed' : 'Pending',
                    "assigned_user_id" => $task->userId,
                    "assigned" => $task->userName,
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
    public function deleteTask($id)
    {
        try {
        
            $task = new TaskModel();
            $task = TaskModel::find($id);
            $task->status = false;
            $task->save();

        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }
}


 