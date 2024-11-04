<?php
include __DIR__ . "/../config/database.php";

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{

    protected $table = 'users';

    //Define los atributos asignados de manera masiva
    protected $fillable = ['username', 'email', 'password', 'team_id', 'created_at', 'updated_at', 'status'];

    // aqui solo filtra aquellos usuarios que no hayan sido borrados logicamente
    //Dicho Modelo 
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('notDeleted', function ($builder) {
            $builder->where('status', true);
        });
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

        }  catch (PDOException $e) {
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
        }  catch (PDOException $e) {
            $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
            echo json_encode($error);
        }
    }
}
