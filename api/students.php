<?php
require '../config/database.php'; // Database connection file

// Enable CORS to allow external requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Check database connection
if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Database connection failed: " . mysqli_connect_error()]);
    exit;
}

// Query to fetch all students with the new section column
$query = "SELECT student_id, student_number, first_name, last_name, gender, birth_date, course, year_level, email, contact_number, section FROM students";
$result = mysqli_query($conn, $query);

$students = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }
    echo json_encode(["status" => "success", "students" => $students]);
} else {
    echo json_encode(["status" => "error", "message" => "No students found"]);
}

// Close database connection
mysqli_close($conn);
?>
