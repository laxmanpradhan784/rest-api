<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['id'])) {
    echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'ID not provided.']);
    exit;
}

include "config.php";

// First, retrieve the employee details
$stmt = $conn->prepare("SELECT * FROM employee WHERE id = ?");
$stmt->bind_param("i", $data['id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['Code' => '404', 'status' => 'unsuccessful', 'message' => 'No record found with that ID.']);
    $stmt->close();
    $conn->close();
    exit;
}

// Fetch employee details
$employee = $result->fetch_assoc();

// Now delete the employee
$stmt = $conn->prepare("DELETE FROM employee WHERE id = ?");
$stmt->bind_param("i", $data['id']);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['Code' => '200', 'status' => 'successful', 'deleted_employee' => $employee]);
} else {
    echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Deletion failed.']);
}

$stmt->close();
$conn->close();
?>
