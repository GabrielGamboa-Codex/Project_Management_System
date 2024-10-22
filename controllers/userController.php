<?php
include "./models/userModels.php";
class userController extends userModel
{
    function printTable()
    {
        $stmt = $this->readUsers();
        $user_arr = array();
        foreach ($stmt as $user) {
            $user_arr[] = array(
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "team_id" => $user->team_id,
                "created_at" => $user->created_at,
                "updated_at" => $user->updated_at
                );
            }
            return $user_arr;

    }
}


?>