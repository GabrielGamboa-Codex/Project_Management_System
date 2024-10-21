<?php
    namespace controllers;  
    use models\viewsModel;

    class viewsController extends viewsModel
    {
        public function obtainViewsController($view)
        {
            if($view!="")
            {
                $answer=$this->obtainViewsModel($view);
            }
            else
            {
                $answer="login";
            }
            return $answer;
        }
    }

?>