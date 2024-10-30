<?php

require "./controllers/viewController.php";


class viewHandler { 

    function handler()
    {
        $viewController = new ViewController();
        //Variable que obtiene la ruta desde los parámetros de la URL. 
        //Por defecto, se carga la vista 'home'.
        $route = $_GET['action'] ?? 'userView';

        switch ($route) {
            case 'userView':
                include "./views/header.php";
                include "./views/footer.php";
                $viewController->loadView('userView');
                break;
            case 'teamView':
                include "./views/header.php";
                include "./views/footer.php";
                $viewController->loadView('teamView');
                break;
                // Agrega más rutas aquí
            default:
                include "views/header.php";
                include "views/footer.php";
                $viewController->loadView('404');
        }
    }
}
