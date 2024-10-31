<?php
include __DIR__ ."/../config/database.php";
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model {

    protected $table = 'users';

    //funcion de crear usuarios
    public function createUser($userName,$email,$pass,$team_id)
    {
        $user = new UserModel();
        $date = date('Y-m-d H:i:s');
        
        //Hashear la contraseña
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $created = $date;
        $updated = $date;
        $user->username = $userName;
        $user->email = $email;
        $user->password=$hash;
        $user->team_id = $team_id;
        $user->created_at= $created;
        $user->updated_at= $updated;
        $user->save();
    }
    
    //funcion de editar usuarios
    public function editUser($id,$userName,$email,$pass,$team_id)
    {
        $user = new UserModel();
        $user = UserModel::find($id);
        $date = date('Y-m-d H:i:s');
        //Hashear la contraseña
        $hash = password_hash($pass, PASSWORD_DEFAULT);


        $updated = $date;
        $user->username = $userName;
        $user->email = $email;
        $user->password=$hash;
        $user->team_id = $team_id;
        $user->updated_at= $updated;
        $user->save();
    }

    //funcion de eliminar Usuarios
    public function deleteUser($id)
    {
        $user = new UserModel();
        $user = UserModel::find($id);
        $user->delete();
    }
    
}
?>
