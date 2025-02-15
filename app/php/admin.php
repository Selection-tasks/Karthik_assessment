<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}


$host = 'localhost';
$db = 'internship_portal';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$students = [];
while ($row = $result->fetch_assoc()) {
  $students[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Magic UI styles */
    .magic-box {
      background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.06);
      border-radius: 12px;
      padding: 2rem;
      transition: transform 0.3s ease-in-out;
    }

    .magic-box:hover {
      transform: translateY(-5px);
    }
  </style>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Header -->
  <header class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
    <div class="flex items-center space-x-4">
      <h1 class="text-2xl font-bold text-gray-800">TechVritti Admin</h1>
    </div>
    <nav class="space-x-4">
      <a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Home</a>
      <a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Logout</a>
    </nav>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto px-6 py-8 h-screen overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Student Overview Card -->
      <div class="magic-box">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Student Overview</h2>
        <p class="text-gray-600">Total Students: <?php echo count($students); ?></p>
        <button class="mt-4 bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
          View Details
        </button>
      </div>

      <!-- Quiz Scores Card -->
      <div class="magic-box">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quiz Scores</h2>
        <ul class="space-y-2">
          <?php foreach ($students as $student): ?>
            <li class="text-gray-700">
              <?php echo $student['full_name']; ?>: 
              <span class="font-semibold"><?php echo $student['quiz_score']; ?>/10</span>
            </li>
          <?php endforeach; ?>
        </ul>
        <button class="mt-4 bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300">
          Export Scores
        </button>
      </div>

      <!-- Recent Submissions Card -->
      <div class="magic-box">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Submissions</h2>
        <ul class="space-y-2">
          <?php foreach ($students as $student): ?>
            <li class="text-gray-700">
              <?php echo $student['full_name']; ?> - 
              <span class="text-sm text-gray-500"><?php echo $student['email']; ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
        <button class="mt-4 bg-yellow-600 text-white py-2 px-4 rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-300">
          View All
        </button>
      </div>
    </div>

    <!-- Full-Screen Table -->
    <div class="mt-8 magic-box">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">All Students</h2>
      <table class="w-full text-left">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Quiz Score</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($students as $student): ?>
            <tr class="border-b">
              <td class="px-4 py-2"><?php echo $student['full_name']; ?></td>
              <td class="px-4 py-2"><?php echo $student['email']; ?></td>
              <td class="px-4 py-2"><?php echo $student['quiz_score']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-6 px-6 mt-8">
    <div class="container mx-auto text-center">
      <p>&copy; 2023 TechVritti. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>