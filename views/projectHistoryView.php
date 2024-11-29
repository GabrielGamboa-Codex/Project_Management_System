<link rel="stylesheet" href="public/css/css.css">
<body class="bg-body-tertiary">
    <br>
    <h3 class="text-center">Project History</h3>
    <br>
    <div id="message"></div>
    <div class="container">
                    <!-- Button Filtrar un Registro-->
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#filterDataModal">
        <i class="bi bi-search"></i> Filtrar Registro
        </button>
        <button type="button" class="btn btn-primary" id="reloadTable">
        <i class="bi bi-arrow-clockwise"></i> Resetear Tabla
        </button>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="historyTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>id Project</th>
                                <th>Project Name</th>
                                <th>Actions</th>
                                <th>id User</th>
                                <th>User</th>
                                <th>Timestamp</th>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>id Project</th>
                                <th>Project Name</th>
                                <th>Action</th>
                                <th>id User</th>
                                <th>User</th>
                                <th>Timestamp</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Filtrar Registros -->
    <div class="modal fade" id="filterDataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="filterDataModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="filterDataModalLabel">Search a Register</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="searchData">
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Project Name</p>
                            </label>
                            <select class="form-select project" id="selectProject" aria-label="selectProject">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select Action</p>
                            </label>
                            <select class="form-select" id="selectAction" aria-label="selectAction">
                                    <option value="">Select</option>
                                    <option value="Create">Create</option> 
                                    <option value="Edit">Edit</option> 
                                    <option value="Delete">Delete</option> 
                            </select>
                        </div>
                        <br>
                        <div class="col-6 col-sm-12 col-md-12">
                            <label for="nombre" class="form-label">
                                <p class="fw-bold">Select User</p>
                            </label>
                            <select class="form-select" id="selectUser" aria-label="selectUser">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <br>
                        <!-- Selecciona de la base de Datos la Informacion -->
                        <div class="row"> 
                            <div class="col-6 col-sm-12 col-md-6"> 
                                <label for="startDate"> 
                                    <p class="fw-bold">Select Start Range Date</p> 
                                </label> 
                                <input type="text" id="startDate" class="form-control" placeholder="Insert a Start Date" onkeypress="validationPicker(event);"> 
                            </div> 
                            <div class="col-6 col-sm-12 col-md-6"> 
                                <label for="endDate"> 
                                    <p class="fw-bold">Select Range End Date</p> 
                                </label> 
                                <input type="text" id="endDate" class="form-control" placeholder="Insert an End Date" onkeypress="validationPicker(event);"> 
                            </div> 
                        </div>
                        <br>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="search"><i class="bi bi-search"></i> Search</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x"></i>Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include __DIR__ . '/../views/footer.php';
    ?>
    <script src="public/js/projectHistory.js" type="module"></script>
</body>