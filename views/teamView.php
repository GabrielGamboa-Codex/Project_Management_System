<link rel="stylesheet" href="public/css/css.css">
<body class="bg-body-tertiary">
    <br>
    <h3 class="text-center">Team List</h3>
    <br>
    <div id="message"></div>
    <div class="container">
        <!-- Button Crear nuevo Usuario-->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createTeamModal">
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
    <div class="modal fade" id="createTeamModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createTeamModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createTeamModalLabel">Register a New Team</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="createTeam">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Team Name</p>
                            </label>
                            <input type="text" class="form-control" id="teamName" name="teamName"   maxlength="50" placeholder="Team Name" onkeypress="validation(event);" />
                            <div id="message1"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="registerTeam"><i class="bi bi-person-add"></i> Register</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Editar Teams -->
    <div class="modal fade" id="editTeamModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTeamModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editTeamModalLabel">Team Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editTeam">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Team Name</p>
                            </label>
                            <input type="text" class="form-control" id="editNameTeam" name="editNameTeam" placeholder="Name Team"   maxlength="50" onkeypress="validation(event);" />
                            <div id="messageEdit1"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="editId">
                    <button type="submit" class="btn btn-warning" id="editTeamButton"><i class="bi bi-pencil-square"></i> Edit Team</button>
                    <button type="button" class="btn btn-danger"  id="deleteTeamButton"><i class="bi bi-person-dash"></i> Delete Team</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    include __DIR__ . '/../views/footer.php';
    ?>
    <script src="public/js/team.js"></script> 
