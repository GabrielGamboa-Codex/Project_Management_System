<?php

echo "Sola la vista principa del controlador de Inicio";
echo"<br>";


?>

<body>
    <br>
    <br>
    <div class="container text-center">
        <div class="row">
            <div class="col align-self-start">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createUsermodal">
                    Create New User
                </button>
            </div>
            <div class="col align-self-center">
                
            </div>
            <div class="col align-self-end">
                
            </div>
        </div>
    </div>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped" style="width:80%">
        <thead>
            <tr>
                <th>id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Team_id</th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
        </thead>
        <tbody id="userTable">
        </tbody>
        
        <tfoot>
            <tr>
            <th>id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Team_id</th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
        </tfoot>
    </table>
            </div>
        </div>
    </div>
</div>
<br>
<br>    