<?php
require_once __DIR__ . '/../models/projectModels.php';

class ProjectController
{
     
    public function indexProject()
    { 
            include 'views/header.php'; 
            include 'views/projectView.php'; 
        
    }

    //Funcion para guardar los datos en un arreglo e imprimirlo
    public function printTable()
    {
        $project = new ProjectModel();
        $project->printTable();
    }

    //envia los datos al modelo para crear un usuario
    public function createProject($projectName, $description, $teamId)
    {
        try {
            $Project = new ProjectModel();
            
            $patterndescription = '/^[a-zA-Z0-9\s.,;-]{4,}$/';
            $patternProject = '/^[a-zA-Z0-9\s]{4,}$/';

            if (!preg_match($patternProject, $projectName)) 
            {
                echo json_encode(['status' => 'errorProject', 'message' => 'The project name must contain numeric characters or letters and be at least 4 characters long.']);
            }
            elseif(!preg_match($patterndescription, $description))
            {
                if(!preg_match($patterndescription, $description))
                {
                    echo json_encode(['status' => 'errorDescription', 'message' => 'The description must contain at least 4 characters']);
                    
                }
            }
            else
            {
                    $Project->createProject($projectName, $description, $teamId);
    
                    echo json_encode(['status' => 'success']);
                
            }   
            
            //Pendiente por Revision 
        } catch (PDOException $e) {
            $error = ['status' => 'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }

    //envia los datos al modelo para editar un usuario
    public function editProject($id, $projectName, $description, $teamId)
    {


        try {
            $Project = new ProjectModel();
            $patterndescription = '/^[a-zA-Z0-9\s.,;-]{4,}$/';
            $patternProject = '/^[a-zA-Z0-9\s]{4,}$/';

            if (!preg_match($patternProject, $projectName)) 
            {
                echo json_encode(['status' => 'errorEditProject', 'message' => 'The project name must contain numeric characters or letters and be at least 4 characters long.']);
            }
            elseif(!preg_match($patterndescription, $description))
            {
                if(!preg_match($patterndescription, $description))
                {
                    echo json_encode(['status' => 'errorEditDescription', 'message' => 'The description must contain at least 4 characters']);
                    
                }
            }
            else
            {   
                    $Project->editProject($id, $projectName, $description, $teamId);
                    echo json_encode(['status' => 'success']);
                
            }
        } catch (PDOException $e) {
            $error = ['status' => 'ERRORedit', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }


    //envia los datos al modelo para editar un usuario
    public function deleteUse($id)
    {
        try {
            $Project = new ProjectModel();
            $Project->deleteProject($id);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            $error = ['status' => 'ERRORdelete', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }
}









?>