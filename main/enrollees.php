<?php include('../partials/head.php'); ?>

<div id="wrapper">
    <?php include('../partials/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('../partials/nav.php'); ?>

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

<!-- View Enrollee Modal -->
<div class="modal fade" id="viewEnrolleeModal" tabindex="-1" role="dialog" aria-labelledby="viewEnrolleeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewEnrolleeLabel"><i class="fas fa-user-graduate"></i> Enrollee Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <!-- Personal Information -->
                        <div class="col-md-6">
                            <h6 class="text-primary">Personal Information</h6>
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" class="form-control" id="enrollee-id" disabled>
                            </div>
                            <div class="form-group">
                                <label>LRN</label>
                                <input type="text" class="form-control" id="enrollee-lrn" disabled>
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" id="enrollee-name" disabled>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="enrollee-email" disabled>
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" id="enrollee-contact" disabled>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="col-md-6">
                            <h6 class="text-primary">Academic Information</h6>
                            <div class="form-group">
                                <label>Course</label>
                                <input type="text" class="form-control" id="enrollee-course" disabled>
                            </div>
                            <div class="form-group">
                                <label>Year Level</label>
                                <input type="text" class="form-control" id="enrollee-year-level" disabled>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" id="enrollee-status" disabled>
                            </div>
                            <div class="form-group">
                                <label>Primary School</label>
                                <input type="text" class="form-control" id="enrollee-primary-school" disabled>
                            </div>
                            <div class="form-group">
                                <label>Secondary School</label>
                                <input type="text" class="form-control" id="enrollee-secondary-school" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Guardian Information -->
                    <h6 class="text-primary mt-3">Guardian Information</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Guardian Name</label>
                                <input type="text" class="form-control" id="enrollee-guardian" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Guardian Contact</label>
                                <input type="text" class="form-control" id="enrollee-guardian-contact" disabled>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../partials/modal.php'); ?>
<?php include('../partials/foot.php'); ?>

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
                                    <button class="btn btn-info btn-sm view-btn" data-id="${enrollee.id}">View</button>
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
        
        $(document).on('click', '.view-btn', function () {
            let enrolleeId = $(this).data('id');

            $.ajax({
                url: `http://localhost/bcp_enrollment/api/enrollees.php?action=getEnrollee&id=${enrolleeId}`,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        let enrollee = response.data;

                        // Populate modal inputs
                        $('#enrollee-id').val(enrollee.id);
                        $('#enrollee-lrn').val(enrollee.LRN);
                        $('#enrollee-name').val(`${enrollee.first_name} ${enrollee.middle_name ? enrollee.middle_name : ''} ${enrollee.last_name}`);
                        $('#enrollee-email').val(enrollee.email);
                        $('#enrollee-contact').val(enrollee.contact_number);
                        $('#enrollee-course').val(enrollee.course);
                        $('#enrollee-year-level').val(enrollee.year_level);
                        $('#enrollee-status').val(enrollee.status);
                        $('#enrollee-primary-school').val(enrollee.primary_school);
                        $('#enrollee-secondary-school').val(enrollee.secondary_school);
                        $('#enrollee-guardian').val(`${enrollee.guardian_first_name} ${enrollee.guardian_last_name}`);
                        $('#enrollee-guardian-contact').val(enrollee.guardian_contact);

                        // Show modal
                        $('#viewEnrolleeModal').modal('show');
                    } else {
                        alert('Failed to load enrollee details.');
                    }
                },
                error: function () {
                    alert('Error retrieving enrollee details.');
                }
            });
        });

    });
</script>
