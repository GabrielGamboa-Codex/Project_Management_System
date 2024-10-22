<?php

include "controllers/userController.php";

$conn = new userController;
$show =$conn->printTable();

echo json_encode(array("data" => $show));

?>