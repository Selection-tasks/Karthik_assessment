<?php


session_start();

// Database connection
$host = 'db'; 
$db = 'internship_portal';
$user = 'user';
$pass = 'password';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

$correctAnswers = [];
while ($row = $result->fetch_assoc()) {
  $options = explode(',', $row['options']);
  $correctAnswers[$row['id']] = $options[0]; 
}


$score = 0;
foreach ($_POST as $key => $value) {
  $questionId = str_replace('q', '', $key); 
  if (isset($correctAnswers[$questionId]) && $value === $correctAnswers[$questionId]) {
    $score++;
  }
}


$email = $_SESSION['email']; 
$updateSql = "UPDATE students SET quiz_score = $score WHERE email = '$email'";
if ($conn->query($updateSql) === TRUE) {
  echo "<p>Your quiz score is: $score</p>";
} else {
  echo "Error updating quiz score: " . $conn->error;
}

$conn->close();
?>