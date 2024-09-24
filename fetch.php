<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include "config.php"; // Include database configuration

// Prepare the SQL statement to fetch all records
$sql = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Fetch all records as an associative array
        $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode(['Code' => '200', 'status' => 'successful', 'employees' => $employees]);
    } else {
        echo json_encode(['Code' => '404', 'status' => 'unsuccessful', 'message' => 'No records found.']);
    }
} else {
    echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Database query failed.']);
}

$conn->close();
?>
