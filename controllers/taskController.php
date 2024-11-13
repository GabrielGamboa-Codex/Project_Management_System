<?php
include __DIR__ . '/../models/taskModels.php';

class TaskController
{
    public function indexTask()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/taskView.php';
        return;
    }

    //Funcion para guardar los datos en un arreglo e imprimirlo
    public function printTable()
    {
        $task = new TaskModel();
        $task->printTable();
    }

        //envia los datos al modelo para crear un usuario
        public function createTask($projectId, $description, $dueDate, $priority, $completed, $userId)
        {
            try {
                $task = new TaskModel();
                
                $patterndescription = '/^[a-zA-Z0-9\s.,;-]{4,}$/';    

                if(!preg_match($patterndescription, $description))
                {
                    if(!preg_match($patterndescription, $description))
                    {
                        echo json_encode(['status' => 'errorDescription', 'message' => 'The description must contain at least 4 characters']);
                        
                    }
                }
                else
                {
                        $task->createTask($projectId, $description, $dueDate, $priority, $completed, $userId);
        
                        echo json_encode(['status' => 'success']);
                    
                }   
                
                //Pendiente por Revision 
            } catch (PDOException $e) {
                $error = ['status' => 'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
                echo json_encode($error);
            }
        }
    
        //envia los datos al modelo para editar un usuario
        public function editTask($id, $projectId, $description, $dueDate, $priority, $completed, $userId)
        {
    
    
            try {
                $task = new TaskModel();
                $patterndescription = '/^[a-zA-Z0-9\s.,;-]{4,}$/';

                if(!preg_match($patterndescription, $description))
                {
                    if(!preg_match($patterndescription, $description))
                    {
                        echo json_encode(['status' => 'errorEditDescription', 'message' => 'The description must contain at least 4 characters']);
                        
                    }
                }
                else
                {   
                        $task->editTask($id, $projectId, $description, $dueDate, $priority, $completed, $userId);
                        echo json_encode(['status' => 'success']);
                    
                }
            } catch (PDOException $e) {
                $error = ['status' => 'errorEdit', 'message' => "An error has occurred:" . $e->getMessage()];
                echo json_encode($error);
            }
        }
    
    
        //envia los datos al modelo para editar un usuario
        public function deleteTask($id)
        {
            try {
                $task = new TaskModel();
                $task->deleteTask($id);
                echo json_encode(['status' => 'success']);
            } catch (Exception $e) {
                $error = ['status' => 'errorDelete', 'message' => "An error has occurred:" . $e->getMessage()];
                echo json_encode($error);
            }
        }
}