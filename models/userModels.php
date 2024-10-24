<?php

require "../config/database.php";
use Illuminate\Database\Eloquent\Model;


class userModel extends Model {

    protected $table = 'users';

   

    //funcion de crear usuarios
    public function createUser($username,$email,$pass,$team_id)
    {
        $user = new userModel();
        $date = date('Y-m-d H:i:s');
        $created = $date;
        $updated = $date;
        $user->username = $username;
        $user->email = $email;
        $user->password=$pass;
        $user->team_id = $team_id;
        $user->created_at= $created;
        $user->updated_at= $updated;
        $user->save();
    }
    
    //funcion de editar usuarios
    public function editUser($id,$username,$email,$pass,$team_id)
    {
        $user = new userModel();
        $user = userModel::find($id);
        $date = date('Y-m-d H:i:s');
        $updated = $date;
        $user->username = $username;
        $user->email = $email;
        $user->password=$pass;
        $user->team_id = $team_id;
        $user->updated_at= $updated;
        $user->save();
    }

    //funcion de eliminar Usuarios
    public function deleteUser($id)
    {
        $user = new userModel();
        $user = userModel::find($id);
        $user->delete();
    }
}
?>
