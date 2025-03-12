<?php
session_start();
require_once '../config/database.php'; // Ensure this file contains your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    $action = $_GET['action'];
    
    switch ($action) {
        case 'create':
            createDocumentRequest($conn);
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action.']);
            break;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

function createDocumentRequest($conn) {
    $student_id = $_SESSION['username'] ?? null;
    $last_name = $_SESSION['last_name'] ?? '';
    $first_name = $_SESSION['first_name'] ?? '';
    $middle_name = $_SESSION['middle_name'] ?? '';
    $program = $_SESSION['program'] ?? '';
    $year_level = $_SESSION['year_level'] ?? '';
    $document_type = trim($_POST['documentType'] ?? '');
    $remarks = trim($_POST['remarks'] ?? '');

    if (!$student_id || empty($document_type)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    $query = "INSERT INTO document_requests (student_id, last_name, first_name, middle_name, program, year_level, document_type, request_date, status) 
              VALUES ('$student_id', '$last_name', '$first_name', '$middle_name', '$program', '$year_level', '$document_type', NOW(), 'Pending')";

    if ($conn->query($query) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Document request submitted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to submit request.']);
    }
}