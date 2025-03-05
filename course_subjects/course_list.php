<?php include('../partials/head.php'); ?>

<div id="wrapper">
    <?php include('../partials/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('../partials/nav.php'); ?>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Course List</h1>

                <!-- Course List Table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Course Records</h6>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCourseModal">
                            <i class="fas fa-plus"></i> Add Course
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="courseTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Course ID</th>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Department</th>
                                        <th>Level</th>
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

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Add New Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCourseForm">
                    <div class="form-group">
                        <label for="courseCode">Course Code</label>
                        <input type="text" class="form-control" id="courseCode" name="course_code" required>
                    </div>
                    <div class="form-group">
                        <label for="courseName">Course Name</label>
                        <input type="text" class="form-control" id="courseName" name="course_name" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" id="department" name="department" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" id="level" name="level" required>
                            <option value="College">College</option>
                            <option value="Senior High School">Senior High School</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTables Scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        function loadCourseData() {
            $.ajax({
                url: '../controllers/CourseController.php?action=fetch_courses',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var rows = "";
                        $.each(response.courses, function (index, course) {
                            rows += "<tr>" +
                                "<td>" + course.id + "</td>" +
                                "<td>" + course.course_code + "</td>" +
                                "<td>" + course.name + "</td>" +
                                "<td>" + course.department + "</td>" +
                                "<td>" + course.level + "</td>" +
                                "<td><a href='edit_course.php?id=" + course.id + "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a> " +
                                "<button class='btn btn-danger btn-sm delete-course' data-id='" + course.id + "'><i class='fas fa-trash'></i> Delete</button></td>" +
                                "</tr>";
                        });

                        $("#courseTable tbody").html(rows);
                        $("#courseTable").DataTable();
                    } else {
                        $("#courseTable tbody").html("<tr><td colspan='6' class='text-center text-danger'>No records found.</td></tr>");
                    }
                },
                error: function () {
                    $("#courseTable tbody").html("<tr><td colspan='6' class='text-center text-danger'>Error fetching data.</td></tr>");
                }
            });
        }

        // Load courses on page load
        loadCourseData();

        // Add Course via AJAX
        $("#addCourseForm").submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '../controllers/CourseController.php?action=add_course',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        $("#addCourseModal").modal('hide');
                        $("#addCourseForm")[0].reset();
                        loadCourseData();
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>
