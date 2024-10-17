<?php
//Clase de Usuarios
include '../models/user.models.php';

// Crear o actualizar
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$team = $_POST['team'];
$date = date('Y-m-d H:i:s');

$user = new UsernameModel;






?>