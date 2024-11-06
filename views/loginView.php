<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management System</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="public/css/loginCss.css">
</head>

<body>
    <form action="" id="formLogin" method="POST">

        <h1><img src="./public/img/logo.png" width="40" height="40" class="d-inline-block align-text-top"> Project <img src="./public/img/logo.png" width="40" height="40" class="d-inline-block align-text-top">
            Management System</h1>
        <hr>
        <div class="col-6 col-sm-12 col-md-12">
            <i class="bi bi-envelope-at-fill"></i> <label for="">Email</label>
            <input type="text" id="login_email" name="login_email" placeholder="Insert Email" onkeypress="validation(event);">
            <div id="message1" class="message"></div>
        </div>

        <div class="col-6 col-sm-12 col-md-12">
            <i class="bi bi-lock-fill"></i> <label for="">Password</label>
            <input type="password" id="login_pass" name="login_pass" placeholder="Insert password" onkeypress="validation(event);">
            <i class="bi bi-eye-slash toggle-password"></i>
            <div id="message2" class="message"></div>
        </div>
        <br>
        <br>
        <button type="button" id="Btnlogin" class="btn btn-dark">Start Login</button>
    </form>


    <script src="public/js/jquery-3.7.1.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/js/login.js"></script>
</body>

</html>