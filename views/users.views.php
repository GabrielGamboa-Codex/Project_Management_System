
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
            <table id="UserTable" class="table table-bordered table-striped" style="width:80%">
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
        <tbody id=""></tbody>
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
<button id="" class="achu">AAAAAA</button>  

    <!-- Modal -->
    <div class="modal fade" id="createUsermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUsermodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createUsermodalLabel">Register a New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="create_user">
                        <br>
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">User Name</p>
                        </label>
                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Name User" onkeypress="validation(event);" />
                        <br>
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">Email</p>
                        </label>
                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Example Email: 123@email.com" onkeypress="validation(event);" />
                        <br>
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">Password</p>
                        </label>
                        <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Password" onkeypress="validation(event);" />
                        <br>

                        <!-- Selecciona de la base de Datos la Informacion -->
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">Select Team</p>
                        </label>
                        <select class="form-select" id="user_team" aria-label="selectTeam">
                       
                        </select>


                    </form>
                </div>
                <div class="modal-footer">
                <input type="hidden" id="id">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="registerUser">Register</button>
                </div>
            </div>
        </div>
    </div>
    



<script src="public/js/jquery-3.7.1.min.js"></script>
<script src="public/bootstrap/js/bootstrap.min.js"></script>
<script src="public/datatable/datatables.min.js"></script>
<script src="public/datatable/dataTables.bootstrap5.js"></script>
<script src="public/js/users.js"></script>

</body>

</html>