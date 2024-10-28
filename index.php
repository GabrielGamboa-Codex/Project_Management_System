<?php
include "controllers/viewController.php";

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

$viewController = new ViewController();
//Variable que obtiene la ruta desde los parámetros de la URL. 
//Por defecto, se carga la vista 'home'.
$route = $_GET['route'] ?? 'userView';

switch ($route) {
    case 'userView':
        include "./views/header.php";
        include "./views/footer.php";
        $viewController->loadView('userView');
        break;
    // Agrega más rutas aquí
    default:
        include "views/header.php";
        include "views/footer.php";
        $viewController->loadView('404');

}



?>