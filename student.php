<div class="p-4">


    <!-- Search -->
    <div class="flex items-center gap-3 mb-6">
        <input 
            id="searchInput"
            class="flex-1 rounded-full border border-gray-300 px-5 py-3 outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Search student...">
        <button id="searchBtn"
            class="bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl shadow">
            Search
        </button>
    </div>

    <!-- Student grid -->
    <div id="studentGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        <p>Where is the card</p>
    </div>

    <!-- ADD button -->
    <a href="register_student.php" target="_blank">
        <button
        class="fixed bottom-6 right-6 w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white text-4xl shadow-lg">
        +
        </button>
    </a>


    <script src="js/student_list.js"></script>
</div>
