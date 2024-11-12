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
            $userArr = array();
            $users = UserModel::join('teams', 'users.team_id', '=', 'teams.id')
                ->select(
                    'users.id as userId',
                    'users.username',
                    'users.email',
                    'users.created_at',
                    'users.updated_at',
                    'users.status',
                    'teams.name',
                    'teams.id'
                )
                 ->where('users.status', true)
                 ->get();
    
            foreach ($users as $user) {
                $userArr[] = array(
                    "id" => $user->userId,
                    "username" => $user->username,
                    "email" => $user->email,
                    "team_id" => $user->id,
                    "team" => $user->name,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                    "status" => $user->status
                );
            }
            //indexas el arreglo con el string data
            echo json_encode(array("data" => $userArr));
        } catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
       
    }

    //funcion de crear usuarios
    public function createUser($userName, $email, $pass, $teamId)
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
            $user->team_id = $teamId;
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
    public function editUser($id, $userName, $email, $pass, $teamId)
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
            $user->team_id = $teamId;
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

