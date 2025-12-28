<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

interface Student {
  id: number;
  name: string;
  email: string;
  studentId: string;
  section: string;
  status: 'online' | 'offline' | 'flagged';
  lastActive: string;
  deviceInfo: string;
  enrolledDate: string;
  violations: number;
}

const page = usePage();
const user = computed(() => page.props.auth?.user);

// Search functionality
const searchQuery = ref('');

// Mock student data
const students = ref<Student[]>([
  {
    id: 1,
    name: 'John Anderson',
    email: 'john.anderson@school.edu',
    studentId: 'STU-2024-001',
    section: 'CS-101-A',
    status: 'online',
    lastActive: '2 minutes ago',
    deviceInfo: 'Chrome on Windows',
    enrolledDate: '2024-01-15',
    violations: 0
  },
  {
    id: 2,
    name: 'Sarah Martinez',
    email: 'sarah.martinez@school.edu',
    studentId: 'STU-2024-002',
    section: 'CS-101-A',
    status: 'offline',
    lastActive: '1 hour ago',
    deviceInfo: 'Firefox on MacOS',
    enrolledDate: '2024-01-15',
    violations: 0
  },
  {
    id: 3,
    name: 'Michael Chen',
    email: 'michael.chen@school.edu',
    studentId: 'STU-2024-003',
    section: 'CS-101-B',
    status: 'flagged',
    lastActive: '5 minutes ago',
    deviceInfo: 'Chrome on Windows',
    enrolledDate: '2024-01-16',
    violations: 2
  },
  {
    id: 4,
    name: 'Emily Johnson',
    email: 'emily.johnson@school.edu',
    studentId: 'STU-2024-004',
    section: 'CS-101-A',
    status: 'online',
    lastActive: 'Just now',
    deviceInfo: 'Safari on MacOS',
    enrolledDate: '2024-01-15',
    violations: 0
  },
  {
    id: 5,
    name: 'David Kim',
    email: 'david.kim@school.edu',
    studentId: 'STU-2024-005',
    section: 'CS-101-B',
    status: 'offline',
    lastActive: '3 hours ago',
    deviceInfo: 'Edge on Windows',
    enrolledDate: '2024-01-16',
    violations: 0
  },
  {
    id: 6,
    name: 'Jessica Brown',
    email: 'jessica.brown@school.edu',
    studentId: 'STU-2024-006',
    section: 'CS-102-A',
    status: 'online',
    lastActive: '30 seconds ago',
    deviceInfo: 'Chrome on Linux',
    enrolledDate: '2024-01-17',
    violations: 0
  },
  {
    id: 7,
    name: 'Robert Taylor',
    email: 'robert.taylor@school.edu',
    studentId: 'STU-2024-007',
    section: 'CS-102-A',
    status: 'flagged',
    lastActive: '10 minutes ago',
    deviceInfo: 'Firefox on Windows',
    enrolledDate: '2024-01-17',
    violations: 1
  },
  {
    id: 8,
    name: 'Amanda Wilson',
    email: 'amanda.wilson@school.edu',
    studentId: 'STU-2024-008',
    section: 'CS-101-A',
    status: 'offline',
    lastActive: '2 days ago',
    deviceInfo: 'Chrome on Windows',
    enrolledDate: '2024-01-15',
    violations: 0
  }
]);

// Filter students based on search query
const filteredStudents = computed(() => {
  if (!searchQuery.value.trim()) {
    return students.value;
  }
  
  const query = searchQuery.value.toLowerCase();
  return students.value.filter(student => 
    student.name.toLowerCase().includes(query) ||
    student.email.toLowerCase().includes(query) ||
    student.studentId.toLowerCase().includes(query) ||
    student.section.toLowerCase().includes(query)
  );
});

// Stats computed from student data
const stats = computed(() => ({
  total: students.value.length,
  online: students.value.filter(s => s.status === 'online').length,
  offline: students.value.filter(s => s.status === 'offline').length,
  flagged: students.value.filter(s => s.status === 'flagged').length
}));

