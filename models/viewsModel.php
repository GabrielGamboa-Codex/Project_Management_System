<?php

    namespace models;

    class viewsModel{

        protected function obtainViewsModel($view)
        {
            //Define los valores de las vistas que se van a
            //reflejar en la URL 
            $whiteList = ['homeView'];

            //Nos permite verificafr el contenido de un array
            //si el nombre de la vista esta en la lista blanca
            //devuelve true
            if(in_array($view,$whiteList))
            {
                if(is_file("./views/".$view.".php"))
                {
                    $content ="./views/".$view.".php";
                }
                else
                {
                    $content ="404View";
                }
                
            }
            elseif($view == "usersView" || $view == "index")
            {
                $content="usersView";
            }
            else
            {
                $content ="404View";
            }
            return $content;
        }

    }

?>