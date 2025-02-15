<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


header('Content-Type: application/json');


$host = 'db'; 
$db = 'internship_portal';
$user = 'user';
$pass = 'password';


$response = [
    'success' => false,
    'message' => '',
    'data' => []
];

try {
    
    $requiredFields = ['fullName', 'email', 'mobile', 'qualification', 'graduationYear', 'about', 'resume'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field]) || ($_FILES['resume']['error'] !== UPLOAD_ERR_OK && $field === 'resume')) {
            throw new Exception("Missing or invalid input: $field");
        }
    }

    
    $fullName = htmlspecialchars(trim($_POST['fullName']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    if (!$email) {
        throw new Exception("Invalid email address.");
    }
    $mobile = preg_replace('/[^0-9]/', '', trim($_POST['mobile'])); 
    $qualification = htmlspecialchars(trim($_POST['qualification']));
    $graduationYear = intval($_POST['graduationYear']);
    $about = htmlspecialchars(trim($_POST['about']));
    $certifications = htmlspecialchars(trim($_POST['certifications'] ?? ''));
    $projects = htmlspecialchars(trim($_POST['projects'] ?? ''));
    $skills = htmlspecialchars(trim($_POST['skills'] ?? ''));
    $software = htmlspecialchars(trim($_POST['software'] ?? ''));
    $experience = intval($_POST['experience']);
    $softSkills = htmlspecialchars(trim($_POST['softSkills'] ?? ''));

    
    $targetDir = "../uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); 
    }
    $resumeName = basename($_FILES["resume"]["name"]);
    $resumePath = $targetDir . $resumeName;

    if (!move_uploaded_file($_FILES["resume"]["tmp_name"], $resumePath)) {
        throw new Exception("Failed to upload resume.");
    }

    
    $conn = new mysqli($host, $user, $pass, $db);

    
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("
        INSERT INTO students (
            full_name, email, mobile, qualification, graduation_year, about, certifications, projects, skills, software, experience, soft_skills, resume_path
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssisssssiis",
        $fullName,
        $email,
        $mobile,
        $qualification,
        $graduationYear,
        $about,
        $certifications,
        $projects,
        $skills,
        $software,
        $experience,
        $softSkills,
        $resumePath
    );

    if (!$stmt->execute()) {
        throw new Exception("Insert query failed: " . $stmt->error);
    }

    
    $stmt->close();
    $conn->close();

    
    $response['success'] = true;
    $response['message'] = 'Form submitted successfully.';
    $response['data'] = ['redirect' => 'quiz.html'];

} catch (Exception $e) {
    
    $response['message'] = $e->getMessage();
}


echo json_encode($response);
?>