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
    <div class="modal fade" id="createTaskmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createtaskmodal" aria-hidden="true">
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
                            <select class="form-select" id="projectTeam" aria-label="selectProject">
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Description</p>
                            </label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description" rows="5" onkeypress="validation(event);"></textarea>
                            <div id="message1"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="datepicker">
                                <p class="fw-bold">Date Due</p>
                            </label>
                            <input type="text" id="datepicker" class="form-control" placeholder="Insert a Date" onkeypress="validationPicker(event);">
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Priority</p>
                            </label>
                            <select class="form-select" id="priority" aria-label="selectProject">
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Task Status</p>
                            </label>
                            <select class="form-select" id="taskStatus" aria-label="selectProject">
                                <option value="true">Completed</option>
                                <option value="false">Pending</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Assigner User</p>
                            </label>
                            <select class="form-select" id="assignerUser" aria-label="selectProject">
                            </select>
                        </div>
                        <br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="registertask"><i class="bi bi-clipboard2-plus"></i>Register</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x"></i>Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Editar Tareas -->
    <div class="modal fade" id="editTaskmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edittaskmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edittaskmodalLabel">task Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="edit_task">
                        <br>
                        <!-- Selecciona de la base de Datos la Informacion -->
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Project</p>
                            </label>
                            <select class="form-select" id="projectTeamEdit" aria-label="selectProject">
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Description</p>
                            </label>
                            <textarea class="form-control" id="descriptionEdit" name="description" placeholder="Description" rows="5" onkeypress="validation(event);"></textarea>
                            <div id="messageEdit1"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="datepicker">
                                <p class="fw-bold">Date Due</p>
                            </label>
                            <input type="text" id="datepickerEdit" class="form-control" placeholder="Insert a Date" onkeypress="validationPicker(event);">
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Priority</p>
                            </label>
                            <select class="form-select" id="priorityEdit" aria-label="selectProject">
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Task Status</p>
                            </label>
                            <select class="form-select" id="taskStatusEdit" aria-label="selectProject">
                                <option value="true">Completed</option>
                                <option value="false">Pending</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Assigner User</p>
                            </label>
                            <select class="form-select" id="assignerUserEdit" aria-label="selectUser">
                            </select>
                        </div>
                        <br>
                    </form>
                </div>
                <br>
                </form>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="edit_id">
                <button type="submit" class="btn btn-warning" id="editButtonTask"><i class="bi bi-pencil-square"></i> Edit task</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-clipboard-minus"></i></i> Delete task</button>
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
                    <button type="submit" id="deleteTask" class="btn btn-danger"><i class="bi bi-clipboard2-x"></i> Delete</button>
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