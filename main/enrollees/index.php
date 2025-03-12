<?php include('../../partials/head.php'); ?>

<div id="wrapper">
    <?php include('../../partials/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('../../partials/nav.php'); ?>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Enrollment Management</h1>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pending Enrollments</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="enrollmentTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>LRN</th>
                                                <th>Name</th>
                                                <th>Course</th>
                                                <th>Year Level</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7" class="text-center">Loading data...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

<?php include('../../partials/modal.php'); ?>
<?php include('../../partials/foot.php'); ?>

<script>
    $(document).ready(function () {
        loadEnrollmentData();

        function loadEnrollmentData() {
            $.ajax({
                url: 'http://localhost/bcp_enrollment/api/enrollees.php?action=getAllEnrollees',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        let rows = '';

                        response.data.forEach(enrollee => {
                            rows += `<tr>
                                <td>${enrollee.id}</td>
                                <td>${enrollee.LRN}</td>
                                <td>${enrollee.first_name} ${enrollee.middle_name ? enrollee.middle_name : ''} ${enrollee.last_name}</td>
                                <td>${enrollee.course}</td>
                                <td>${enrollee.year_level}</td>
                                <td><span class="badge badge-warning">${enrollee.status}</span></td>
                                <td>
                                    <button class="btn btn-success btn-sm approve-btn" data-id="${enrollee.id}">Approve</button>
                                    <button class="btn btn-danger btn-sm reject-btn" data-id="${enrollee.id}">Reject</button>
                                </td>
                            </tr>`;
                        });

                        $('#enrollmentTable tbody').html(rows);
                    } else {
                        $('#enrollmentTable tbody').html('<tr><td colspan="7" class="text-center text-danger">No data available.</td></tr>');
                    }
                },
                error: function () {
                    $('#enrollmentTable tbody').html('<tr><td colspan="7" class="text-center text-danger">Failed to load data.</td></tr>');
                }
            });
        }
    });
</script>
