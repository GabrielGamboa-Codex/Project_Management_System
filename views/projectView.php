<link rel="stylesheet" href="public/css/css.css">
<body class="bg-body-tertiary">
    <br>
    <h3 class="text-center">Projects List</h3>
    <br>
    <div id="message"></div>
    <div class="container">
        <!-- Button Crear nuevo Project-->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createProjectModal">
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




<!-- Modal Crear Proyectos -->
<div class="modal fade" id="createProjectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createProjectModalLabel">Register a New Project</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="createProject">
                    <br>
                    <div class="col-6 col-sm-12 col-md-12">
                        <label for="projectName" class="form-label">
                            <p class="fw-bold">Project Name</p>
                        </label>
                        <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Name Project" maxlength="50" />
                        <div id="message1"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="projectDescription" class="form-label">
                            <p class="fw-bold">Description</p>
                        </label>
                        <textarea class="form-control" id="projectDescription" name="projectDescription" placeholder="Description Project" maxlength="65535" rows="5"></textarea>
                        <div id="message2"></div>
                    </div>
                    <br>
                    <div class="col-6 col-sm-12 col-md-12">
                        <label for="projecTeam" class="form-label">
                            <p class="fw-bold">Select Team</p>
                        </label>
                        <select class="form-select" id="projecTeam" aria-label="selectTeam">
                        </select>
                        <div id="message3"></div>
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
    <div class="modal fade" id="editProjectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProjectModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editProjectModalLabel">Project Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editProject">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Project Name</p>
                            </label>
                            <input type="text" class="form-control" id="editNameProject" name="editNameProject"  maxlength="50" placeholder="Name Project" />
                            <div id="messageEdit1"></div>
                        </div>
                        <br>
                        <div class="form-group"> 
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Description</p>
                            </label>
                            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"   maxlength="65535" placeholder="Description Project" rows="5"></textarea> 
                            <div id="messageEdit2"></div>
                        </div>                      
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Team</p>
                            </label>
                            <select class="form-select" id="projecTeamEdit" aria-label="selectTeam">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="editId">
                    <button type="submit" class="btn btn-warning" id="editButtonProject"><i class="bi bi-pencil-square"></i> Edit Project</button>
                    <button type="button" class="btn btn-danger" id="deleteButtonProject"><i class="bi bi-clipboard-minus"></i> Delete Project</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include __DIR__ . '/../views/footer.php';
    ?>
    <script src="public/js/project.js" type="module"></script>
</body>

</html>