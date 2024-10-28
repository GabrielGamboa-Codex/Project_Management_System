<?php
//Carga la vistas
class ViewController {
    //viewName: Nombre de la vista que deseas cargar.
    //data: Array de datos que deseas pasar a la vista.
    public function loadView($viewName, $data = []) {
        //extract: Convierte los elementos del array 
        //$data en variables individuales.
        extract($data);
        
        include __DIR__ . '/../views/' . $viewName . '.php';
    }
}
?>