// Get status badge color
const getStatusColor = (status: string) => {
  switch (status) {
    case 'online':
      return 'bg-green-500/20 text-green-400 border-green-500/30';
    case 'offline':
      return 'bg-gray-500/20 text-gray-400 border-gray-500/30';
    case 'flagged':
      return 'bg-red-500/20 text-red-400 border-red-500/30';
    default:
      return 'bg-gray-500/20 text-gray-400 border-gray-500/30';
  }
};

// Actions
const addStudent = () => {
  console.log('Add student clicked');
  // TODO: Open add student modal
};

const viewProfile = (studentId: number) => {
  console.log('View profile:', studentId);
  // TODO: Navigate to student profile
};

const monitorStudent = (studentId: number) => {
  console.log('Monitor student:', studentId);
  // TODO: Open monitoring view for specific student
};

const disableStudent = (studentId: number) => {
  console.log('Disable student:', studentId);
  // TODO: Disable student access
};

const removeStudent = (studentId: number) => {
  console.log('Remove student:', studentId);
  // TODO: Remove student from system
};

const handleLogout = () => {
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '/logout';
  
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  if (csrfToken) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = '_token';
    input.value = csrfToken;
    form.appendChild(input);
  }
  
  document.body.appendChild(form);
  form.submit();
};
</script>

