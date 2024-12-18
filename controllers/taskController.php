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
    public function printTable($draw, $start, $length, $searchValue)
    {
        $task = new TaskModel();
        $task->printTable($draw, $start, $length, $searchValue);
    }

        //envia los datos al modelo para crear un usuario
        public function createTask($projectId, $description, $dueDate, $priority, $completed, $userId)
        {
            try {
                $task = new TaskModel();
                
                $patternDescription = '/^[a-zA-Z0-9\s\W]+$/';
                $patterDate = '/^[0-9-]{1,10}$/';    

                if(!preg_match($patternDescription, $description))
                {
                    if(!preg_match($patternDescription, $description))
                    {
                        echo json_encode(['status' => 'errorDescription', 'message' => 'The description must contain at least 4 characters.']);
                        
                    }
                }
                if (empty($projectId)) 
                {
                    echo json_encode(['status' => 'errorSelect', 'message' => 'The Select cannot be empty.']);
                }
                elseif(!preg_match($patterDate,$dueDate))
                {
                    if(!preg_match($patterDate,$dueDate))
                    {
                        echo json_encode(['status' => 'errorDate', 'message' => 'The Date is empty or the format entered is incorrect.']);
                        
                    }
                }
                elseif(empty($userId))
                {
                        echo json_encode(['status' => 'errorUser', 'message' => 'You cannot register a task without User for that Project.']);       
                }
                else
                {
                        $task->createTask($projectId, $description, $dueDate, $priority, $completed, $userId);
        
                        echo json_encode(['status' => 'success']);
                    
                }   
                
                //Pendiente por Revision 
            } catch (PDOException $e) {
                header('Content-Type: application/json'); 
                $error = ['status' => 'error', 'message' =>  $e->getMessage()];
                echo json_encode($error);
            }
        }
    
        //envia los datos al modelo para editar un usuario
        public function editTask($id, $projectId, $description, $dueDate, $priority, $completed, $userId)
        {
    
    
            try {
                $task = new TaskModel();
                $patternDescription = '/^[a-zA-Z0-9\s\W]+$/';
                $patterDate = '/^[0-9-]{1,10}$/';   

                if(!preg_match($patternDescription, $description))
                {
                    if(!preg_match($patternDescription, $description))
                    {
                        echo json_encode(['status' => 'errorEditDescription', 'message' => 'The description must contain at least 4 characters.']);
                        
                    }
                }
                elseif(!preg_match($patterDate,$dueDate))
                {
                    if(!preg_match($patterDate,$dueDate))
                    {
                        echo json_encode(['status' => 'errorEditDate', 'message' => 'The Date is empty or the format entered is incorrect.']);
                        
                    }
                }
                elseif(empty($userId))
                {
                        echo json_encode(['status' => 'errorUser', 'message' => 'You cannot register a task without User for that Project.']);       
                }
                else
                {   
                        $task->editTask($id, $projectId, $description, $dueDate, $priority, $completed, $userId);
                        echo json_encode(['status' => 'success']);
                    
                }
            } catch (PDOException $e) {
                header('Content-Type: application/json'); 
                $error = ['status' => 'errorEdit', 'message' => $e->getMessage()];
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