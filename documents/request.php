<?php include('../partials/head.php'); ?>

<div id="wrapper">
    <?php include('../partials/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('../partials/nav.php'); ?>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Request New Document</h1>

                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Document Request Form</h6>
                            </div>
                            <div class="card-body">
                                <form id="documentRequestForm">
                                    <div class="form-group">
                                        <label for="documentType">Select Document</label>
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
                                        <label for="remarks">Remarks (Optional)</label>
                                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
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
