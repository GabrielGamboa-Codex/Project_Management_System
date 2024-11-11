<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-6">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project System Management</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="public/css/loginCss.css">
</head>

<body>
    <form action="" id="formLogin" method="POST">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-auto me-auto"><img src="./public/img/logo.png" width="70" height="70" class="d-inline-block align-text-top"></div>
                <div class="col-9">
                    <h1> Project System Management</h1>
                </div>
            </div>
        </div>
        <hr>
       <br>
        <div class="col-6 col-sm-12 col-md-12">
        <p class="text-start"><i class="bi bi-envelope-at-fill fs-5"></i> Email</p>
            <div class="input-group mb-8">
                <input type="text" class="form-control" id="login_email" name="login_email" placeholder="Insert Email" onkeypress="validation(event);" aria-describedby="inputGroup-sizing-default">
            </div>
            <div id="message1" class="message"></div>
        </div>
        <br>
        <div class="col-6 col-sm-12 col-md-12">
        <p class="text-start"><i class="bi bi-lock-fill fs-5"></i> Password</p>
            <div class="input-group mb-6">
                <input type="password" class="form-control" id="login_pass" name="login_pass" placeholder="Insert password" onkeypress="validation(event);" >
                <i class="bi bi-eye-slash toggle-password"></i>
            </div>
            <div id="message2" class="message"></div>
        </div>
        <br>
        <button type="button" id="Btnlogin" class="btn btn-success">Start Login</button>
    </form>


    <script src="public/js/jquery-3.7.1.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/login.js"></script>
</body>

</html>