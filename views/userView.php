<link rel="stylesheet" href="public/css/css.css">
<body class="bg-body-tertiary">
    <br>
    <h3 class="text-center">User List</h3>
    <br>
    <div id="message"></div>
    <div class="container">
        <!-- Button Crear nuevo Usuario-->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="bi bi-plus-circle-fill"></i> Create New User
        </button>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="userTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Team_id</th>
                                <th>Team</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Team_id</th>
                                <th>Team</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>





    <!-- Modal Crear Usuarios -->
    <div class="modal fade" id="createUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createUserModalLabel">Register a New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="createUser">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">User Name</p>
                            </label>
                            <input type="text" class="form-control" id="userName" name="userName" placeholder="Name User"  maxlength="50"/>
                            <div id="message1"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Email</p>
                            </label>
                            <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Example Email: 123@email.com"  maxlength="100"/>
                            <div id="message2"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Password</p>
                            </label>
                            <input type="password" class="form-control" id="userPass" name="userPass"  maxlength="255" placeholder="Password"/>
                            <i class="bi bi-eye-slash toggle-password"></i>
                            <div id="message3"></div>
                        </div>
                        <br>
                        <!-- Selecciona de la base de Datos la Informacion -->
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Team</p>
                            </label>
                            <select class="form-select" id="selectTeam" aria-label="selectTeam">
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="registerUser"><i class="bi bi-person-add"></i> Register</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x"></i>Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Editar Usuarios -->
    <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUserModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUserModalLabel">User Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editUser">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">User Name</p>
                            </label>
                            <input type="text" class="form-control" id="editName" name="editName" placeholder="Name User" maxlength="50" onkeypress="validation(event);" />
                            <div id="messageEdit1"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Email</p>
                            </label>
                            <input type="email" class="form-control" id="editEmail" name="editEmail" placeholder="Example Email: 123@email.com"  maxlength="100" onkeypress="validation(event);" />
                            <div id="messageEdit2"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Password</p>
                            </label>
                            <input type="password" class="form-control" id="editPass" name="editPass"  maxlength="255" placeholder="Password" />
                            <i class="bi bi-eye-slash toggle-password2"></i>
                            <div id="messageEdit3"></div>
                        </div>
                        <br>

                        <!-- Selecciona de la base de Datos la Informacion -->
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Team</p>
                            </label>
                            <select class="form-select" id="teamEdit" aria-label="selectTeam">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="editId">
                    <button type="submit" class="btn btn-warning" id="editButton"><i class="bi bi-pencil-square"></i> Edit User</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-person-dash"></i> Delete User</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal Para Confirmar la Eliminacion de un usuario-->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="col-6 col-sm-12 col-md-12">
                    <div class="modal-body">
                        ¿Desea usted Eliminar Realmente el Usuario?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="deleteButton" class="btn btn-danger"><i class="bi bi-person-fill-x"></i> Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include __DIR__ . '/../views/footer.php';
    ?>
    <script src="public/js/users.js" type="module"></script>
</body>

</html>