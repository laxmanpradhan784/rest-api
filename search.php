<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST'); // Change to POST to accept JSON
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

include "config.php"; // Include database configuration

// Get the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Check if the search parameter is provided
if (isset($data['search'])) {
    $search = $data['search'];
    
    // Prepare the SQL statement for searching
    $sql = "SELECT * FROM employee WHERE id = ? OR employee_name LIKE ?";
    $stmt = $conn->prepare($sql);

    // Prepare the search parameters
    $like_search = '%' . $search . '%';
    $stmt->bind_param(is_numeric($search) ? "is" : "ss", $search, $like_search);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch matching records
    $employees = $result->fetch_all(MYSQLI_ASSOC);

    // Return the results
    if ($employees) {
        echo json_encode(['Code' => '200', 'status' => 'successful', 'employees' => $employees]);
    } else {
        echo json_encode(['Code' => '404', 'status' => 'unsuccessful', 'message' => 'No records found.']);
    }

    $stmt->close();
} else {
    echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Invalid input.']);
}

$conn->close();
?>
