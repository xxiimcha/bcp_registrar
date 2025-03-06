<?php
session_start();
require '../config/database.php'; // Database connection file

// Enable CORS to allow other systems to access this API
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validate input
    if (empty($username) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Username and password are required."]);
        exit;
    }

    // Hash the entered password with MD5
    $password = md5($password);

    if (!$conn) {
        echo json_encode(["status" => "error", "message" => "Database connection failed: " . mysqli_connect_error()]);
        exit;
    }

    // Prevent SQL injection (escaping input)
    $username = mysqli_real_escape_string($conn, $username);

    // Query to fetch user details
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user; // Store user session

        $student = null; // Default student data as null

        // If user is a student, fetch student details
        if ($user['role'] == 'Student' && !empty($user['student_id'])) {
            $student_query = "SELECT * FROM students WHERE student_id = " . $user['student_id'];
            $student_result = mysqli_query($conn, $student_query);
            $student = mysqli_fetch_assoc($student_result);

            $_SESSION['student'] = $student; // Store student session
        }

        echo json_encode(["status" => "success", "message" => "Login successful", "user" => $user, "student" => $student]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
    }

    // Close MySQL connection
    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
