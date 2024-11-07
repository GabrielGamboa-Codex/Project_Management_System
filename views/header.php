<?php
session_start();
if (!isset($_SESSION['user_id'])) 
{ 
header('Location: index.php'); 
exit(); 
}

?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Parte del Header -->
  <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/bootstrap-icons/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="public/datatable/datatables.min.css">
  <link rel="stylesheet" href="public/datatable/dataTables.bootstrap5.css">
</head>

<body>

  <!-- Barra de Navegacion-->


  <nav class="navbar navbar-expand-lg bg-warning bg-opacity-75">
    <div class="container-fluid">
        <a class="navbar-brand" href="">
            <img src="public/img/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Project System Management
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=userView">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=teamView">Team</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> <?php echo $_SESSION['username']?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="index.php?action=logOut">Close Session</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


  