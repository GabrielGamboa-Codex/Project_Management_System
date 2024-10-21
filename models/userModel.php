<?php
namespace models;

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function leerUsuarios() {
        $query = R::find("users",);
        return $query;
    }
}
?>