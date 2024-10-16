<?php
//Clase de Usuarios
class User{
    
    
    //Contructor Property Promotion
    public function __construct(public $username,public $email,public $password)
    {
        $this->username=$username;
        $this->email=$email;
        $this->password=$password;
    }

    public function Show()
    {
        echo "Hola Soy ". $this->username;
    }
}

$gabo = new User("Gabo","gg@ff.com","123");

$gabo -> Show();




?>