<body class="bg-body-tertiary">
    <br>
        <h3 class="text-center">User List</h3>
    <br>
        <div class="container">
            <!-- Button Crear nuevo Usuario-->
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createUsermodal">
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
                                <th>Created_at</th>
                                <th>Updated_at</th>
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

    <!-- Modal Crear Usuarios -->
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
                        <div id="message1"></div>
                        <br>
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">Email</p>
                        </label>
                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Example Email: 123@email.com" onkeypress="validation(event);" />
                        <div id="message2"></div>
                        <br>
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">Password</p>
                        </label>
                        <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Password" onkeypress="validation(event);" />
                        <div id="message3"></div>
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
                    <button type="submit" class="btn btn-success" id="registerUser"><i class="bi bi-person-add"></i> Register</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x"></i>Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Editar Usuarios -->
    <div class="modal fade" id="editUsermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUsermodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUsermodalLabel">User Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="edit_user">
                        <br>
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">User Name</p>
                        </label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Name User" onkeypress="validation(event);" />
                        <div id="messageEdit1"></div>
                        <br>
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">Email</p>
                        </label>
                        <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="Example Email: 123@email.com" onkeypress="validation(event);" />
                        <div id="messageEdit2"></div>
                        <br>
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">Password</p>
                        </label>
                        <input type="password" class="form-control" id="edit_pass" name="edit_pass" placeholder="Password" onkeypress="validation(event);" />
                        <div id="messageEdit3"></div>
                        <br>

                        <!-- Selecciona de la base de Datos la Informacion -->
                        <label for="nombre" class="form-label">
                            <p class="fw-bold">Select Team</p>
                        </label>
                        <select class="form-select" id="team_edit" aria-label="selectTeam">
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_id">
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
                <div class="modal-body">
                    ¿Desea usted Eliminar Realmente el Usuario?
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
    <script src="public/js/users.js"></script>
</body>

</html>