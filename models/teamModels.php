<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;



class TeamModel extends Model
{

    protected $table = 'teams';

    public function printOptions()
    {
        $team_arr = array();
        $teams = TeamModel::all();

        foreach ($teams as $team) 
        {
            $team_arr[] = array(
                "id" => $team->id,
                "name" => $team->name,
            );
        }
        //indexas el arreglo con el string data
        echo json_encode($team_arr);
    }

    public function printTable()
    {
        try {
            $teamArr = array();
            $teams = TeamModel::where('status', true)
            ->get();
    
            foreach ($teams as $team) {
                $teamArr[] = array(
                    "id" => $team->id,
                    "name" => $team->name,
                    "created_at" => $team->created_at,
                    "updated_at" => $team->updated_at,
                    "status"=> $team->status,
                );
            }
            //indexas el arreglo con el string data
            echo json_encode(array("data" => $teamArr));
        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
       
    }

     //funcion de crear usuarios
     public function createTeam($teamName)
     {
         try {
             $team = new TeamModel();
             $date = date('Y-m-d H:i:s');
 
             $created = $date;
             $updated = $date;
             $team->name  = $teamName;
             $team->created_at = $created;
             $team->updated_at = $updated;
             $team->status = true;
             $team->save();
         } catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }
 
     //funcion de editar usuarios
     public function editTeam($id, $TeamName)
     {
         try {
             $team = new TeamModel();
             $team = TeamModel::find($id);
             $date = date('Y-m-d H:i:s');

             $updated = $date;
             $team->name = $TeamName;
             $team->updated_at = $updated;
             $team->status = true;
             $team->save();
         } catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }
 
     //funcion de eliminar Usuarios
     public function deleteTeam($id)
     {
         try {
             $Team = new TeamModel();
             $Team = TeamModel::find($id);
             $Team->status = false;
             $Team->save();
         } catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }
 }

