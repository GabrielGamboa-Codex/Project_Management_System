<?php
  require_once "./autoload.php";
  require_once "config/database/database.php";
 
  //obtener el valor de una variable tipo get
  //llamado views la cual se inicializo en el htcasses

  if(isset($_GET['views']))
  {
    //parte en pedazos un estring mediante un caracter
        $url =explode("/",$_GET['views']);
  }
  else
  {
        $url= ['usersView'];
  }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Managetment System</title>
    <?php require_once "views/header.php"; ?>
</head>
<body>
    
<?php
//llamo al controlador
    use controllers\viewsController;
//instancio la clase
    $viewsController = new viewsController();
    //Guarda la Url de la vista
    $view =  $viewsController->obtainViewsController($url[0]);
    if($view == "usersView" || $view == "404")
    {
        require_once "./views/".$view.".php";
    }
    else
    {
        require_once $view; 
    }

    require_once "views/footer.php";
?>
</body>
</html>