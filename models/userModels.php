<?php
require './config/database.php';
class userModel extends Database{

    public $conn;
    public function readUsers() {
        $conn = new Database;
        $query = $conn->getConnection();
        $query = R::find("users",);
        return $query;
    }
}
?>
