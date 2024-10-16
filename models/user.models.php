<?php

class UsernameModel
{
    
    public $id;
    public $name;
    public $email;
    public $pass;
    public $team;

    public function __construct()
    {
        include "../config/database/database.php";
    }

    public function insertUser($id, $name, $email, $pass, $team)
    {
        // Crear o actualizar
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $team = $_POST['team'];
    $date = date('Y-m-d H:i:s');


    if ($id) {
        $bean = R::load('users', $id);
    } else {
        $bean = R::dispense('users');
    }

            //Crear
            $bean->username = $name;
            $bean->email = $email;
            $bean->password= $pass;
            $bean->team_id= $team;
            $bean->updated_at = $date;
            $bean->created_at = $date;



            R::store($bean);
            return $bean;
    }

    
}



?>