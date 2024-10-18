<?php


class Database
{
    public $conection;

    public static function Connection()
    {
        try {
            $conection = R::setup('mysql:host=localhost;dbname=db_project_management_system', 'root', '');
        } catch (PDOException $e) {
            echo $e . "No me conecte";
        }
        ;
    }

}
