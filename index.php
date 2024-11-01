<?php
include "./controllers/userController.php";
include "./controllers/loginController.php";

// Registra una función de autoload. 
//Esto significa que si tratas de usar una clase que no ha sido incluida todavía, 
//esta función se encargará de buscar y cargar esa clase.
spl_autoload_register(function ($class) {
    //Convierte el nombre de la clase en una ruta de archivo. 
    //Reemplaza los separadores de espacio de nombres (\) 
    //con el separador de directorio (/).
    $path = str_replace('\\', '/', $class);
    //Directorio actual del script. Se utiliza para construir 
    //la ruta completa al archivo de la clase.
    $file = __DIR__ . '/../' . $path . '.php';
    //Comprueba si el archivo existe y, si es así, lo incluye.
    if (file_exists($file)) {
        require $file;
    }
});

$users = new userController;
$login = new loginController;

$action = isset($_GET['action']) ? $_GET['action'] : 'loginView';

switch ($action) {
    case 'loginView':
        $login->indexLogin();
        break;
        case 'userView':
            $viewUsers = $users->index();
            break;
        // Agrega más rutas aquí
    // default:
    //     include "views/header.php";
    //     include "views/footer.php";
    //     $viewController->loadView('404');
}
