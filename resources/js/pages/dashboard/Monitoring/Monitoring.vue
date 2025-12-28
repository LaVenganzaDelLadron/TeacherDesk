<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

interface Student {
	id: number;
	name: string;
	deviceStatus: 'active' | 'warning' | 'disconnected';
	lastActivity: string;
	alerts: number;
	screenshot: string | null;
}

interface Alert {
	id: number;
	studentName: string;
	type: 'tab-switch' | 'app-violation' | 'screenshot' | 'disconnect';
	severity: 'critical' | 'warning' | 'info';
	message: string;
	timestamp: string;
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

const currentExam = ref({
	name: 'Mathematics Final Examination',
	date: 'Dec 28, 2025',
	startTime: '09:00 AM',
	status: 'active',
});

const isMonitoring = ref(true);

const students = ref<Student[]>([
	{ id: 1, name: 'John Doe', deviceStatus: 'active', lastActivity: '2s ago', alerts: 0, screenshot: null },
	{ id: 2, name: 'Jane Smith', deviceStatus: 'warning', lastActivity: '5s ago', alerts: 2, screenshot: null },
	{ id: 3, name: 'Mike Johnson', deviceStatus: 'active', lastActivity: '1s ago', alerts: 0, screenshot: null },
	{ id: 4, name: 'Sarah Williams', deviceStatus: 'active', lastActivity: '3s ago', alerts: 0, screenshot: null },
	{ id: 5, name: 'Alex Brown', deviceStatus: 'warning', lastActivity: '8s ago', alerts: 3, screenshot: null },
	{ id: 6, name: 'Emily Davis', deviceStatus: 'active', lastActivity: '2s ago', alerts: 0, screenshot: null },
	{ id: 7, name: 'Chris Wilson', deviceStatus: 'disconnected', lastActivity: '45s ago', alerts: 1, screenshot: null },
	{ id: 8, name: 'Lisa Anderson', deviceStatus: 'active', lastActivity: '1s ago', alerts: 0, screenshot: null },
]);

const alerts = ref<Alert[]>([
	{
		id: 1,
		studentName: 'Alex Brown',
		type: 'app-violation',
		severity: 'critical',
		message: 'Unauthorized application detected (Chrome)',
		timestamp: '09:45:23',
	},
	{
		id: 2,
		studentName: 'Jane Smith',
		type: 'tab-switch',
		severity: 'warning',
		message: 'Rapid tab switching detected',
		timestamp: '09:44:55',
	},
	{
		id: 3,
		studentName: 'Chris Wilson',
		type: 'disconnect',
		severity: 'critical',
		message: 'Student disconnected from session',
		timestamp: '09:43:12',
	},
	{
		id: 4,
		studentName: 'Alex Brown',
		type: 'tab-switch',
		severity: 'warning',
		message: 'Tab switch detected',
		timestamp: '09:42:08',
	},
	{
		id: 5,
		studentName: 'Jane Smith',
		type: 'screenshot',
		severity: 'info',
		message: 'Screenshot captured',
		timestamp: '09:40:00',
	},
]);

const getDeviceStatusColor = (status: Student['deviceStatus']) => {
	const colors = {
		active: 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40',
		warning: 'bg-amber-500/20 text-amber-300 border-amber-500/40',
		disconnected: 'bg-rose-500/20 text-rose-300 border-rose-500/40',
	};
	return colors[status];
};

const getDeviceStatusIcon = (status: Student['deviceStatus']) => {
	const icons = {
		active: '●',
		warning: '⚠',
		disconnected: '✕',
	};
	return icons[status];
};

const getAlertSeverityColor = (severity: Alert['severity']) => {
	const colors = {
		critical: 'border-l-rose-500 bg-rose-500/5 text-rose-300',
		warning: 'border-l-amber-500 bg-amber-500/5 text-amber-300',
		info: 'border-l-cyan-500 bg-cyan-500/5 text-cyan-300',
	};
	return colors[severity];
};

const pauseMonitoring = () => {
	isMonitoring.value = !isMonitoring.value;
};

const lockAllScreens = () => {
	alert('All student screens locked');
};

const endSession = () => {
	if (confirm('Are you sure you want to end this monitoring session?')) {
		alert('Session ended');
	}
};

const viewStudent = (studentId: number) => {
	console.log('View student:', studentId);
};
</script>

<template>
	<Head title="Monitoring" />
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
								item.href === 'monitoring' ? 'text-cyan-400 bg-[#1a1f33]' : 'text-gray-300 hover:text-cyan-400 hover:bg-[#1a1f33]'
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
				<!-- Monitoring Header -->
				<div class="mb-8 bg-[#121826] border border-white/10 rounded-xl p-6">
					<div class="flex items-center justify-between">
						<div class="flex items-center gap-6">
							<div>
								<h1 class="text-2xl font-semibold text-white">{{ currentExam.name }}</h1>
								<p class="text-sm text-slate-400 mt-1">{{ currentExam.date }} • Started at {{ currentExam.startTime }}</p>
							</div>
							<div class="flex items-center gap-2 px-4 py-2 bg-emerald-500/20 border border-emerald-500/40 rounded-lg">
								<span class="relative flex h-3 w-3">
									<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
									<span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
								</span>
								<span class="text-sm font-semibold text-emerald-300">Live Monitoring</span>
							</div>
						</div>