<template>
  <div class="flex h-screen bg-[#0a0e1a] text-white overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#0f1419] border-r border-gray-800 flex-shrink-0 flex flex-col h-full">
      <!-- Logo/Brand -->
      <div class="p-6 border-b border-gray-800">
        <h1 class="text-2xl font-bold text-[#1dd3f8]">TeacherDesk</h1>
        <p class="text-xs text-gray-400 mt-1">Exam Monitoring System</p>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 p-4 overflow-y-auto">
        <Link href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800/50 transition-colors mb-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          <span>Dashboard</span>
        </Link>

        <Link href="/exams" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800/50 transition-colors mb-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <span>Exams</span>
        </Link>

        <Link href="/students" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gray-800/70 text-[#1dd3f8] transition-colors mb-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <span>Students</span>
        </Link>

        <Link href="/monitoring" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800/50 transition-colors mb-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
          </svg>
          <span>Monitoring</span>
        </Link>

        <Link href="/announcement" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800/50 transition-colors mb-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
          </svg>
          <span>Announcements</span>
        </Link>

        <div class="border-t border-gray-800 my-4"></div>

        <Link href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800/50 transition-colors mb-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
          </svg>
          <span>Integrity</span>
        </Link>

        <Link href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800/50 transition-colors mb-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <span>Settings</span>
        </Link>
      </nav>

      <!-- User Profile -->
      <div class="p-4 border-t border-gray-800">
        <div class="flex items-center gap-3 mb-3">
          <div class="w-10 h-10 rounded-full bg-[#1dd3f8]/20 flex items-center justify-center text-[#1dd3f8] font-semibold">
            {{ user?.name?.charAt(0).toUpperCase() || 'T' }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium truncate">{{ user?.name || 'Teacher' }}</p>
            <p class="text-xs text-gray-400 truncate">{{ user?.email || 'teacher@school.edu' }}</p>
          </div>
        </div>
        <button @click="handleLogout" class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-700 rounded-lg text-sm transition-colors flex items-center justify-center gap-2">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          Logout
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
      <div class="p-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
          <div>
            <h1 class="text-3xl font-bold mb-2">Students</h1>
            <p class="text-gray-400">Manage enrolled students and monitor their activity across all exam sessions</p>
          </div>
          <button @click="addStudent" class="px-6 py-3 bg-[#1dd3f8] hover:bg-[#1dd3f8]/90 text-[#0a0e1a] font-semibold rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Student
          </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-4 gap-6 mb-8">
          <div class="bg-[#0f1419] border border-gray-800 rounded-xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-400 text-sm mb-1">Total Students</p>
                <p class="text-3xl font-bold">{{ stats.total }}</p>
              </div>
              <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </div>
            </div>
          </div>

          <div class="bg-[#0f1419] border border-gray-800 rounded-xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-400 text-sm mb-1">Online Now</p>
                <p class="text-3xl font-bold text-green-400">{{ stats.online }}</p>
              </div>
              <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z" />
                </svg>
              </div>
            </div>
          </div>

          <div class="bg-[#0f1419] border border-gray-800 rounded-xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-400 text-sm mb-1">Offline</p>
                <p class="text-3xl font-bold text-gray-400">{{ stats.offline }}</p>
              </div>
              <div class="w-12 h-12 bg-gray-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414" />
                </svg>
              </div>
            </div>
          </div>

          <div class="bg-[#0f1419] border border-gray-800 rounded-xl p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-400 text-sm mb-1">Flagged</p>
                <p class="text-3xl font-bold text-red-400">{{ stats.flagged }}</p>
              </div>
              <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Student Management Panel -->
        <div class="bg-[#0f1419] border border-gray-800 rounded-xl overflow-hidden">
          <!-- Search Bar -->
          <div class="p-6 border-b border-gray-800">
            <div class="relative">
              <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
              <input 
                v-model="searchQuery"
                type="text" 
                placeholder="Search by name, email, student ID, or section..." 
                class="w-full bg-[#0a0e1a] border border-gray-700 rounded-lg pl-10 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#1dd3f8] transition-colors"
              />
            </div>
          </div>

          <!-- Students Table -->
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-[#0a0e1a] border-b border-gray-800">
                <tr>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Student</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Student ID</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Section</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Last Active</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Device</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Violations</th>
                  <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-800">
                <tr v-for="student in filteredStudents" :key="student.id" class="hover:bg-[#0a0e1a]/50 transition-colors">
                  <td class="px-6 py-4">
                    <div>
                      <p class="font-medium text-white">{{ student.name }}</p>
                      <p class="text-sm text-gray-400">{{ student.email }}</p>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-sm text-gray-300">{{ student.studentId }}</p>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-sm text-gray-300">{{ student.section }}</p>
                  </td>
                  <td class="px-6 py-4">
                    <span :class="getStatusColor(student.status)" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium border">
                      <span v-if="student.status === 'online'" class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                      <span v-else-if="student.status === 'flagged'" class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                      <span v-else class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                      {{ student.status.charAt(0).toUpperCase() + student.status.slice(1) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-sm text-gray-400">{{ student.lastActive }}</p>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-sm text-gray-400">{{ student.deviceInfo }}</p>
                  </td>
                  <td class="px-6 py-4">
                    <span v-if="student.violations > 0" class="inline-flex items-center gap-1 px-2 py-1 bg-red-500/20 text-red-400 rounded text-xs font-medium">
                      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                      </svg>
                      {{ student.violations }}
                    </span>
                    <span v-else class="text-sm text-gray-500">None</span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                      <button @click="viewProfile(student.id)" class="p-2 text-gray-400 hover:text-[#1dd3f8] hover:bg-[#1dd3f8]/10 rounded-lg transition-colors" title="View Profile">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                      </button>
                      <button @click="monitorStudent(student.id)" class="p-2 text-gray-400 hover:text-green-400 hover:bg-green-500/10 rounded-lg transition-colors" title="Monitor Activity">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                      </button>
                      <button @click="disableStudent(student.id)" class="p-2 text-gray-400 hover:text-yellow-400 hover:bg-yellow-500/10 rounded-lg transition-colors" title="Disable Access">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                      </button>
                      <button @click="removeStudent(student.id)" class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors" title="Remove Student">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Empty State -->
            <div v-if="filteredStudents.length === 0" class="py-16 text-center">
              <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
              <p class="text-gray-400 text-lg font-medium mb-2">No students found</p>
              <p class="text-gray-500 text-sm">{{ searchQuery ? 'Try adjusting your search query' : 'Add students to get started' }}</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: #0a0e1a;
}

::-webkit-scrollbar-thumb {
  background: #374151;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #4b5563;
}

/* Pulse animation for online status */
@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

.animate-pulse {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
