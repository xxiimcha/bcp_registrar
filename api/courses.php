<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

include('../config/database.php');

$query = "SELECT id, course_code, name, department FROM courses";
$result = mysqli_query($conn, $query);

if ($result) {
    $courses = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
    echo json_encode(["success" => true, "courses" => $courses]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to retrieve courses"]);
}
?>
