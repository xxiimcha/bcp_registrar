<?php
include('../config/database.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'fetch_courses') {
    fetchCourses();
} elseif ($action == 'add_course') {
    addCourse();
}

function fetchCourses() {
    global $conn;
    $query = "SELECT * FROM courses";
    $result = mysqli_query($conn, $query);
    $courses = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }

    echo json_encode(["success" => true, "courses" => $courses]);
}

function addCourse() {
    global $conn;
    $courseCode = mysqli_real_escape_string($conn, $_POST['course_code']);
    $courseName = mysqli_real_escape_string($conn, $_POST['course_name']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);

    // Check if course code already exists
    $checkQuery = "SELECT * FROM courses WHERE course_code = '$courseCode'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo json_encode(["success" => false, "message" => "Course code already exists."]);
        return;
    }

    $query = "INSERT INTO courses (course_code, name, department, level) VALUES ('$courseCode', '$courseName', '$department', '$level')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(["success" => true, "message" => "Course added successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add course."]);
    }
}

?>
