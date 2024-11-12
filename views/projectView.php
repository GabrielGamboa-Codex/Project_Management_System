<link rel="stylesheet" href="public/css/css.css">
<body class="bg-body-tertiary">
    <br>
    <h3 class="text-center">Projects List</h3>
    <br>
    <div id="message"></div>
    <div class="container">
        <!-- Button Crear nuevo Project-->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createProjectmodal">
            <i class="bi bi-plus-circle-fill"></i> Create New Project
        </button>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="projectTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Team_id</th>
                                <th>Team</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Project Name</th>
                                <th>Description</th>
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





    <!-- Modal Crear Projectos -->
    <div class="modal fade" id="createProjectmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createProjectmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createProjectmodalLabel">Register a New Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="create_Project">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Project Name</p>
                            </label>
                            <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Name Project" onkeypress="validation(event);" />
                            <div id="message1"></div>
                        </div>
                        <br>
                        <div class="form-group"> 
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Description</p>
                            </label>
                            <textarea class="form-control" id="project_description" name="project_description"  placeholder="Description Project" rows="5" onkeypress="validation(event);"></textarea> 
                            <div id="message2"></div>
                        </div>                      
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Team</p>
                            </label>
                            <select class="form-select" id="project_team" aria-label="selectTeam">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="registerProject"><i class="bi bi-clipboard2-plus"></i> Create Project</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x"></i>Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Editar Project -->
    <div class="modal fade" id="editProjectmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProjectmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editProjectmodalLabel">Project Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="edit_Project">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Project Name</p>
                            </label>
                            <input type="text" class="form-control" id="edit_name_project" name="edit_name_project" placeholder="Name Project" onkeypress="validation(event);" />
                            <div id="messageEdit1"></div>
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
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Team</p>
                            </label>
                            <select class="form-select" id="project_team_edit" aria-label="selectTeam">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_id">
                    <button type="submit" class="btn btn-warning" id="editButtonProject"><i class="bi bi-pencil-square"></i> Edit Project</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-clipboard2-x"></i> Delete Project</button>
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
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="col-6 col-sm-12 col-md-12">
                    <div class="modal-body">
                        ¿Desea usted Eliminar Realmente el Projecto?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="deleteProject" class="btn btn-danger"><i class="bi bi-person-fill-x"></i> Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include __DIR__ . '/../views/footer.php';
    ?>
    <script src="public/js/project.js"></script>
</body>

</html>