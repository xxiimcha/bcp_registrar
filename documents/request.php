<?php include('../partials/head.php'); ?>

<div id="wrapper">
    <?php include('../partials/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('../partials/nav.php'); ?>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800 text-center">Request New Document</h1>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-header bg-primary text-white text-center">
                                <h5 class="m-0">Document Request Form</h5>
                            </div>
                            <div class="card-body p-4">
                                <form id="documentRequestForm">
                                    <div class="form-group">
                                        <label for="student_id" class="font-weight-bold">Student ID</label>
                                        <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $_SESSION['username']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="full_name" class="font-weight-bold">Full Name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $_SESSION['first_name'] . ' ' . $_SESSION['middle_name'] . ' ' . $_SESSION['last_name']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="program" class="font-weight-bold">Program</label>
                                        <input type="text" class="form-control" id="program" name="program" value="<?php echo $_SESSION['program']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="year_level" class="font-weight-bold">Year Level</label>
                                        <input type="text" class="form-control" id="year_level" name="year_level" value="<?php echo $_SESSION['year_level']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="documentType" class="font-weight-bold">Select Document</label>
                                        <select class="form-control" id="documentType" name="documentType" required>
                                            <option value="">-- Select Document --</option>
                                            <option value="Transcript of Records">Transcript of Records</option>
                                            <option value="Certificate of Enrollment">Certificate of Enrollment</option>
                                            <option value="Good Moral Certificate">Good Moral Certificate</option>
                                            <option value="Diploma Copy">Diploma Copy</option>
                                            <option value="Honorable Dismissal">Honorable Dismissal</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="remarks" class="font-weight-bold">Remarks (Optional)</label>
                                        <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder="Enter any additional request details..."></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg w-50">Submit Request</button>
                                    </div>
                                </form>
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

<?php include('../partials/modal.php'); ?>
<?php include('../partials/foot.php'); ?>

<script>
    $(document).ready(function () {
        $('#documentRequestForm').on('submit', function (event) {
            event.preventDefault();
            let formData = $(this).serialize();
            
            $.ajax({
                url: '../controllers/DocumentController.php?action=create',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert('Document request submitted successfully!');
                        window.location.href = 'dashboard.php';
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('Failed to submit request. Please try again.');
                }
            });
        });
    });
</script>
