<link rel="stylesheet" href="public/css/css.css">
<body class="bg-body-tertiary">
    <br>
    <h3 class="text-center">Team List</h3>
    <br>
    <div id="message"></div>
    <div class="container">
        <!-- Button Crear nuevo Usuario-->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createTeammodal">
            <i class="bi bi-plus-circle-fill"></i> Create New Team
        </button>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="teamTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Team</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>id</th>
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





    <!-- Modal Crear Teams -->
    <div class="modal fade" id="createTeammodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createTeammodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createTeammodalLabel">Register a New Team</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="create_Team">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Team Name</p>
                            </label>
                            <input type="text" class="form-control" id="team_Name" name="team_Name" placeholder="Team Name" onkeypress="validation(event);" />
                            <div id="message1"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="registerTeam"><i class="bi bi-person-add"></i> Register</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x"></i>Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Editar Teams -->
    <div class="modal fade" id="editTeammodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTeammodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editTeammodalLabel">Team Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="edit_team">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Team Name</p>
                            </label>
                            <input type="text" class="form-control" id="edit_nameTeam" name="edit_nameTeam" placeholder="Name Team" onkeypress="validation(event);" />
                            <div id="messageEdit1"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_id">
                    <button type="submit" class="btn btn-warning" id="editTeamButton"><i class="bi bi-pencil-square"></i> Edit Team</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletemodal"><i class="bi bi-person-dash"></i> Delete Team</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                </div>
            </div>
        </div>
    </div>





    <!-- modal Para Confirmar la Eliminacion de un usuario-->
    <div class="modal fade" id="deletemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletemodalLabel">Delete Team</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="col-6 col-sm-12 col-md-12">
                    <div class="modal-body">
                        ¿Desea usted Eliminar Realmente el Team?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="deleteTeamButton" class="btn btn-danger"><i class="bi bi-person-fill-x"></i> Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include __DIR__ . '/../views/footer.php';
    ?>
    <script src="public/js/team.js"></script> 
