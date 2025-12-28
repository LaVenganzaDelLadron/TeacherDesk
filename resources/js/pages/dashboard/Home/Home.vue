<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

interface StatCard {
	label: string;
	value: number;
	icon: string;
	color: string;
}

interface Alert {
	id: number;
	type: 'critical' | 'warning' | 'normal';
	message: string;
	studentName: string;
	timestamp: string;
}

interface Exam {
	id: number;
	name: string;
	subject: string;
	startTime: string;
	duration: number;
	studentCount: number;
	status: 'active' | 'pending' | 'completed';
}

interface Broadcast {
	id: number;
	message: string;
	target: string;
	sentTime: string;
	status: 'sent' | 'pending';
	recipientCount: number;
}

const stats = ref<StatCard[]>([
	{ label: 'Online Students', value: 24, icon: '👥', color: 'cyan' },
	{ label: 'Active Screens', value: 24, icon: '📺', color: 'cyan' },
	{ label: 'Alerts', value: 3, icon: '⚠️', color: 'amber' },
	{ label: 'Suspicious Devices', value: 1, icon: '⚠️', color: 'rose' },
]);

const alerts = ref<Alert[]>([
	{
		id: 1,
		type: 'critical',
		message: 'Unauthorized app detected',
		studentName: 'John Doe',
		timestamp: '2 min ago',
	},
	{
		id: 2,
		type: 'warning',
		message: 'Rapid tab switching detected',
		studentName: 'Jane Smith',
		timestamp: '5 min ago',
	},
	{
		id: 3,
		type: 'warning',
		message: 'Screen sharing detected',
		studentName: 'Mike Johnson',
		timestamp: '8 min ago',
	},
	{
		id: 4,
		type: 'normal',
		message: 'Student activity normal',
		studentName: 'Sarah Williams',
		timestamp: '12 min ago',
	},
	{
		id: 5,
		type: 'critical',
		message: 'Copy-paste detected during exam',
		studentName: 'Alex Brown',
		timestamp: '15 min ago',
	},
]);

const activeExams = ref<Exam[]>([
	{
		id: 1,
		name: 'Mathematics Final',
		subject: 'MTH-101',
		startTime: '09:00 AM',
		duration: 120,
		studentCount: 24,
		status: 'active',
	},
	{
		id: 2,
		name: 'Physics Midterm',
		subject: 'PHY-102',
		startTime: '11:00 AM',
		duration: 90,
		studentCount: 18,
		status: 'pending',
	},
	{
		id: 3,
		name: 'Chemistry Quiz',
		subject: 'CHM-103',
		startTime: '02:00 PM',
		duration: 60,
		studentCount: 22,
		status: 'active',
	},
]);

const broadcasts = ref<Broadcast[]>([
	{
		id: 1,
		message: '5 minutes remaining. Please wrap up your answers.',
		target: 'MTH-101 Students',
		sentTime: '09:55 AM',
		status: 'sent',
		recipientCount: 24,
	},
	{
		id: 2,
		message: 'Exam has started. No external resources allowed.',
		target: 'PHY-102 Students',
		sentTime: '11:02 AM',
		status: 'sent',
		recipientCount: 18,
	},
	{
		id: 3,
		message: 'System maintenance scheduled for 3:00 PM',
		target: 'All Students',
		sentTime: '08:30 AM',
		status: 'sent',
		recipientCount: 64,
	},
]);

const broadcastMessage = ref('');
const broadcastTarget = ref('all');

const sendBroadcast = () => {
	if (broadcastMessage.value.trim()) {
		const newBroadcast: Broadcast = {
			id: broadcasts.value.length + 1,
			message: broadcastMessage.value,
			target: broadcastTarget.value === 'all' ? 'All Students' : `Selected Group`,
			sentTime: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
			status: 'sent',
			recipientCount: 24,
		};
		broadcasts.value.unshift(newBroadcast);
		broadcastMessage.value = '';
	}
};

const getExamStatusColor = (status: Exam['status']) => {
	const colors = {
		active: 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
		pending: 'bg-amber-500/20 text-amber-300 border-amber-500/30',
		completed: 'bg-slate-500/20 text-slate-300 border-slate-500/30',
	};
	return colors[status];
};

const getBroadcastStatusColor = (status: Broadcast['status']) => {
	const colors = {
		sent: 'text-emerald-400',
		pending: 'text-amber-400',
	};
	return colors[status];
};

