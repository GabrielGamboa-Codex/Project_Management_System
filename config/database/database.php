<?php
include "rb.php";
class Database {
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = R::setup('mysql:host=localhost;dbname=db_project_management_system', 'root', '');
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
