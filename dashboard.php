<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Modern Sidebar</title>
</head>

<body class="bg-white text-gray-900 flex">

<!-- Mobile Toggle Button -->
<button id="menuBtn" class="md:hidden p-4 fixed z-50 text-gray-800">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
       viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"/>
  </svg>
</button>

<!-- SIDEBAR -->
<div id="sidebar"
     class="hidden md:flex flex-col w-64 h-screen bg-blue-600 border-r-4 border-blue-800
            shadow-xl rounded-r-3xl transition-transform duration-300 text-white">

    <div class="flex flex-col flex-1 overflow-y-auto px-4 py-6">

        <h1 class="text-2xl font-bold mb-10 px-3">Dashboard</h1>

        <nav class="flex flex-col gap-3">

            <!-- HOME -->
            <a href="#" data-page="home.php" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-500 transition">
                <img src="img/home.svg" alt="Home" class="w-6 h-6">
                <span>Home</span>
            </a>


            <!-- EXAMS -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-500 transition">
                <img src="img/exam.svg" alt="Exams" class="w-6 h-6">
                <span>Exams</span>
            </a>

            <!-- MONITORING -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-500 transition">
                <img src="img/monitor.svg" alt="Monitor" class="w-6 h-6">
                <span>Monitoring</span>
            </a>

            <!-- STUDENT -->
            <a href="#" data-page="student.php" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-500 transition">
                <img src="img/student.svg" alt="Student" class="w-6 h-6">
                <span>Student</span>
            </a>

            <!-- ANNOUNCEMENT -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-500 transition">
                <img src="img/announcement.svg" alt="Announcement" class="w-6 h-6">
                <span>Announcement</span>
            </a>

            <!-- INTEGRITY -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-500 transition">
                <img src="img/warning.svg" alt="Integrity" class="w-6 h-6">
                <span>Integrity</span>
            </a>

        </nav>
    </div>

    <!-- ADMIN PROFILE BOTTOM -->
    <div class="px-4 py-5 border-t border-blue-800 flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-500 transition">
        <img src="img/logout.svg" alt="Logout" class="w-6 h-6">
        <span class="font-semibold text-white">Logout</span>
        
    </div>

</div>

<!-- MAIN CONTENT -->
<div id="mainContent" class="flex-1 h-screen overflow-y-auto bg-white">

  <!-- Default Main Content -->
  <div class="p-10">
      <h1 class="text-4xl font-bold mb-4">Welcome</h1>
      <p class="text-gray-600 text-lg">Your clean white dashboard with a blue sidebar is ready.</p>
  </div>

</div>


<script src="js/dashboard_controller_js.js"></script>

</body>
</html>
