<link rel="stylesheet" href="public/css/css.css">
<body class="bg-body-tertiary">
    <br>
    <h3 class="text-center">Task List</h3>
    <br>
    <div id="message"></div>
    <div class="container">
        <!-- Button Crear nuevo Usuario-->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createtaskmodal">
            <i class="bi bi-plus-circle-fill"></i> Create New Task
        </button>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="taskTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Project</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Priority</th>
                                <th>Completed</th>
                                <th>Assigned User</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Project</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Priority</th>
                                <th>Completed</th>
                                <th>Assigned User</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>





    <!-- Modal Crear Tareas -->
    <div class="modal fade" id="createtaskmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createtaskmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createtaskmodalLabel">Register a New task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="create_task">
                        <br>
                        <!-- Selecciona de la base de Datos la Informacion -->
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Project</p>
                            </label>
                            <select class="form-select" id="project_team" aria-label="selectProject">
                            </select>
                        </div>
                        <br>
                        <div class="form-group"> 
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Description</p>
                            </label>
                            <textarea class="form-control" id="description_edit" name="description_edit"  placeholder="Description Project" rows="5" onkeypress="validation(event);"></textarea> 
                            <div id="messageEdit2"></div>
                        </div>      
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            
                            <label for="datepicker">
                            <p class="fw-bold">Select Date</p>
                            </label> 
                            <input type="text" id="datepicker" class="form-control">
                        
                        </div>
                        <br>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="registertask"><i class="bi bi-person-add"></i> Register</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x"></i>Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Editar Tareas -->
    <div class="modal fade" id="edittaskmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edittaskmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edittaskmodalLabel">task Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="edit_task">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">task Name</p>
                            </label>
                            <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Name task" onkeypress="validation(event);" />
                            <div id="messageEdit1"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Email</p>
                            </label>
                            <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="Example Email: 123@email.com" onkeypress="validation(event);" />
                            <div id="messageEdit2"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="datepicker">
                            <p class="fw-bold">Select Date</p>
                            </label> 
                            <input type="text" id="datepicker" class="form-control">
                        </div>
                        <br>

                        <!-- Selecciona de la base de Datos la Informacion -->
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Team</p>
                            </label>
                            <select class="form-select" id="team_edit" aria-label="selectTeam">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_id">
                    <button type="submit" class="btn btn-warning" id="editButton"><i class="bi bi-pencil-square"></i> Edit task</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-person-dash"></i> Delete task</button>
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
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete task</h1>
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
    <script src="public/js/task.js"></script>
</body>

</html>