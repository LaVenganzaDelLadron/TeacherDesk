<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

interface Exam {
	id: number;
	title: string;
	subject: string;
	schedule: string;
	duration: number;
	status: 'ongoing' | 'upcoming' | 'completed';
	studentCount: number;
}

const page = usePage();
const auth = computed(() => page.props.auth as { user: { name: string; email: string } } | undefined);
const user = auth.value?.user;

const getInitials = (name: string) => {
	return name
		.split(' ')
		.map((n) => n[0])
		.join('')
		.toUpperCase()
		.slice(0, 2);
};

const menuItems = [
	{ name: 'Dashboard', href: 'dashboard' },
	{ name: 'Exams', href: 'exams' },
	{ name: 'Monitoring', href: 'monitoring' },
	{ name: 'Announcement', href: 'announcement' },
	{ name: 'Students', href: 'students' },
	{ name: 'Integrity', href: 'integrity' },
];

const exams = ref<Exam[]>([
	{
		id: 1,
		title: 'Mathematics Final Examination',
		subject: 'MTH-101',
		schedule: 'Dec 28, 2025 - 09:00 AM',
		duration: 120,
		status: 'ongoing',
		studentCount: 24,
	},
	{
		id: 2,
		title: 'Physics Midterm Test',
		subject: 'PHY-102',
		schedule: 'Dec 29, 2025 - 11:00 AM',
		duration: 90,
		status: 'upcoming',
		studentCount: 18,
	},
	{
		id: 3,
		title: 'Chemistry Quiz',
		subject: 'CHM-103',
		schedule: 'Dec 28, 2025 - 02:00 PM',
		duration: 60,
		status: 'ongoing',
		studentCount: 22,
	},
	{
		id: 4,
		title: 'Biology Practical Exam',
		subject: 'BIO-104',
		schedule: 'Dec 30, 2025 - 10:00 AM',
		duration: 150,
		status: 'upcoming',
		studentCount: 20,
	},
	{
		id: 5,
		title: 'Computer Science Theory',
		subject: 'CS-105',
		schedule: 'Dec 27, 2025 - 08:00 AM',
		duration: 180,
		status: 'completed',
		studentCount: 30,
	},
	{
		id: 6,
		title: 'English Literature Final',
		subject: 'ENG-106',
		schedule: 'Dec 26, 2025 - 01:00 PM',
		duration: 120,
		status: 'completed',
		studentCount: 25,
	},
]);

const showCreateModal = ref(false);

const getStatusColor = (status: Exam['status']) => {
	const colors = {
		ongoing: 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40',
		upcoming: 'bg-amber-500/20 text-amber-300 border-amber-500/40',
		completed: 'bg-slate-500/20 text-slate-400 border-slate-500/40',
	};
	return colors[status];
};

const getStatusIcon = (status: Exam['status']) => {
	const icons = {
		ongoing: '●',
		upcoming: '○',
		completed: '✓',
	};
	return icons[status];
};

const createExam = () => {
	showCreateModal.value = true;
};

const viewExam = (examId: number) => {
	console.log('View exam:', examId);
};

const editExam = (examId: number) => {
	console.log('Edit exam:', examId);
};

const monitorExam = (examId: number) => {
	console.log('Monitor exam:', examId);
};

const deleteExam = (examId: number) => {
	if (confirm('Are you sure you want to delete this exam?')) {
		exams.value = exams.value.filter((exam) => exam.id !== examId);
	}
};
</script>

