<?php
require "../config/database.php";
use Illuminate\Database\Eloquent\Model;



class TeamModels extends Model {

    protected $table = 'teams';

    public function printOptions()
    {
        $team_arr = array();
        $teams = TeamModels::all();
        
        foreach ($teams as $team) {
            $team_arr[] = array(
                "id" => $team->id,
                "name" => $team->name,
                );
            }
            //indexas el arreglo con el string data
            echo json_encode($team_arr);
    }

}

?>