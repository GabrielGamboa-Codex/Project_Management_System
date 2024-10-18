<?php

class UserModel 
{
    private $pdo;
    private $id;
    private $name;
    private $email;
    private $pass;
    private $team;
    

    

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
    
    public  function showTable()
    {
        $result = R::find('users');      
        return $result;
    }
}



?>