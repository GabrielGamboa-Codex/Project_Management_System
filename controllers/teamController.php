<?php
include __DIR__ . '/../models/teamModels.php';

class TeamController
{
    public function indexTeam()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/teamView.php';
        return;
    }

    //Funcion para guardar los datos en un arreglo e imprimirlo
    public function printTable()
    {
        $team = new TeamModel();
        $team->printTable();
    }

    //envia los datos al modelo para crear un usuario
    public function createTeam($teamName)
    {
        try {
            $Team = new TeamModel();

            //comprueba que los valores existan y guarda la informacion en una variable
            $teamExist = TeamModel::where('name', $teamName)->exists();
            
            $patternTeam = '/^[a-zA-Z0-9\s]{4,}$/';

            if (!preg_match($patternTeam, $teamName)) 
            {
                echo json_encode(['status' => 'errorTeam', 'message' => 'The field cannot be empty and must contain at least 4 characters.']);
            }
            else
            {
                if ($teamExist) 
                {
                    echo json_encode(['status' => 'errorTeam', 'message' => 'The Team is already registered.']);
                } 
                else 
                {
                    $Team->createTeam($teamName);
    
                    echo json_encode(['status' => 'success']);
                }
            }   
            
            //Pendiente por Revision 
        } catch (PDOException $e) {
            $error = ['status' => 'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }

    //envia los datos al modelo para editar un usuario
    public function editTeam($id, $teamName)
    {


        try {
            $team = new teamModel();
            //comprueba que los valores existan y guarda la informacion en una variable
            $teamFind = teamModel::where('name', $teamName)
                ->where('id', '!=', $id)
                ->exists();

            $patternTeam = '/^[a-zA-Z0-9\s]{4,}$/';

            if (!preg_match($patternTeam, $teamName)) 
            {
                echo json_encode(['status' => 'errorEditTeam', 'message' => 'The field cannot be empty and must contain at least 4 characters.']);
            }
            else
            {
                if ($teamFind == true) 
                {
                    echo json_encode(['status' => 'errorEditTeam', 'message' => 'The Team is already registered.']);
                } 
                else 
                {
                    
                    $team->editTeam($id, $teamName);
                    echo json_encode(['status' => 'success']);
                }
            }
        } catch (PDOException $e) {
            $error = ['status' => 'errorEdit', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }


    //envia los datos al modelo para editar un usuario
    public function deleteTeam($id)
    {
        try {
            $team = new TeamModel();
            $team->deleteTeam($id);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            $error = ['status' => 'errorDelete', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }
}
