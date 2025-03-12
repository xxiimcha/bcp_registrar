<?php include('../partials/head.php'); ?>

<div id="wrapper">
    <?php include('../partials/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('../partials/nav.php'); ?>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

                <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'registrar'): ?>
                <div class="row" id="dashboard-cards">
                    <!-- Enrollment Overview Card -->
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Total Enrollees</h5>
                                <p id="total-enrollees" class="h3 font-weight-bold text-primary">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enrollment List Table -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pending Enrollments</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="enrollmentTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>LRN</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Year Level</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6" class="text-center">Loading data...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php elseif ($_SESSION['role'] === 'student'): ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h5 class="card-title">My Enrollment Status</h5>
                                <p id="my-enrollment-status" class="h4 font-weight-bold text-info">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">My Document Requests</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="documentTable">
                                    <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Document Type</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="3" class="text-center">Loading data...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Registrar System 2025</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<?php include('../partials/modal.php'); ?>
<?php include('../partials/foot.php'); ?>

<script>
    $(document).ready(function () {
        <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'registrar'): ?>
        loadEnrollmentData();
        function loadEnrollmentData() {
            $.ajax({
                url: 'http://localhost/bcp_enrollment/api/enrollees.php?action=getAllEnrollees',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $('#total-enrollees').text(response.total);
                        let rows = '';
                        response.data.forEach(enrollee => {
                            rows += `<tr>
                                <td>${enrollee.id}</td>
                                <td>${enrollee.LRN}</td>
                                <td>${enrollee.first_name} ${enrollee.middle_name} ${enrollee.last_name}</td>
                                <td>${enrollee.course}</td>
                                <td>${enrollee.year_level}</td>
                                <td><span class="badge badge-warning">${enrollee.status}</span></td>
                            </tr>`;
                        });
                        $('#enrollmentTable tbody').html(rows);
                    } else {
                        $('#enrollmentTable tbody').html('<tr><td colspan="6" class="text-center text-danger">No data available.</td></tr>');
                    }
                },
                error: function () {
                    $('#total-enrollees').text('Error');
                    $('#enrollmentTable tbody').html('<tr><td colspan="6" class="text-center text-danger">Failed to load data.</td></tr>');
                }
            });
        }
        <?php elseif ($_SESSION['role'] === 'student'): ?>
        loadStudentEnrollmentStatus();
        loadDocumentRequests();
        function loadStudentEnrollmentStatus() {
            $.ajax({
                url: 'http://localhost/bcp_enrollment/api/enrollees.php?action=getStudentStatus&student_id=<?php echo $_SESSION['user_id']; ?>',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $('#my-enrollment-status').text(response.status);
                    } else {
                        $('#my-enrollment-status').text('No enrollment found.');
                    }
                },
                error: function () {
                    $('#my-enrollment-status').text('Failed to load status.');
                }
            });
        }

        function loadDocumentRequests() {
            $.ajax({
                url: 'http://localhost/bcp_enrollment/api/documents.php?action=getStudentRequests&student_id=<?php echo $_SESSION['user_id']; ?>',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let rows = '';
                    if (response.success) {
                        response.data.forEach(doc => {
                            rows += `<tr>
                                <td>${doc.request_id}</td>
                                <td>${doc.document_type}</td>
                                <td><span class="badge badge-warning">${doc.status}</span></td>
                            </tr>`;
                        });
                    } else {
                        rows = '<tr><td colspan="3" class="text-center text-danger">No document requests found.</td></tr>';
                    }
                    $('#documentTable tbody').html(rows);
                },
                error: function () {
                    $('#documentTable tbody').html('<tr><td colspan="3" class="text-center text-danger">Failed to load document requests.</td></tr>');
                }
            });
        }
        <?php endif; ?>
    });
</script>
