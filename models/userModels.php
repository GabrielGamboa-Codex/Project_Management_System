<?php
include __DIR__ . "/../config/database.php";

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{

    protected $table = 'users';

    //Define los atributos asignados de manera masiva
    protected $fillable = ['username', 'email', 'password', 'team_id', 'created_at', 'updated_at', 'status'];

    public function printTable()
    {
        try {
            $user_arr = array();
            $users = UserModel::join('teams', 'users.team_id', '=', 'teams.id')
                ->select(
                    'users.id as user_id',
                    'users.username as user_name',
                    'users.email as user_email',
                    'users.created_at as user_created',
                    'users.updated_at as user_updated',
                    'users.status as user_status',
                    'teams.name as team_name',
                    'teams.id as team_id'
                )
                 ->where('status', true)
                 ->get();
    
            foreach ($users as $user) {
                $user_arr[] = array(
                    "id" => $user->user_id,
                    "username" => $user->user_name,
                    "email" => $user->user_email,
                    "team_id" => $user->team_id,
                    "team" => $user->team_name,
                    "created_at" => $user->user_created,
                    "updated_at" => $user->user_updated,
                    "status" => $user->user_status
                );
            }
            //indexas el arreglo con el string data
            echo json_encode(array("data" => $user_arr));
        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
       
    }

    //funcion de crear usuarios
    public function createUser($userName, $email, $pass, $team_id)
    {
        try {
            $user = new UserModel();
            $date = date('Y-m-d H:i:s');

            //Hashear la contraseña
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $created = $date;
            $updated = $date;
            $user->username  = $userName;
            $user->email = $email;
            $user->password = $hash;
            $user->team_id = $team_id;
            $user->created_at = $created;
            $user->updated_at = $updated;
            $user->status = true;
            $user->save();
        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }

    //funcion de editar usuarios
    public function editUser($id, $userName, $email, $pass, $team_id)
    {
        try {
            $user = new UserModel();
            $user = UserModel::find($id);
            $date = date('Y-m-d H:i:s');
            //Hashear la contraseña
            $hash = password_hash($pass, PASSWORD_DEFAULT);


            $updated = $date;
            $user->username = $userName;
            $user->email = $email;
            $user->password = $hash;
            $user->team_id = $team_id;
            $user->updated_at = $updated;
            $user->status = true;
            $user->save();
        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }

    //funcion de eliminar Usuarios
    public function deleteUser($id)
    {
        try {
            $user = new UserModel();
            $user = UserModel::find($id);
            $user->status = false;
            $user->save();
        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }
}

