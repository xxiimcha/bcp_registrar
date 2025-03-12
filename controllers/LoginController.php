<?php
session_start();
require_once '../config/database.php'; // Ensure this file contains your DB connection

function validateInput($studentNumber, $password) {
    switch (true) {
        case empty($studentNumber) || empty($password):
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            exit;
    }
}

function authenticateStudent($conn, $studentNumber, $password) {
    $studentNumber = $conn->real_escape_string($studentNumber);
    $query = "SELECT id, username, password, role FROM users WHERE username = '$studentNumber' AND status = 1";
    $result = $conn->query($query);

    switch ($result->num_rows) {
        case 1:
            $user = $result->fetch_assoc();
            switch ($user['role']) {
                case 'student':
                    switch (hash('sha256', $password) === $user['password']) {
                        case true:
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['username'] = $user['username'];
                            $_SESSION['role'] = 'student';
                            echo json_encode(['status' => 'success', 'redirect' => 'common/dashboard.php']);
                            break;
                        default:
                            echo json_encode(['status' => 'error', 'message' => 'Invalid password.']);
                            break;
                    }
                    break;
                default:
                    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
                    break;
            }
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid student number or account not found.']);
            break;
    }
}

function authenticateUser($conn, $username, $password, $role) {
    $username = $conn->real_escape_string($username);
    $query = "SELECT id, username, password, role FROM users WHERE username = '$username' AND role = '$role' AND status = 1";
    $result = $conn->query($query);

    switch ($result->num_rows) {
        case 1:
            $user = $result->fetch_assoc();
            switch (hash('sha256', $password) === $user['password']) {
                case true:
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $redirect = ($user['role'] === 'admin') ? '../common/dashboard.php' : 'common/dashboard.php';
                    echo json_encode(['status' => 'success', 'redirect' => $redirect]);
                    break;
                default:
                    echo json_encode(['status' => 'error', 'message' => 'Invalid password.']);
                    break;
            }
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid credentials or account not found.']);
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'student':
            $username = trim($_POST['studentNumber'] ?? '');
            $password = trim($_POST['password'] ?? '');
            validateInput($username, $password);
            authenticateUser($conn, $username, $password, 'student');
            break;

        case 'admin':
            $username = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            validateInput($username, $password);
            authenticateUser($conn, $username, $password, 'admin');
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
            break;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}