const getAlertColor = (type: Alert['type']) => {
	const colors = {
		critical: 'border-l-rose-500 bg-rose-500/5',
		warning: 'border-l-amber-500 bg-amber-500/5',
		normal: 'border-l-emerald-500 bg-emerald-500/5',
	};
	return colors[type];
};

const getAlertTextColor = (type: Alert['type']) => {
	const colors = {
		critical: 'text-rose-300',
		warning: 'text-amber-300',
		normal: 'text-emerald-300',
	};
	return colors[type];
};

const getStatColor = (color: string) => {
	const colors = {
		cyan: 'text-cyan-400',
		amber: 'text-amber-400',
		rose: 'text-rose-400',
	};
	return colors[color as keyof typeof colors] || 'text-cyan-400';
};
</script>

<template>
	<Head title="Dashboard Home" />
	<div class="flex-1 overflow-auto">
		<div class="p-8">
			<!-- Header -->
			<div class="mb-8">
				<h1 class="text-3xl font-semibold text-white">Dashboard</h1>
				<p class="mt-2 text-slate-400">Real-time monitoring of student activity</p>
			</div>

			<!-- Stat Cards -->
			<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 mb-8">
				<div
					v-for="stat in stats"
					:key="stat.label"
					class="bg-[#121826] border border-white/10 rounded-xl p-6 hover:bg-[#1a1f33] transition cursor-pointer group"
				>
					<div class="flex items-center justify-between mb-4">
						<span class="text-3xl">{{ stat.icon }}</span>
						<span class="text-xs font-semibold text-slate-400 uppercase">{{ stat.label }}</span>
					</div>
					<p :class="['text-3xl font-bold', getStatColor(stat.color)]">
						{{ stat.value }}
					</p>
					<p class="text-xs text-slate-500 mt-2">Last updated: Now</p>
				</div>
			</div>

			<!-- Main Content Grid -->
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
				<!-- Alert Feed (Left - 2 columns) -->
				<div class="lg:col-span-2">
					<div class="bg-[#121826] border border-white/10 rounded-xl p-6">
						<h2 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
							<span class="text-xl">🔔</span>
							Live Alert Feed
						</h2>

						<div class="space-y-4 max-h-96 overflow-y-auto">
							<div
								v-for="alert in alerts"
								:key="alert.id"
								:class="[
									'border-l-4 rounded-r-lg p-4 transition hover:bg-white/5',
									getAlertColor(alert.type),
								]"
							>
								<div class="flex items-start justify-between">
									<div class="flex-1">
										<p class="font-semibold text-white">{{ alert.studentName }}</p>
										<p :class="['text-sm mt-1', getAlertTextColor(alert.type)]">
											{{ alert.message }}
										</p>
									</div>
									<span class="text-xs text-slate-500 whitespace-nowrap ml-4">{{ alert.timestamp }}</span>
								</div>
							</div>
						</div>

						<!-- Alert Summary -->
						<div class="mt-6 pt-6 border-t border-white/10 grid grid-cols-3 gap-4">
							<div class="text-center">
								<p class="text-rose-400 font-bold text-lg">
									{{ alerts.filter((a) => a.type === 'critical').length }}
								</p>
								<p class="text-xs text-slate-500 mt-1">Critical</p>
							</div>
							<div class="text-center">
								<p class="text-amber-400 font-bold text-lg">
									{{ alerts.filter((a) => a.type === 'warning').length }}
								</p>
								<p class="text-xs text-slate-500 mt-1">Warning</p>
							</div>
							<div class="text-center">
								<p class="text-emerald-400 font-bold text-lg">
									{{ alerts.filter((a) => a.type === 'normal').length }}
								</p>
								<p class="text-xs text-slate-500 mt-1">Normal</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Screenshot Preview (Right - 1 column) -->
				<div>
					<div class="bg-[#121826] border border-white/10 rounded-xl p-6 h-full flex flex-col">
						<h2 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
							<span class="text-xl">📸</span>
							Live Screen
						</h2>

						<div class="flex-1 rounded-lg border border-white/10 bg-black/40 overflow-hidden flex items-center justify-center min-h-64 lg:min-h-96">
							<div class="text-center">
								<p class="text-slate-500 text-sm">Select a student to view</p>
								<p class="text-slate-600 text-xs mt-2">their live screen capture</p>
							</div>
						</div>

						<!-- Student Info -->
						<div class="mt-6 pt-6 border-t border-white/10">
							<p class="text-xs text-slate-500 uppercase font-semibold mb-3">Active Student</p>
							<div class="flex items-center gap-3">
								<div class="w-8 h-8 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-300 text-sm font-semibold">
									JS
								</div>
								<div>
									<p class="text-sm font-semibold text-white">Jane Smith</p>
									<p class="text-xs text-slate-500">Screen updated 5s ago</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Exam Coordination Section -->
			<div class="mt-8">
				<h2 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
					<span class="text-xl">📝</span>
					Active Exams
				</h2>

				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
					<div v-for="exam in activeExams" :key="exam.id" class="bg-[#121826] border border-white/10 rounded-xl p-6 hover:bg-[#1a1f33] transition">
						<div class="flex items-start justify-between mb-4">
							<div>
								<h3 class="font-semibold text-white">{{ exam.name }}</h3>
								<p class="text-xs text-slate-400 mt-1">{{ exam.subject }}</p>
							</div>
							<span :class="['text-xs px-2 py-1 rounded-full border', getExamStatusColor(exam.status)]">
								{{ exam.status.charAt(0).toUpperCase() + exam.status.slice(1) }}
							</span>
						</div>

						<div class="space-y-3">
							<div class="flex items-center justify-between text-sm">
								<span class="text-slate-400">Start Time:</span>
								<span class="text-white font-medium">{{ exam.startTime }}</span>
							</div>
							<div class="flex items-center justify-between text-sm">
								<span class="text-slate-400">Duration:</span>
								<span class="text-white font-medium">{{ exam.duration }} min</span>
							</div>
							<div class="flex items-center justify-between text-sm">
								<span class="text-slate-400">Students:</span>
								<span class="text-cyan-400 font-bold">{{ exam.studentCount }}</span>
							</div>
						</div>

						<button class="w-full mt-4 bg-cyan-500/20 hover:bg-cyan-500/30 text-cyan-300 rounded-lg py-2 text-sm font-medium transition">
							Manage Exam
						</button>
					</div>
				</div>
			</div>

			<!-- Target Broadcasts Section -->
			<div class="mt-8">
				<h2 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
					<span class="text-xl">📢</span>
					Target Broadcasts
				</h2>

				<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
					<!-- Broadcast Form -->
					<div class="lg:col-span-2">
						<div class="bg-[#121826] border border-white/10 rounded-xl p-6">
							<h3 class="font-semibold text-white mb-4">Send Message to Students</h3>

							<div class="space-y-4">
								<div>
									<label class="text-xs font-semibold text-slate-300 block mb-2">Target Group</label>
									<select
										v-model="broadcastTarget"
										class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:border-cyan-400/70 focus:ring-2 focus:ring-cyan-400/30 outline-none"
									>
										<option value="all">All Students</option>
										<option value="mth-101">MTH-101 Students</option>
										<option value="phy-102">PHY-102 Students</option>
										<option value="chm-103">CHM-103 Students</option>
									</select>
								</div>

								<div>
									<label class="text-xs font-semibold text-slate-300 block mb-2">Message</label>
									<textarea
										v-model="broadcastMessage"
										placeholder="Enter your broadcast message..."
										class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white text-sm focus:border-cyan-400/70 focus:ring-2 focus:ring-cyan-400/30 outline-none resize-none"
										rows="4"
									/>
								</div>

								<button
									@click="sendBroadcast"
									:disabled="!broadcastMessage.trim()"
									class="w-full bg-cyan-500 hover:bg-cyan-600 disabled:bg-slate-500/30 disabled:cursor-not-allowed text-slate-900 font-semibold py-2 rounded-lg transition"
								>
									Send Broadcast
								</button>
							</div>
						</div>
					</div>

					<!-- Broadcast History -->
					<div>
						<div class="bg-[#121826] border border-white/10 rounded-xl p-6">
							<h3 class="font-semibold text-white mb-4">Recent Broadcasts</h3>

							<div class="space-y-3 max-h-96 overflow-y-auto">
								<div v-for="broadcast in broadcasts.slice(0, 5)" :key="broadcast.id" class="border-l-2 border-cyan-500/30 pl-3 py-2">
									<p class="text-sm text-white font-medium leading-snug">{{ broadcast.message }}</p>
									<div class="flex items-center justify-between mt-2">
										<span class="text-xs text-slate-500">{{ broadcast.target }}</span>
										<span :class="['text-xs font-semibold', getBroadcastStatusColor(broadcast.status)]">
											{{ broadcast.status.charAt(0).toUpperCase() + broadcast.status.slice(1) }}
										</span>
									</div>
									<p class="text-xs text-slate-600 mt-1">{{ broadcast.sentTime }} • {{ broadcast.recipientCount }} recipients</p>
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
