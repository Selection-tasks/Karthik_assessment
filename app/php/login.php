<?php

session_start();


$ADMIN_USERNAME = 'admin';
$ADMIN_PASSWORD = 'password123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username === $ADMIN_USERNAME && $password === $ADMIN_PASSWORD) {
    
    $_SESSION['admin'] = true;
    header('Location: admin.php');
    exit();
  } else {
    
    echo '<p class="text-red-500 text-center mt-4">Invalid username or password.</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Magic UI styles */
    .magic-card {
      background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.06);
      border-radius: 12px;
      padding: 2rem;
      transition: transform 0.3s ease-in-out;
    }

    .magic-card:hover {
      transform: translateY(-5px);
    }
  </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex items-center justify-center">

  
  <div class="magic-card w-full max-w-md">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Admin Login</h1>

    
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $username !== $ADMIN_USERNAME): ?>
      <p class="text-red-500 text-center mb-4">Invalid username or password.</p>
    <?php endif; ?>

    
    <form method="POST" action="" class="space-y-4">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" id="username" name="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
        Login
      </button>
    </form>
  </div>

</body>
</html>