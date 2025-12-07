<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeacherDesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-0 p-0">

    <!-- Background with gradient overlay -->
    <div class="relative min-h-screen bg-center bg-cover" style="background-image: url('img/image.jpg');">

        <!-- Dark gradient for readability -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- NAVIGATION -->
        <nav class="relative z-10 flex items-center justify-between px-10 py-6">
            <img src="img/logo.png" class="w-32">

            <ul class="flex space-x-8 text-white text-lg">
                <li><a href="#" class="hover:text-blue-300 duration-200">Home</a></li>
                <li><a href="#" class="hover:text-blue-300 duration-200">About</a></li>
                <li><a href="#" class="hover:text-blue-300 duration-200">Features</a></li>
                <li><a href="#" class="hover:text-blue-300 duration-200">Developer</a></li>
            </ul>
        </nav>

        <!-- HERO SECTION -->
        <div class="relative z-10 max-w-2xl mt-32 px-10 text-white">
            <h1 class="text-6xl font-bold leading-tight drop-shadow-lg">
                TeacherDesk<br>
                Anti-Cheat Monitoring System
            </h1>

            <p class="mt-5 text-lg text-gray-200">
                Monitor student screens, prevent cheating, manage exams, and take full control
                during online or on-site tests — fast and securely.
            </p>

            <div class="mt-10">
                <a href="auth.php" class="bg-blue-500 rounded-3xl py-3 px-10 
                font-medium inline-block mr-4 hover:bg-transparent hover:border-blue-500
                hover:text-white duration-300 hover:border border border-transparent text-2xl">
                    Login
                </a>
            </div>
        </div>

    </div>

</body>
</html>
