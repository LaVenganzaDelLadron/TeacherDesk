<!DOCTYPE html>
<html lang="en">

<head>
  <title>Student Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style/student_style.css">
</head>

<body class="bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center min-h-screen overflow-auto">

  <form id="registerForm" class="sig-up-form" 
        class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md space-y-5 border border-gray-200 mb-10">

    <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Create Student Account</h2>

    
    <input type="hidden" name="register" value="1">
    <!-- Username -->
    <div>
      <label class="block text-gray-700 font-medium mb-1">Username</label>
      <input type="text" name="username" placeholder="Enter your username"
        required
        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-400 transition">
    </div>


    <!-- Email -->
    <div>
      <label class="block text-gray-700 font-medium mb-1">Email</label>
      <input type="email" name="email" placeholder="name@example.com"
        required
        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-400 transition">
    </div>


    <!-- Password -->
    <div>
      <label class="block text-gray-700 font-medium mb-1">Password</label>
      <input type="password" name="password" placeholder="Enter password"
        required
        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-400 transition">
    </div>


    <!-- Course -->
    <div>
      <label class="block text-gray-700 font-medium mb-1">Course</label>
      <select name="course" required
        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400">
        <?php
          include 'backend/connection.php';
          $sql = "SELECT course_id, name FROM course";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()){
            echo '<option value="'.$row['course_id'].'">'.$row['name'].'</option>';
          }
        ?>
      </select>
    </div>


    <!-- Year Level -->
    <div>
      <label class="block text-gray-700 font-medium mb-1">Year Level</label>
      <select name="year"
        required
        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400">
        <option value="1">1st Year</option>
        <option value="2">2nd Year</option>
        <option value="3">3rd Year</option>
        <option value="4">4th Year</option>
      </select>
    </div>


    <button type="submit"
      class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition font-semibold shadow-md">
        Create Account
    </button>


  </form>
  <script src="js/student_controller.js"></script>
</body>
</html>
