<!-- home.php -->
<div class="p-6">

  <!-- Grid Container -->
  <div class="grid grid-cols-4 grid-rows-2 gap-6">

    <!-- Students Card -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-200 flex flex-col items-center justify-center text-center">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Students</h2>
        <p id="totalStudents" class="text-gray-600 text-2xl font-semibold">0</p>
    </div>

    <!-- Online Card -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-200 flex flex-col items-center justify-center text-center">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Online</h2>
        <p id="onlineStudents" class="text-gray-600 text-2xl font-semibold">0</p>
    </div>

    <!-- Profile Card (2x2) on Right -->
    <div class="col-span-2 row-span-2 bg-white shadow-lg rounded-xl border border-gray-200 p-6 flex flex-col items-center justify-center">
        <img src="https://i.pravatar.cc/150" class="w-28 h-28 rounded-full border border-gray-300 mb-4">
        <p class="font-semibold text-gray-800 text-xl mb-1">Admin</p>
        <p class="text-gray-500 text-sm">Administrator</p>
        <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">View Profile</button>
    </div>

    <!-- Cheating Card -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-200 flex flex-col items-center justify-center text-center">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Cheating</h2>
        <p id="cheatingCount" class="text-gray-600 text-2xl font-semibold">0</p>
    </div>

    <!-- Temporary Card -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-200 flex flex-col items-center justify-center text-center">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Temporary</h2>
        <p id="temporaryCount" class="text-gray-600 text-2xl font-semibold">0</p>
    </div>
    
  </div>

<!-- Exam Coordination & Announcement Container -->
<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">

  <!-- Exam Coordination Card -->
  <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="p-5">
      <h5 class="text-xl font-bold tracking-tight text-gray-900">Exam Coordination</h5>
      <p class="mt-2 text-gray-600 text-sm">
        Scheduled & Activity Exams
      </p>
      <a href="#"
         class="inline-block mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300">
        New Exam
      </a>
    </div>
  </div>

  <!-- Announcement Card -->
  <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="p-5">
      <h5 class="text-xl font-bold tracking-tight text-gray-900">Announcement</h5>
      <p class="mt-2 text-gray-600 text-sm">
        Target Broadcast
      </p>
      <a href="#"
         class="inline-block mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-300">
        Compose
      </a>
    </div>
  </div>

  <!-- Live Monitoring Card -->
  <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 col-span-2">
  <div class="p-5 flex items-center justify-between">
    <div>
      <h5 class="text-xl font-bold tracking-tight text-gray-900">Live Monitoring</h5>
      <p class="mt-2 text-gray-600 text-sm">
        Real-time student activity & screen monitoring
      </p>
    </div>

    <a href="#"
      class="inline-block px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-300">
      Open Monitor
    </a>
  </div>

  <div class="p-5 border-t border-gray-200 text-gray-600">
      Currently Connected: <span class="font-semibold">12</span>
  </div>
</div>

  <!-- Hot Session -->
  <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 col-span-2">
  <div class="p-5 flex items-center justify-between">
    <div>
      <h5 class="text-xl font-bold tracking-tight text-gray-900">Hot Session</h5>
      <p class="mt-2 text-gray-600 text-sm">
        Live Focus Watch
      </p>
    </div>

    <a href="#"
      class="inline-block px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-300">
      Open Monitor
    </a>
  </div>

  <div class="p-5 border-t border-gray-200 text-gray-600">
      Suspect Cheating: <span class="font-semibold">2</span>
  </div>
  </div>
  