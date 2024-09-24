<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

// Check if required keys exist
if (isset($data['ename'], $data['erole'], $data['ecity'], $data['estate'], $data['enumber'], $data['eemail'])) {
    
    include "config.php";

    $stmt = $conn->prepare("INSERT INTO employee (employee_name, role, city, state, number, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", 
        $data['ename'], 
        $data['erole'], 
        $data['ecity'], 
        $data['estate'], 
        $data['enumber'], 
        $data['eemail']
    );

    try {
        if ($stmt->execute()) {
            // Get the last inserted ID
            $lastId = $conn->insert_id;

            // Prepare a response with the inserted employee details
            $response = [
                'Code' => '200',
                'status' => 'successful',
                'employee' => [
                    'id' => $lastId,
                    'employee_name' => $data['ename'],
                    'role' => $data['erole'],
                    'city' => $data['ecity'],
                    'state' => $data['estate'],
                    'number' => $data['enumber'],
                    'email' => $data['eemail'],
                ]
            ];
            echo json_encode($response);
        }
    } catch (mysqli_sql_exception $e) {
        // Custom error handling for duplicate email
        if ($e->getCode() == 1062) { // MySQL error code for duplicate entry
            echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Email already exists.']);
        } else {
            echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'An error occurred.']);
        }
    }

    $stmt->close();
} else {
    echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Invalid input.']);
}

$conn->close();
?>