						<div class="flex items-center gap-3">
							<button
								@click="pauseMonitoring"
								:class="[
									'px-4 py-2 rounded-lg font-semibold text-sm transition',
									isMonitoring ? 'bg-amber-500/20 text-amber-300 hover:bg-amber-500/30' : 'bg-emerald-500/20 text-emerald-300 hover:bg-emerald-500/30'
								]"
							>
								{{ isMonitoring ? 'Pause' : 'Resume' }}
							</button>
							<button
								@click="lockAllScreens"
								class="px-4 py-2 bg-rose-500/20 text-rose-300 rounded-lg font-semibold text-sm hover:bg-rose-500/30 transition"
							>
								Lock All
							</button>
							<button
								@click="endSession"
								class="px-4 py-2 bg-red-600 text-white rounded-lg font-semibold text-sm hover:bg-red-700 transition"
							>
								End Session
							</button>
						</div>
					</div>
				</div>

				<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
					<!-- Student Grid -->
					<div class="lg:col-span-3">
						<div class="mb-6">
							<h2 class="text-lg font-semibold text-white">Student Screens ({{ students.length }})</h2>
							<p class="text-sm text-slate-400 mt-1">Real-time monitoring of all active students</p>
						</div>

						<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
							<div
								v-for="student in students"
								:key="student.id"
								@click="viewStudent(student.id)"
								:class="[
									'bg-[#121826] border rounded-xl p-4 cursor-pointer transition hover:scale-105',
									student.deviceStatus === 'warning' ? 'border-amber-500/40' : student.deviceStatus === 'disconnected' ? 'border-rose-500/40' : 'border-white/10'
								]"
							>
								<!-- Screenshot Area -->
								<div class="relative w-full h-32 bg-black/40 rounded-lg border border-white/10 mb-4 overflow-hidden">
									<div class="absolute inset-0 flex items-center justify-center">
										<span class="text-slate-600 text-xs">Live Screen</span>
									</div>
									<div v-if="student.alerts > 0" class="absolute top-2 right-2 bg-rose-500 text-white text-xs font-bold px-2 py-1 rounded-full">
										{{ student.alerts }}
									</div>
								</div>

								<!-- Student Info -->
								<div class="flex items-center justify-between mb-3">
									<div>
										<p class="font-semibold text-white">{{ student.name }}</p>
										<p class="text-xs text-slate-500">ID: #{{ student.id }}</p>
									</div>
									<span :class="['inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-semibold border', getDeviceStatusColor(student.deviceStatus)]">
										<span>{{ getDeviceStatusIcon(student.deviceStatus) }}</span>
									</span>
								</div>

								<div class="text-xs text-slate-400">
									Last activity: {{ student.lastActivity }}
								</div>
							</div>
						</div>
					</div>

					<!-- Activity & Alerts Panel -->
					<div class="lg:col-span-1">
						<div class="bg-[#121826] border border-white/10 rounded-xl p-6 sticky top-8">
							<h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
								<span class="text-xl">🚨</span>
								Activity & Alerts
							</h3>

							<div class="space-y-3 max-h-[600px] overflow-y-auto">
								<div
									v-for="alert in alerts"
									:key="alert.id"
									:class="['border-l-4 rounded-r-lg p-3 transition hover:bg-white/5', getAlertSeverityColor(alert.severity)]"
								>
									<p class="font-semibold text-sm">{{ alert.studentName }}</p>
									<p class="text-xs mt-1">{{ alert.message }}</p>
									<p class="text-xs text-slate-500 mt-2">{{ alert.timestamp }}</p>
								</div>
							</div>

							<!-- Alert Summary -->
							<div class="mt-6 pt-6 border-t border-white/10 space-y-2">
								<div class="flex items-center justify-between text-sm">
									<span class="text-slate-400">Critical</span>
									<span class="text-rose-400 font-bold">{{ alerts.filter(a => a.severity === 'critical').length }}</span>
								</div>
								<div class="flex items-center justify-between text-sm">
									<span class="text-slate-400">Warnings</span>
									<span class="text-amber-400 font-bold">{{ alerts.filter(a => a.severity === 'warning').length }}</span>
								</div>
								<div class="flex items-center justify-between text-sm">
									<span class="text-slate-400">Info</span>
									<span class="text-cyan-400 font-bold">{{ alerts.filter(a => a.severity === 'info').length }}</span>
								</div>
							</div>
						</div>
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
