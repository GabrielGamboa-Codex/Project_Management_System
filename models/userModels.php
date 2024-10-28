<?php
require "../config/database.php";
require "teamModels.php";
use Illuminate\Database\Eloquent\Model;

class userModel extends Model {

    protected $table = 'users';

    //Funcion que instancia que team_id es una llave foranea
    public function foreignKey() {
        return $this->belongsTo(teamModels::class, 'team_id');
    }

    //funcion de crear usuarios
    public function createUser($username,$email,$pass,$team_id)
    {
        $user = new userModel();
        $date = date('Y-m-d H:i:s');
        
        //Hashear la contraseña
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $created = $date;
        $updated = $date;
        $user->username = $username;
        $user->email = $email;
        $user->password=$hash;
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
        //Hashear la contraseña
        $hash = password_hash($pass, PASSWORD_DEFAULT);


        $updated = $date;
        $user->username = $username;
        $user->email = $email;
        $user->password=$hash;
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
