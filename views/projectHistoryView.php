<link rel="stylesheet" href="public/css/css.css">
<body class="bg-body-tertiary">
    <br>
    <h3 class="text-center">Project History</h3>
    <br>
    <div id="message"></div>
    <div class="container">

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
                                <th> 
                                    <select id="actionFilter">
                                        <option value="">All Action</option> 
                                        <option value="Create">Create</option> 
                                        <option value="Edit">Edit</option> 
                                        <option value="Delete">Delete</option> 
                                    </select>
                                </th>
                                </th>
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

    <?php
    include __DIR__ . '/../views/footer.php';
    ?>
    <script src="public/js/projectHistory.js"></script>
</body>