<template>
	<Head title="Exams" />
	<div class="flex h-screen overflow-hidden bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c] text-slate-100">
		<!-- Sidebar - Fixed -->
		<aside class="w-64 bg-[#121826] h-screen p-6 flex flex-col justify-between border-r border-white/10 flex-shrink-0">
			<!-- Logo / Title -->
			<div class="mb-10">
				<h1 class="text-2xl font-bold text-cyan-400">TEACHER DESK</h1>
			</div>

			<!-- Menu -->
			<nav class="flex-1 overflow-y-auto">
				<ul class="space-y-4">
					<li v-for="item in menuItems" :key="item.name">
						<Link
							:href="`/${item.href}`"
							:class="[
								'flex items-center p-2 rounded-lg transition',
								item.href === 'exams' ? 'text-cyan-400 bg-[#1a1f33]' : 'text-gray-300 hover:text-cyan-400 hover:bg-[#1a1f33]'
							]"
						>
							{{ item.name }}
						</Link>
					</li>
				</ul>
			</nav>

			<!-- User Section -->
			<div class="mt-10">
				<div class="flex items-center space-x-3 mb-4">
					<div class="w-10 h-10 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-300 font-semibold">
						{{ user ? getInitials(user.name) : 'U' }}
					</div>
					<div class="flex-1 min-w-0">
						<p class="text-gray-200 font-semibold truncate">{{ user?.name || 'User' }}</p>
						<p class="text-gray-400 text-sm truncate">{{ user?.email || 'user@example.com' }}</p>
					</div>
				</div>
				<Link
					href="/logout"
					method="post"
					as="button"
					class="w-full rounded-lg bg-red-500/20 px-3 py-2 text-sm font-semibold text-red-300 transition hover:bg-red-500/30"
				>
					Logout
				</Link>
			</div>
		</aside>

		<!-- Main Content - Scrollable -->
		<div class="flex-1 overflow-y-auto bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c]">
			<div class="pointer-events-none absolute inset-0 opacity-30" aria-hidden="true">
				<div class="absolute right-1/3 top-0 h-[26rem] w-[26rem] rounded-full bg-[radial-gradient(circle_at_center,rgba(29,211,248,0.18),transparent_60%)] blur-3xl" />
			</div>

			<div class="relative p-8">
			<!-- Header -->
			<div class="mb-8 flex items-center justify-between">
				<div>
					<h1 class="text-3xl font-semibold text-white">Exams</h1>
					<p class="mt-2 text-slate-400">Create, manage, and monitor exams with real-time integrity tracking</p>
				</div>
				<button
					@click="createExam"
					class="flex items-center gap-2 bg-cyan-500 hover:bg-cyan-600 text-slate-900 font-semibold px-6 py-3 rounded-lg shadow-lg shadow-cyan-500/30 transition hover:-translate-y-0.5"
				>
					<span class="text-lg">+</span>
					<span>Create Exam</span>
				</button>
			</div>

			<!-- Stats Summary -->
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
				<div class="bg-[#121826] border border-white/10 rounded-xl p-6">
					<div class="flex items-center justify-between">
						<div>
							<p class="text-slate-400 text-sm">Ongoing Exams</p>
							<p class="text-3xl font-bold text-emerald-400 mt-2">{{ exams.filter((e) => e.status === 'ongoing').length }}</p>
						</div>
						<div class="w-12 h-12 bg-emerald-500/20 rounded-full flex items-center justify-center">
							<span class="text-2xl">📝</span>
						</div>
					</div>
				</div>

				<div class="bg-[#121826] border border-white/10 rounded-xl p-6">
					<div class="flex items-center justify-between">
						<div>
							<p class="text-slate-400 text-sm">Upcoming Exams</p>
							<p class="text-3xl font-bold text-amber-400 mt-2">{{ exams.filter((e) => e.status === 'upcoming').length }}</p>
						</div>
						<div class="w-12 h-12 bg-amber-500/20 rounded-full flex items-center justify-center">
							<span class="text-2xl">📅</span>
						</div>
					</div>
				</div>

				<div class="bg-[#121826] border border-white/10 rounded-xl p-6">
					<div class="flex items-center justify-between">
						<div>
							<p class="text-slate-400 text-sm">Completed Exams</p>
							<p class="text-3xl font-bold text-slate-400 mt-2">{{ exams.filter((e) => e.status === 'completed').length }}</p>
						</div>
						<div class="w-12 h-12 bg-slate-500/20 rounded-full flex items-center justify-center">
							<span class="text-2xl">✓</span>
						</div>
					</div>
				</div>
			</div>

			<!-- Exams Table -->
			<div class="bg-[#121826] border border-white/10 rounded-xl overflow-hidden">
				<div class="overflow-x-auto">
					<table class="w-full">
						<thead>
							<tr class="border-b border-white/10 bg-white/5">
								<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Exam Title</th>
								<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Subject</th>
								<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Schedule</th>
								<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Duration</th>
								<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Students</th>
								<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
								<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Actions</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-white/10">
							<tr v-for="exam in exams" :key="exam.id" class="hover:bg-white/5 transition">
								<td class="px-6 py-4">
									<div>
										<p class="font-semibold text-white">{{ exam.title }}</p>
										<p class="text-xs text-slate-500 mt-1">ID: #{{ exam.id }}</p>
									</div>
								</td>
								<td class="px-6 py-4">
									<span class="text-cyan-400 font-medium">{{ exam.subject }}</span>
								</td>
								<td class="px-6 py-4">
									<p class="text-sm text-slate-300">{{ exam.schedule }}</p>
								</td>
								<td class="px-6 py-4">
									<p class="text-sm text-slate-300">{{ exam.duration }} min</p>
								</td>
								<td class="px-6 py-4">
									<p class="text-sm text-slate-300">{{ exam.studentCount }}</p>
								</td>
								<td class="px-6 py-4">
									<span :class="['inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border', getStatusColor(exam.status)]">
										<span>{{ getStatusIcon(exam.status) }}</span>
										<span>{{ exam.status.charAt(0).toUpperCase() + exam.status.slice(1) }}</span>
									</span>
								</td>
								<td class="px-6 py-4">
									<div class="flex items-center gap-2">
										<button
											@click="viewExam(exam.id)"
											class="p-2 text-slate-400 hover:text-cyan-400 hover:bg-cyan-400/10 rounded-lg transition"
											title="View Details"
										>
											<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
											</svg>
										</button>
										<button
											@click="editExam(exam.id)"
											class="p-2 text-slate-400 hover:text-amber-400 hover:bg-amber-400/10 rounded-lg transition"
											title="Edit Exam"
										>
											<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
											</svg>
										</button>
										<button
											v-if="exam.status === 'ongoing'"
											@click="monitorExam(exam.id)"
											class="p-2 text-slate-400 hover:text-emerald-400 hover:bg-emerald-400/10 rounded-lg transition"
											title="Monitor Exam"
										>
											<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
											</svg>
										</button>
										<button
											@click="deleteExam(exam.id)"
											class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-400/10 rounded-lg transition"
											title="Delete Exam"
										>
											<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
											</svg>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Empty State -->
				<div v-if="exams.length === 0" class="py-16 text-center">
					<div class="text-slate-500 mb-4">
						<svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
						</svg>
					</div>
					<p class="text-slate-400">No exams created yet</p>
					<p class="text-slate-500 text-sm mt-2">Create your first exam to get started</p>
				</div>
			</div>
			</div>
		</div>
	</div>
</template>

<style scoped>
/* Scrollbar styling */
::-webkit-scrollbar {
	width: 6px;
	height: 6px;
}

::-webkit-scrollbar-track {
	background: transparent;
}

::-webkit-scrollbar-thumb {
	background: rgba(29, 211, 248, 0.2);
	border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
	background: rgba(29, 211, 248, 0.3);
}
</style>
