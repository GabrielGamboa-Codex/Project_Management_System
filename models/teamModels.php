<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;



class TeamModel extends Model
{

    protected $table = 'teams';

    public function printOptions()
    {
        $teamArr = array();
        $teams = TeamModel::all();

        foreach ($teams as $team) 
        {
            // Verificar si el status es true
            if ($team->status == true) {
                $teamArr[] = array(
                    "id" => $team->id,
                    "name" => $team->name,
                );
            }
        }
        //indexas el arreglo con el string data
        echo json_encode($teamArr);
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

     //funcion de crear Teams
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
 
     //funcion de editar Teams
     public function editTeam($id, $teamName)
     {
         try {
             $team = new TeamModel();
             $team = TeamModel::find($id);
             $date = date('Y-m-d H:i:s');

             $updated = $date;
             $team->name = $teamName;
             $team->updated_at = $updated;
             $team->status = true;
             $team->save();
         } catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }
 
     //funcion de eliminar Teams
     public function deleteTeam($id)
     {
         try {
             $team = new TeamModel();
             $team = TeamModel::find($id);
             $team->status = false;
             $team->save();
         } catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }
 }

