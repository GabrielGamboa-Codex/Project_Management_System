<?php
include "connection.model.php";

class UsernameModel extends Database
{
    private $pdo;
    private $id;
    private $name;
    private $email;
    private $pass;
    private $team;
    

    
// Funciones para con el Getter traer el las variables
//y con el Setter darles un valor que se extrae por fuera con la clase
    public function __construct()
    {
            $this->pdo = Database::Connection();    
    }

    public function getUserid(){
        return $this->id;        
    }

    public function setUserid($id)
    {
        $this->id = $id;
    }
    
    public function getUsername(){
        return $this->name;        
    }

    public function setUsername($name)
    {
        $this->name = $name;
    }
    public function getUseremail(){
        return $this->email;        
    }

    public function setUseremail($email)
    {
        $this->email = $email;
    }
    public function getUserpass(){
        return $this->pass;        
    }

    public function setUserpass($pass)
    {
        $this->pass = $pass;
    }
    public function getUserteam(){
        return $this->team;        
    }

    public function setUserteam($team)
    {
        $this->id = $team;
    } 

    public function readUser()
    {
        $bean = R::find("users");
        foreach ($bean as $resultado) {
            //trae el id de la fila a buscar
            echo '<tr id="fila-' . $resultado->id . '">';
            echo '<td>' . $resultado->id . '</td>';
            //las clases para encontrar las filas
            echo '<td class="col-nombre">' . $resultado->username . '</td>';
            echo '<td class="col-descripcion">' . $resultado->email . '</td>';
            echo '<td class="col-estatus">' . $resultado->team_id . '</td>';
            echo '<td>' . $resultado->created_at . '</td>';
            echo '<td>' . $resultado->updated_at . '</td>';
            echo '<td><button type="submit" id="btn-actualizar" class="btn btn-warning btn-actualizar" data-bs-toggle="modal" data-bs-target="#modalTarea" data-id="' . $resultado->id . '">Editar Tarea <i class="bi bi-pencil-square"></i></button></td>';
            echo '<td><button data-bs-toggle="modal" data-bs-target="#modalEliminar" class="btn btn-danger eliminar" data-id="' . $resultado->id . '">Eliminar <i class="bi bi-trash"></i></button></td>';
            echo '</tr>';
        }
    }

}


