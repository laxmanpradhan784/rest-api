<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');

$data = json_decode(file_get_contents("php://input"), true);

// Check if all required fields are set
if (isset($data['id'], $data['ename'], $data['erole'], $data['ecity'], 
          $data['estate'], $data['enumber'], $data['eemail'])) {
    
    include "config.php"; // Include database configuration

    // Prepare the SQL statement for updating
    $stmt = $conn->prepare("UPDATE employee SET employee_name = ?, role = ?, city = ?, state = ?, number = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", 
        $data['ename'], 
        $data['erole'], 
        $data['ecity'], 
        $data['estate'], 
        $data['enumber'], 
        $data['eemail'], 
        $data['id']
    );

    // Execute the statement and handle the result
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            // Fetch the updated record
            $stmt->close(); // Close the previous statement
            $stmt = $conn->prepare("SELECT * FROM employee WHERE id = ?");
            $stmt->bind_param("i", $data['id']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $updated_employee = $result->fetch_assoc();
                echo json_encode(['Code' => '200', 'status' => 'successful', 'message' => 'Employee updated.', 'updated_employee' => $updated_employee]);
            } else {
                echo json_encode(['Code' => '404', 'status' => 'unsuccessful', 'message' => 'Record not found.']);
            }
        } else {
            echo json_encode(['Code' => '404', 'status' => 'unsuccessful', 'message' => 'No record found to update.']);
        }
    } else {
        echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'An error occurred during update.']);
    }

    $stmt->close();
} else {
    echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Invalid input.']);
}

// Close the connection
$conn->close();
?>
