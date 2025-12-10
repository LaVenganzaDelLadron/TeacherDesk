

<div class="p-4">


    <div class="p-5">

        <!-- Search -->
        <div class="flex gap-3 mb-5">
            <input type="text" id="searchInput" placeholder="Search student..." 
                class="flex-1 rounded-full border px-4 py-2 outline-none focus:ring-2 focus:ring-blue-400">
            <button id="searchBtn" class="bg-blue-600 text-white px-4 py-2 rounded-full">Search</button>
        </div>

        <!-- Card container -->
        <div id="studentGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            <!-- Cards will be dynamically inserted here -->
        </div>
    </div>

    <!-- ADD button -->
    <a href="register_student.php" target="_blank">
        <button
        class="fixed bottom-6 right-6 w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white text-4xl shadow-lg">
        +
        </button>
    </a>

</div>


