<link rel="stylesheet" href="public/css/css.css">

<body class="bg-body-tertiary">
    <br>
    <h3 class="text-center">Task List</h3>
    <br>
    <div id="message"></div>
    <div class="container">
        <!-- Button Crear nuevo Tarea-->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createTaskModal">
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
                                <th>Project ID</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Priority</th> 
                                <th>Status</th>
                                <th>Assigned User ID</th>
                                <th>Assigned User</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Project</th>
                                <th>Project ID</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Priority</th>
                                <th>Completed</th>
                                <th>Assigned User ID</th>
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
    <div class="modal fade" id="createTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createTaskModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createTaskModalLabel">Register a New task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="createTask">
                        <br>
                        <!-- Selecciona de la base de Datos la Informacion -->
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Project</p>
                            </label>
                            <select class="form-select" id="projectTeam" aria-label="projectTeam">
                            </select>
                            <div id="message3"></div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Description</p>
                            </label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description"  maxlength="65535" rows="5"></textarea>
                            <div id="message1"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="datepicker">
                                <p class="fw-bold">Date Due</p>
                            </label>
                            <input type="text" id="datepicker" class="form-control" placeholder="Insert a Date">
                            <div id="message2"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Priority</p>
                            </label>
                            <select class="form-select" id="priority" aria-label="priority">
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
                            <select class="form-select" id="taskStatus" aria-label="taskStatus">
                                <option value="1">Completed</option>
                                <option value="0">Pending</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Assigner User</p>
                            </label>
                            <select class="form-select" id="assignerUser" aria-label="assignerUser">
                            </select>
                            <div id="message4"></div>
                        </div>
                        <br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="registerTask"><i class="bi bi-clipboard2-plus"></i>Register</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x"></i>Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Editar Tareas -->
    <div class="modal fade" id="editTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTaskModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editTaskModalLabel">task Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editTask">
                        <br>
                        <!-- Selecciona de la base de Datos la Informacion -->
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Project</p>
                            </label>
                            <select class="form-select" id="projectTeamEdit" aria-label="projectTeamEdit">
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Description</p>
                            </label>
                            <textarea class="form-control" id="descriptionEdit" name="description" placeholder="Description" rows="5"></textarea>
                            <div id="messageEdit1"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="datepicker">
                                <p class="fw-bold">Date Due</p>
                            </label>
                            <input type="text" id="datepickerEdit" class="form-control" placeholder="Insert a Date">
                            <div id="messageEdit2"></div>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Priority</p>
                            </label>
                            <select class="form-select" id="priorityEdit" aria-label="priorityEdit">
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
                            <select class="form-select" id="taskStatusEdit" aria-label="taskStatusEdit">
                                <option value="1">Completed</option>
                                <option value="0">Pending</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Assigner User</p>
                            </label>
                            <select class="form-select" id="assignerUserEdit" aria-label="selectUser">
                            </select>
                            <div id="messageEdit3"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <input type="hidden" id="editId">
                <button type="submit" class="btn btn-warning" id="editButtonTask"><i class="bi bi-pencil-square"></i> Edit task</button>
                <button type="button" class="btn btn-danger"  id="deleteButtonTask"><i class="bi bi-clipboard-minus"></i></i> Delete Task</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <?php
    include __DIR__ . '/../views/footer.php';
    ?>
    <script src="public/js/task.js" type="module"></script>
</body>

</html>