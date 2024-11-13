<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project System Management </title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="public/css/loginCss.css">
</head>

<body>
    <form action="" id="formLogin" method="POST">

        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <img src="./public/img/logo.png" width="80" height="80" class="d-inline-block align-text-top">
                <h1>Project System Management</h1>
            </div>
            <hr>  
            <br>

            <div class="col-6 col-sm-8 col-md-12">
            <i class="bi bi-envelope-at-fill"></i> <label for="">Email</label>
                <input type="text" id="login_email" class="form-control" placeholder="Insert Email" onkeypress=" validation(event)">
                <div id="message1" class="message1"></div>
            </div>
            <br>

            <div class="col-8 col-sm-8 col-md-12 position-relative">
            <i class="bi bi-lock-fill"></i> <label for="">Password</label>
                <input type="password" id="login_pass" class="form-control" placeholder="Insert password" onkeypress="validation(event)">
                <i class="bi bi-eye-slash toggle-password position-absolute" id="icon"></i>
                <div id="message2" class="message2"></div>
            </div>
            <br>
            <div class="col-6 col-sm-8 col-md-12">
                <input type="text" id="codeValidate" class="hidden form-control" placeholder="Insert Code" onkeypress="validationCode(event)">
                <div id="message3"></div>
                <div id="countdown"></div>
            </div>
            <br>
            <button type="button" id="Btnlogin" class="btn btn-dark">Start Login</button>
    </form>



    <script src="public/js/jquery-3.7.1.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/js/login.js"></script>
</body>

</html>