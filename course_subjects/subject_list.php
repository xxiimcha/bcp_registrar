<?php include('../partials/head.php'); ?>

<div id="wrapper">
    <?php include('../partials/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('../partials/nav.php'); ?>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Subject List</h1>

                <!-- Subject List Table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Subject Records</h6>
                        <a href="add_subject.php" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Subject
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="subjectTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Subject ID</th>
                                        <th>Subject Name</th>
                                        <th>Course</th>
                                        <th>Units</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded dynamically via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2025</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<?php include('../partials/modal.php'); ?>
<?php include('../partials/foot.php'); ?>

<!-- DataTables Scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        function loadSubjectData() {
            $.ajax({
                url: '../controllers/SubjectController.php?action=fetch_subjects',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var rows = "";
                        $.each(response.subjects, function (index, subject) {
                            rows += "<tr>" +
                                "<td>" + subject.id + "</td>" +
                                "<td>" + subject.name + "</td>" +
                                "<td>" + subject.course + "</td>" +
                                "<td>" + subject.units + "</td>" +
                                "<td><a href='edit_subject.php?id=" + subject.id + "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a> " +
                                "<button class='btn btn-danger btn-sm delete-subject' data-id='" + subject.id + "'><i class='fas fa-trash'></i> Delete</button></td>" +
                                "</tr>";
                        });

                        $("#subjectTable tbody").html(rows);
                        $("#subjectTable").DataTable();
                    } else {
                        $("#subjectTable tbody").html("<tr><td colspan='5' class='text-center text-danger'>No records found.</td></tr>");
                    }
                },
                error: function () {
                    $("#subjectTable tbody").html("<tr><td colspan='5' class='text-center text-danger'>Error fetching data.</td></tr>");
                }
            });
        }

        // Load subjects on page load
        loadSubjectData();
    });
</script>
