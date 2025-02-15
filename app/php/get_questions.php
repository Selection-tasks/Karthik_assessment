<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 


$host = 'localhost';
$db = 'internship_portal';
$user = 'root';
$pass = '';

// Initialize an empty response array
$response = [
    'success' => false,
    'message' => '',
    'data' => []
];

try {
    
    $conn = new mysqli($host, $user, $pass, $db);

  
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM questions";
    $result = $conn->query($sql);

    
    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }

    
    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = [
            'id' => $row['id'], 
            'text' => $row['question_text'],
            'options' => explode(',', $row['options']) 
        ];
    }

    
    $conn->close();

    
    $response['success'] = true;
    $response['message'] = 'Questions fetched successfully.';
    $response['data'] = $questions;

} catch (Exception $e) {
    
    $response['message'] = $e->getMessage();
}


echo json_encode($response);
?>